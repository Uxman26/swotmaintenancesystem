<?php

namespace App\Helpers;

use App\Models\XeroToken;
use League\OAuth2\Client\Provider\GenericProvider;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Helpers
{
    public static function refreshAccessToken($id)
{
    $config = config('xero');

    $clientId = $config['client_id'];
    $clientSecret = $config['client_secret'];
    $redirectUri = $config['redirect_uri'];
    $scopes = $config['scopes'];
    $authUrl = $config['auth_url'];
    $tokenUrl = $config['token_url'];

    Log::info("Getting refresh token for user: " . $id);

    $user = XeroToken::where('user_id', $id)->first();

    if (!$user) {
        throw new \Exception('User not found.');
    }

    $currentRefreshToken = $user->refresh_token;

    if (!$currentRefreshToken) {
        throw new \Exception('Refresh token not found for the user.');
    }

    Log::info("Attempting refresh with token: " . $currentRefreshToken);

    $provider = new GenericProvider([
        'clientId'                => $clientId,
        'clientSecret'            => $clientSecret,
        'redirectUri'             => $redirectUri,
        'urlAuthorize'            => $authUrl,
        'urlAccessToken'          => $tokenUrl,
        'urlResourceOwnerDetails' => '',
        'scopes'                  => $scopes,
    ]);

    try {
        $newToken = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $currentRefreshToken
        ]);

        $newRefreshToken = $newToken->getRefreshToken();
        $refreshTokenExpires = now()->addDays(60)->format('Y-m-d H:i:s');
        $accessToken = $newToken->getToken();
        $accessTokenExpire = now()->addMinutes(25)->format('Y-m-d H:i:s');

        Log::info("Successfully refreshed token for user: " . $id);

        // Save new tokens to DB
        XeroToken::updateOrCreate(
            ['user_id' => $id],
            [
                'access_token' => $accessToken,
                'access_token_expire_at' => $accessTokenExpire,
                'refresh_token' => $newRefreshToken,
                'expired_on' => $refreshTokenExpires,
            ]
        );

        // Save to session
        session([
            'xero_tokens' => [
                'access_token' => $accessToken,
                'refresh_token' => $newRefreshToken,
            ]
        ]);
        session()->save();

        return $newToken;
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        \Log::error('Xero Refresh Token Error: ' . $e->getMessage());

        // Optional: redirect user to re-auth if refresh fails
        session()->forget('xero_tokens');

        throw new \Exception('Failed to refresh Xero access token. Please re-authenticate.');
    }
}

    
    public static function getXeroContacts($token)
    {
        if (!is_string($token)) {
            throw new \Exception('Invalid token object passed to getXeroContacts');
        }
        
        // Create a dummy token object with the required methods for the sake of demonstration
        $tokenObject = new class($token) {
            private $token;
            public function __construct($token) {
                $this->token = $token;
            }
            public function hasExpired() {
                // Your logic to check if the token has expired
                return false;
            }
            public function getToken() {
                return $this->token;
            }
        };
        
        if ($tokenObject->hasExpired()) {
            $user = backpack_user();
            if (empty($user)) {
                return redirect()->route('backpack.auth.login');
            }
            $id = $user->id;
            
            $newToken = \App\Helpers\Helpers::refreshAccessToken($id);
            
            if (!$newToken) {
                throw new \Exception('Failed to refresh token or invalid token object returned');
            }
            
            $tokenObject = $newToken;
        }
        
        try {
            $client = new Client();
            
            $contactsResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Contacts', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $tokenObject->getToken(),
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                ],
            ]);
            
            $contactsArray = json_decode($contactsResponse->getBody(), true);
            
            \Log::info('Xero API Response:', ['response' => $contactsArray]);
            
            if (array_key_exists('Contacts', $contactsArray)) {
                $contacts = $contactsArray['Contacts'];
                
                $projectsResponse = $client->request('GET', 'https://api.xero.com/projects.xro/2.0/projects', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $tokenObject->getToken(),
                        'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                        'Accept'        => 'application/json',
                    ],
                ]);
                $projectsArray = json_decode($projectsResponse->getBody(), true);
                
                \Log::info('Xero Projects API Response:', ['response' => $projectsArray]);
                
                $projects = $projectsArray['items'];
                
                $itemsResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Items', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $tokenObject->getToken(),
                        'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                        'Accept'        => 'application/json',
                    ],
                ]);
                $itemsArray = json_decode($itemsResponse->getBody(), true);
                
                \Log::info('Xero Items API Response:', ['response' => $itemsArray]);
                
                $items = $itemsArray['Items'];
                
                $quotesResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Quotes', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $tokenObject->getToken(),
                        'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                        'Accept'        => 'application/json',
                    ],
                ]);
                $quotesArray = json_decode($quotesResponse->getBody(), true);
                
                \Log::info('Xero Quotes API Response:', ['response' => $quotesArray]);
                
                $quotes = $quotesArray['Quotes'];
                
                $invoicesResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Invoices', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $tokenObject->getToken(),
                        'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                        'Accept'        => 'application/json',
                    ],
                ]);
                $invoicesArray = json_decode($invoicesResponse->getBody(), true);
                
                \Log::info('Xero Invoices API Response:', ['response' => $invoicesArray]);
                
                $invoices = $invoicesArray['Invoices'];
                
                $accountsResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Accounts', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $tokenObject->getToken(),
                        'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                        'Accept'        => 'application/json',
                    ],
                ]);
                $accountsArray = json_decode($accountsResponse->getBody(), true);
                
                \Log::info('Xero Accounts API Response:', ['response' => $accountsArray]);
                
                $accounts = $accountsArray['Accounts'];
                
                $taxResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/TaxRates', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $tokenObject->getToken(),
                        'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                        'Accept'        => 'application/json',
                    ],
                ]);
                $taxArray = json_decode($taxResponse->getBody(), true);
                
                \Log::info('Xero Tax Rates API Response:', ['response' => $taxArray]);
                
                $taxes = $taxArray['TaxRates'];
                
                $xero = [
                    'contacts' => $contacts,
                    'projects' => $projects,
                    'items'    => $items,
                    'quotes'   => $quotes,
                    'invoices' => $invoices,
                    'accounts' => $accounts,
                    'taxes'    => $taxes,
                ];
                
                session(['xero' => $xero]);
                
                return $xero;
            } else {
                \Log::error('Contacts key not found in Xero API response.', ['response' => $contactsArray]);
                return [];
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            return [];
        } catch (\Exception $e) {
            \Log::error('Unexpected Error: ' . $e->getMessage());
            return [];
        }
    }
    
}