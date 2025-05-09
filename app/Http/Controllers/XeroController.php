<?php

namespace App\Http\Controllers;

use App\Models\XeroToken;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use League\OAuth2\Client\Provider\GenericProvider;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helpers; // Add this line

class XeroController extends Controller
{
    public function authenticate(Request $request)
    {
        $user_id = backpack_user()->id;

        \Log::info('Starting authentication for user: ' . $user_id);

        try {
            Helpers::refreshAccessToken($user_id);
            \Log::info('Access token refreshed successfully for user: ' . $user_id);

            return redirect($request->from ?? '/admin');
        } catch (\Throwable $th) {
            \Log::error('Error during token refresh: ' . $th->getMessage());

            $config = config('xero');

            $provider = new GenericProvider([
                'clientId'                => $config['client_id'],
                'clientSecret'            => $config['client_secret'],
                'redirectUri'             => $config['redirect_uri'],
                'urlAuthorize'            => $config['auth_url'],
                'urlAccessToken'          => $config['token_url'],
                'urlResourceOwnerDetails' => '',
                'scopes'                  => $config['scopes'],
            ]);

            $authorizationUrl = $provider->getAuthorizationUrl(['prompt' => 'consent', 'scope' => $config['scopes']]);
            \Log::info('Redirecting to Xero for authorization: ' . $authorizationUrl);

            return redirect($authorizationUrl);
        }
    }

    public function handleCallback(Request $request)
{
    try {
        $user = backpack_user();
        if (!$user) {
            \Log::error('User is not authenticated in Xero callback.');
            return redirect()->route('backpack.auth.login');
        }

        $id = $user->id;
        \Log::info('Handling Xero callback for user: ' . $id);

        $config = config('xero');

        $provider = new GenericProvider([
            'clientId'                => $config['client_id'],
            'clientSecret'            => $config['client_secret'],
            'redirectUri'             => $config['redirect_uri'],
            'urlAuthorize'            => $config['auth_url'],
            'urlAccessToken'          => $config['token_url'],
            'urlResourceOwnerDetails' => '',
            'scopes'                  => $config['scopes'],
        ]);

        // Ensure the request has the authorization code
        $authCode = $request->input('code');
        if (!$authCode) {
            \Log::error('Xero callback is missing the authorization code.');
            return response()->json(['error' => 'Authorization code is missing.'], 400);
        }

        // Fetch the access token using the authorization code
        $token = $provider->getAccessToken('authorization_code', ['code' => $authCode]);

        // Validate token object
        if (!$token instanceof \League\OAuth2\Client\Token\AccessToken) {
            \Log::error('Xero returned an invalid token object.');
            return response()->json(['error' => 'Invalid token object received from Xero.'], 500);
        }

        // Check if the token is expired
        if ($token->hasExpired()) {
            \Log::error('Xero access token expired before use.');
            return response()->json(['error' => 'Xero access token expired.'], 401);
        }

        // Extract tokens
        $accessToken = $token->getToken();
        $refreshToken = $token->getRefreshToken();
        $accessTokenExpire = now()->addMinutes(25)->format('Y-m-d H:i:s');
        $refreshTokenExpires = now()->addDays(60)->format('Y-m-d H:i:s');

        // Ensure valid token
        if (!$accessToken) {
            \Log::error('Xero access token is empty.');
            return response()->json(['error' => 'Failed to retrieve Xero access token.'], 500);
        }

        \Log::info('Xero Token Received:', [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'expires_at' => $accessTokenExpire
        ]);

        // Save the tokens in the database
        $saveddata = XeroToken::updateOrCreate(
            ['user_id' => $id],
            [
                'access_token'        => $accessToken,
                'access_token_expire_at' => $accessTokenExpire,
                'refresh_token'       => $refreshToken,
                'expired_on'          => $refreshTokenExpires,
            ]
        );

        \Log::info('Xero tokens saved successfully.', ['saveddata' => $saveddata]);

        // Store tokens in session
        session(['xero_tokens' => [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ]]);

        // Fetch Xero contacts using the valid access token
        try {
            $xeroContacts = $this->getXeroContacts($accessToken);
            session(['xero' => $xeroContacts]);
            \Log::info('Xero contacts retrieved successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to fetch Xero contacts: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch Xero contacts.'], 500);
        }

        return redirect()->route('backpack.dashboard');

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        \Log::error('Xero Authentication Error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json(['error' => 'Xero Authentication Error'], 500);
    } catch (\Exception $e) {
        \Log::error('Unexpected Error: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json(['error' => 'Unexpected error occurred.', 'message' => $e->getMessage()], 500);
    }
}

    public static function downloadPdf($accessToken, $Invoiceid, $InvoiceNumber)
    {
        try {
            if (!$accessToken) {
                return response()->json(['error' => 'Access token not provided.'], 400);
            }

            $client = new Client();

            $pdfResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Invoices/' . $Invoiceid, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept' => 'application/pdf',
                ],
            ]);

            \Log::info('Xero API Response:', ['response' => $pdfResponse->getBody()->getContents()]);

            $pdfContent = $pdfResponse->getBody();

            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="invoice-' . $InvoiceNumber . '.pdf"',
            ];

            return response()->make($pdfContent, 200, $headers);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            \Log::error('Unexpected Error: ' . $e->getMessage());
            return response()->json(['error' => 'Unexpected error occurred.'], 500);
        }
    }

    public static function downloadQuotePdf($accessToken, $QuoteNumber, $QuoteId) 
    {
        try {
            if (!$accessToken) {
                return response()->json(['error' => 'Access token not provided.'], 400);
            }

            $client = new Client();
            // dd($accessToken, $QuoteNumber, $QuoteId);
            $pdfResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Quotes/{' . $QuoteId . '}', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept' => 'application/pdf'
                ],
            ]);
            \Log::info('Xero API Response:', ['response' => $pdfResponse->getBody()->getContents()]);

            $pdfContent = $pdfResponse->getBody();
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="quote-' . $QuoteNumber . '.pdf"',
            ];

            return response()->make($pdfContent, 200, $headers);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            \Log::error('Unexpected Error: ' . $e->getMessage());
            return response()->json(['error' => 'Unexpected error occurred.'], 500);
        }
    }

    private function refreshAccessToken($id)
    {
        return Helpers::refreshAccessToken($id);
    }

    private function getXeroContacts($token)
    {
        return Helpers::getXeroContacts($token);
    }
}
