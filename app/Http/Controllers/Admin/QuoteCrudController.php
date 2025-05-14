<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuoteRequest;
use App\Models\Item;
use App\Models\Quote;
use App\Models\User;
use App\Models\XeroToken;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use GuzzleHttp\Exception\RequestException;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use League\OAuth2\Client\Provider\GenericProvider;
use App\Helpers\Helpers;




/**
 * Class QuoteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuoteCrudController extends CrudController
{
    
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Quote::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/quote');
        CRUD::setEntityNameStrings('quote', 'quotes');
        //$this->crud->denyAccess(['delete']);
        
    }
    
    private function getXeroData()
    {
        $xeroTokens = session('xero_tokens');
        
        // Check if access token exists
        if (isset($xeroTokens['access_token'])) {
            $xeroAccessToken = $xeroTokens['access_token'];
            
            // Check if token is expired
            if ($this->isTokenExpired($xeroTokens)) {
                \Log::info('Access token expired. Attempting to refresh.');
                
                $xeroTokens = $this->refreshXeroToken($xeroTokens);
                if ($xeroTokens) {
                    $xeroAccessToken = $xeroTokens['access_token'];
                    session(['xero_tokens' => $xeroTokens]);
                    \Log::info('Token refreshed successfully.');
                } else {
                    \Log::error('Failed to refresh access token.');
                    return [];
                }
            }
            
            \Log::info('Xero Access Token Found:', ['token' => $xeroAccessToken]);
            
            try {
                // Fetch the latest Xero data
                $updatedXeroData = \App\Helpers\Helpers::getXeroContacts($xeroAccessToken);
                
                if (!empty($updatedXeroData)) {
                    \Log::info('Fetched Xero Data:', ['data' => $updatedXeroData]);
                    
                    // Store data in session
                    session(['xero' => $updatedXeroData]);
                    \Log::info('Xero data stored in session.');
                    
                    return $updatedXeroData;
                } else {
                    \Log::warning('Fetched Xero data is empty.');
                }
            } catch (\Exception $e) {
                \Log::error('Xero API Request Error:', ['error' => $e->getMessage()]);
            }
        } else {
            \Log::warning('No access token found in session.');
        }
        
        return [];
    }
    
    /**
     * Check if the token is expired.
     */
    private function isTokenExpired($xeroTokens)
    {
        $expiryTime = $xeroTokens['expires_at'] ?? 0;
        return $expiryTime <= time();
    }
    
    /**
     * Refresh the Xero access token using the refresh token.
     */
    private function refreshXeroToken($xeroTokens)
    {
        try {
            // Make a request to refresh the token
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://identity.xero.com/connect/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $xeroTokens['refresh_token'],
                    'client_id' => config('xero.client_id'),
                    'client_secret' => config('xero.client_secret'),
                ]
            ]);
            
            $newTokenData = json_decode($response->getBody()->getContents(), true);
            
            // Update session with new token data
            return [
                'access_token' => $newTokenData['access_token'],
                'refresh_token' => $newTokenData['refresh_token'],  // Save the new refresh token
                'expires_at' => time() + $newTokenData['expires_in'],  // Set new expiry time
            ];
        } catch (\Exception $e) {
            \Log::error('Error refreshing Xero token:', ['error' => $e->getMessage()]);
            return false;
        }
    }
    
    
    
    
    
    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    
    {
       
        
        //dd($newAccessToken);
        $xero = session('xero_tokens');
      // dd($xero);
        
        $this->updateddatafromxero();
        
        $user = backpack_user();
        
        CRUD::addButtonFromModelFunction('line', 'delete_quote', 'getDeleteQuoteButton', 'end');
        
        CRUD::addButtonFromModelFunction('line', 'download_quote', 'getDownloadButton', 'beginning');
        
        
        
        if ($user->id == 1) {
        } else {
            $id = $user->id;
            $this->crud->addClause('where', 'salespersonID', '=', $id);}
            
            
            
            
            // Quote Number Filter
            $this->crud->addFilter([
                'name' => 'quote_number',
                'type' => 'select2', // Use 'select2' type for dropdown with search
                'label' => 'Quote Number',
            ], function () {
                // Fetch unique quote numbers from the database and display in the dropdown
                return Quote::pluck('quote_number', 'quote_number')->toArray();
            }, function ($value) {
                $this->crud->addClause('where', 'quote_number', '=', $value);
            });
            
            // Customer Filter
            $this->crud->addFilter([
                'name' => 'customer',
                'type' => 'select2', // Use 'select2' type for dropdown with search
                'label' => 'Customer',
            ], function () {
                // Fetch unique customers from the database and display in the dropdown
                return Quote::pluck('customer', 'customer')->toArray();
            }, function ($value) {
                $this->crud->addClause('where', 'customer', '=', $value);
            });
            
            // Status Filter
            $this->crud->addFilter([
                'name' => 'status',
                'type' => 'select2', // Use 'select2' type for dropdown with search
                'label' => 'Status',
            ], function () {
                // Define the possible status options
                $statusOptions = [
                    'Local Draft' => 'Local Draft',
                    'DRAFT' => 'Xero Draft',
                    'SENT' => 'Sent',
                    'ACCEPTED' => 'Accepted',
                ];
                
                return $statusOptions;
            }, function ($value) {
                $this->crud->addClause('where', 'status', '=', $value);
            });
            
            
            $this->crud->addFilter([
                'name' => 'issue_date',
                'type' => 'date_range',
                'label' => 'Issue Date',
            ], false, function ($value) {
                $dates = explode(' - ', $value);
                if (count($dates) == 2) {
                    $this->crud->addClause('whereBetween', 'issue_date', [$dates[0], $dates[1]]);
                }
            });
            
            $this->crud->addFilter([
                'name' => 'expiry_date',
                'type' => 'date_range',
                'label' => 'Expiry Date',
            ], false, function ($value) {
                $dates = explode(' - ', $value);
                if (count($dates) == 2) {
                    $this->crud->addClause('whereBetween', 'expiry_date', [$dates[0], $dates[1]]);
                }
            });
            
            $this->crud->addColumn([
                'name' => 'quote_number',
                'label' => 'Quote Number',
                'type' => 'text',
            ]);
            
            $this->crud->addColumn([
                'name' => 'customer',
                'label' => 'Customer',
                'type' => 'text',
            ]);
            
            $this->crud->addColumn([
                'name' => 'reference',
                'label' => 'Reference',
                'type' => 'text',
            ]);
            
            $this->crud->addColumn([
                'name' => 'issue_date',
                'label' => 'Issue Date',
                'type' => 'date',
            ]);
            
            $this->crud->addColumn([
                'name' => 'expiry_date',
                'label' => 'Expiry Date',
                'type' => 'date',
            ]);
            
            $this->crud->addColumn([
                'name' => 'total',
                'label' => 'Total',
                'type' => 'text',
            ]);
            $this->crud->addColumn([
                'name' => 'status',
                'label' => 'Status',
                'type' => 'text',
            ]);
            
            $this->crud->addColumn([
                'name' => 'salespersonName',
                'label' => 'Created By',
                'type' => 'text',
            ]);
            
            
            
            
    }
    
    
    
    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    
    
    protected function setupCreateOperation()
    {
        $this->crud->set('create.contentClass', 'col-md-12');
        
        $this->updateddatafromxero();
        
        $xero = session('xero');
        
       //dd($xero);
        
        // Check if 'contacts' and 'items' keys exist in the session data
        if (empty($xero['contacts'])) {
           \Log::error('No contacts found in Xero data.');
            $authRedirectUrl = env('XERO_AUTH_REDIRECT_URL') . '?from=' . url()->current();
            header('Location: ' . $authRedirectUrl);
            exit();
        }
        
       
        $this->contactsData = array_column($xero['contacts'], 'Name', 'ContactID');
        
        $this->crud->addField([
            'name'    => 'customer',
            'label'   => 'Customer Contact',
            'type'    => 'select_from_array',
            'options' => $this->contactsData,
            'wrapper' => ['class' => 'form-group col-md-3'],
            'rules'   => 'required', // Set the 'customer' field as required
        ]);
        
        $this->crud->addField([
            'name'    => 'issue_date',
            'label'   => 'Issue Date',
            'type'    => 'date',
            'default' => now()->toDateString(),
            'wrapper' => ['class' => 'form-group col-md-3'],
            'rules'   => 'required|date', // Set the 'issue_date' field as required and validate it as a date
        ]);
        
        $this->crud->addField([
            'name'    => 'expiry_date',
            'label'   => 'Expiry Date',
            'type'    => 'date',
            'wrapper' => ['class' => 'form-group col-md-3'],
            'rules'   => 'required|date', // Set the 'expiry_date' field as required and validate it as a date
        ]);
        
        $this->crud->addField([
            'name'    => 'title',
            'label'   => 'Title',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'summary',
            'label'   => 'Summary',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'reference',
            'label'   => 'Reference',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'status',
            'label'   => 'Status',
            'type'    => 'select_from_array',
            'options' => [
                'Local Draft' => 'SAVE AS DRAFT',
                'DRAFT' => 'SAVE AS DRAFT IN XERO',
                'SENT' => 'SENT',
            ],
            'default' => 'Local Draft', // Set 'Local Draft' as the default value
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        // Item Part
        $this->crud->addField([
            'name'        => 'items',
            'label'       => 'Items',
            'type'        => 'custom_html',
            'value'       => view('admin.quote.items')->render(),
            'wrapper'     => ['class' => 'form-group col-md-12'],
        ]);
        
        // Terms, Subtotal, and Total
        $this->crud->addField([
            'name'    => 'terms',
            'label'   => 'Terms',
            'type'    => 'textarea',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
    }
    
    
    
    
    public function store(Request $request)
    
    {
        $selectedContact = $request->input('customer');
        $customerID = $selectedContact; // ContactID will be the key in the array
        $customerName = $this->contactsData[$selectedContact]; // Retrieve the name using the key
        
        $this->updateddatafromxero();
        
        
        if ($request->input('status') == 'Local Draft') {
            
            
            $issueDate = $request->input('issue_date');
            $formattedIssueDate = \Carbon\Carbon::parse($issueDate)->format('Y-m-d H:i:s');
            $expiryDate = $request->input('expiry_date');
            $formattedExpiryDate = \Carbon\Carbon::parse($expiryDate)->format('Y-m-d H:i:s');
            $title = $request->input('title');
            $summary = $request->input('summary');
            $reference = $request->input('reference');
            $terms = $request->input('terms');
            $subtotal = $request->input('subtotal');
            $total = $request->input('total');
            $status = $request->input('status');
            $salesPersonID = backpack_user()->id;
            $salesPerson = backpack_user()->name;
            
            // Insert data into the 'quotes' table and get the inserted ID
            $quoteId = DB::table('quotes')->insertGetId([
                'customer'        => $customerName,
                'issue_date'      => $formattedIssueDate,
                'expiry_date'     => $formattedExpiryDate,
                'title'           => $title,
                'summary'         => $summary,
                'reference'       => $reference,
                'terms'           => $terms,
                'subtotal'        => $subtotal,
                'total'           => $total,
                'salespersonID'   => $salesPersonID,
                'salespersonName' => $salesPerson,
                'status'          => $status,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
            
            // Insert data into the 'items' table using $lineItems and the obtained quote ID
            $itemCount = count($request->input('item_description'));
            for ($i = 0; $i < $itemCount; $i++) {
                DB::table('items')->insert([
                    'quote_id'      => $quoteId,
                    'item_name'     => $request->input('name')[$i],
                    'description'   => $request->input('item_description')[$i],
                    'quantity'      => (int)$request->input('item_quantity')[$i],
                    'unit_amount'   => (float)$request->input('item_price')[$i],
                    'account_code'  => $request->input('item_account')[$i],
                    'lineamount'    => $request->input('item_amount')[$i],
                    'discount'    => $request->input('item_discount')[$i],
                    'created_at'    => now(),
                    'updated_at'    => now(),
                    'item_id'    => $request->input('item_name')[$i],
                ]);
            }
            
            
        }else{
            
            
            $xeroTokens = session('xero_tokens');
            
            //dd($xeroTokens);
            
            if(empty($xeroTokens)){
                $authRedirectUrl = env('XERO_AUTH_REDIRECT_URL') . '?from=' . url()->current();
                
                header('Location: ' . $authRedirectUrl);
            }
            // Ensure the access token is present
            if (isset($xeroTokens['access_token'])) {
                $xeroAccessToken = $xeroTokens['access_token'];
                
                // Prepare line items array
                $lineItems = [];
                $itemCount = count($request->input('item_description'));
                for ($i = 0; $i < $itemCount; $i++) {
                    $itemsName[]=$request->input('name')[$i];
                    
                }
                
                for ($i = 0; $i < $itemCount; $i++) {
                    $lineItems[] = [
                        'ItemID' => $request->input('item_name')[$i],
                        'Description' => $request->input('item_description')[$i],
                        'Quantity' => (int)$request->input('item_quantity')[$i],
                        'UnitAmount' => (float)$request->input('item_price')[$i],
                        'DiscountRate' => $request->input('item_discount')[$i],
                        'AccountCode' => $request->input('item_account')[$i],
                        'LineAmount' => $request->input('item_amount')[$i],
                        
                    ];
                }
                
                $quoteData = [
                    'Quotes' => [
                        [
                            'Contact' => [
                                'ContactID' => $customerID,
                            ],
                            'LineItems' => $lineItems,
                            'Date' => $request->input('issue_date'),
                            'ExpiryDate' => $request->input('expiry_date'),
                            'Status' => $request->input('status'),
                            'Title' => $request->input('title'),
                            'Summary' => $request->input('summary'),
                            'Reference' => $request->input('reference'),
                            'Terms' => $request->input('terms'),
                            
                        ],
                    ],
                ];
                
                // Call the Xero API
                $response = $this->callXeroApi($quoteData, $xeroAccessToken);
                
                // dd($response);
                
                if ($response) {
                    // Store the Xero API response in the database
                    $this->storeXeroApiResponse($response, $itemsName, $lineItems);
                    
                    // Fetch the latest Xero data
                    $updatedXeroData = \App\Helpers\Helpers::getXeroContacts($xeroAccessToken);
                    
                    // Update the session with the latest Xero data
                    session(['xero' => $updatedXeroData]);
                    
                    return redirect()->back()->with('success', 'Quote created successfully in Xero.');
                    
                    
                } else {
                    // Error message
                    return redirect()->back()->with('error', 'Failed to create a quote in Xero.')->withInput();
                }
            } else {
                // Error message if Xero access token not found
                return redirect()->back()->with('error', 'Xero access token not found.')->withInput();
            }
            
        }
    }
    
    /**
     * Store Xero API response in the database.
     *
     * @param array $response
     * @return void
     */
    private function storeXeroApiResponse($response, $itemsName, $lineItems)
    {
        if(empty($response['Quotes'])){
            
            return redirect()->back();
        }
        // Extract information from the Xero response
        $quoteID = $response['Quotes'][0]['QuoteID'];
        $quoteNumber = $response['Quotes'][0]['QuoteNumber'];
        $customerName = $response['Quotes'][0]['Contact']['Name'];
        $issueDate = $response['Quotes'][0]['DateString'];
        $formattedIssueDate = \Carbon\Carbon::parse($issueDate)->format('Y-m-d H:i:s');
        $expiryDate = $response['Quotes'][0]['ExpiryDateString'];
        $formattedExpiryDate = \Carbon\Carbon::parse($expiryDate)->format('Y-m-d H:i:s');
        $title = $response['Quotes'][0]['Title'];
        $summary = $response['Quotes'][0]['Summary'];
        $reference = $response['Quotes'][0]['Reference'];
        $currency = $response['Quotes'][0]['CurrencyCode'];
        $terms = $response['Quotes'][0]['Terms'];
        $subtotal = $response['Quotes'][0]['SubTotal'];
        $total = $response['Quotes'][0]['Total'];
        $status = $response['Quotes'][0]['Status'];
        $salesPersonID = backpack_user()->id;
        $salesPerson = backpack_user()->name;
        
        // Insert data into the 'quotes' table
        DB::table('quotes')->insert([
            'customer'        => $customerName,
            'issue_date'      => $formattedIssueDate,
            'expiry_date'     => $formattedExpiryDate,
            'quote_number'    => $quoteNumber,
            'title'           => $title,
            'summary'         => $summary,
            'reference'       => $reference,
            'currency'        => $currency,
            'terms'           => $terms,
            'subtotal'        => $subtotal,
            'total'           => $total,
            'salespersonID'   => $salesPersonID,
            'salespersonName' => $salesPerson,
            'status'          => $status,
            'quote_id'        => $quoteID,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
        
        // Insert data into the 'items' table using $lineItems
        foreach ($lineItems as $index => $item) {
            DB::table('items')->insert([
                'quote_id'      => $quoteID,
                'item_name'     => $itemsName[$index],
                'description'   => $item['Description'],
                'quantity'      => $item['Quantity'],
                'unit_amount'   => $item['UnitAmount'],
                'account_code'  => $item['AccountCode'],
                'lineamount'    => $item['LineAmount'],
                'created_at'    => now(),
                'updated_at'    => now(),
                'item_id'       => $item['ItemID'],
                'discount'      => $item['DiscountRate'],
            ]);
        }
    }
    

    
    private function callXeroApi($quoteData, $xeroAccessToken)
    {
        
        // dd($jsonQuoteData);
        
        try {
            $client = new \GuzzleHttp\Client();
            
            $Response = $client->request('POST', 'https://api.xero.com/api.xro/2.0/Quotes', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'json' => $quoteData,
            ]);
            
            // Handle the Xero API response as needed
            return json_decode($Response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log GuzzleHttp request exceptions
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            
            // Return a user-friendly error response
            return ['error' => 'Failed to send quote to Xero. Please try again. call xero api function' . $e->getMessage()];
        } catch (\Exception $e) {
            // Log other exceptions
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            
            // Return a user-friendly error response
            return ['error' => 'An unexpected error occurred. Please try again. call xero api function'];
        }
    }
    
    
    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->crud->set('update.contentClass', 'col-md-12');
        $this->updateddatafromxero();
        // Get the existing data for the current record
        $quoteId = $this->crud->getCurrentEntryId();
        
        $existingData = DB::table('quotes')->where('id', $quoteId)->first();
        
        
        if (!$existingData || !isset($existingData->customer)) {
            
            
            
        }else{
            
            $defaultCustomer = $existingData->customer;
        }
        
        
        
        $xero = session('xero');
        
        $contactsData = array_column($xero['contacts'], 'Name', 'ContactID');
        
        
        $this->crud->addField([
            'name'    => 'customer',
            'label'   => 'Customer Contact',
            'type'    => 'select_from_array',
            'options' => $contactsData,
            'value'   => array_search($defaultCustomer, $contactsData), // Search for the name and get its corresponding ID
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        
        
        $this->crud->addField([
            'name'    => 'issue_date',
            'label'   => 'Issue Date',
            'type'    => 'date',
            'default' => now()->toDateString(),
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'expiry_date',
            'label'   => 'Expiry Date',
            'type'    => 'date',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'quote_number',
            'label'   => 'Quote Number',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
            'attributes' => [
                'readonly' => 'readonly',
            ],
        ]);
        
        $this->crud->addField([
            'name'    => 'quote_id',
            'label'   => 'Quote ID',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
            'attributes' => [
                'readonly' => 'readonly',
            ],
        ]);
        
        
        $this->crud->addField([
            'name'    => 'title',
            'label'   => 'Title',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'summary',
            'label'   => 'Summary',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'reference',
            'label'   => 'Reference',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'status',
            'label'   => 'Status',
            'type'    => 'select_from_array',
            'options' => [
                'Local Draft' => 'SAVE AS DRAFT',
                'DRAFT' => 'SAVE AS DRAFT IN XERO',
                'SENT' => 'SENT',
                'ACCEPTED' => 'ACCEPTED',
                'DELETED' => 'DELETED',
                
                
            ],
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        
        $this->crud->addField([
            'name'        => 'items',
            'label'       => 'Items',
            'type'        => 'custom_html',
            'value'       => view('admin.quote.update-items')->render(),
            'wrapper'     => ['class' => 'form-group col-md-12'],
        ]);
        
        // Terms, Subtotal, and Total
        $this->crud->addField([
            'name'    => 'terms',
            'label'   => 'Terms',
            'type'    => 'textarea',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        
    }
    
    
    public function update(Request $request)
    {
        
        if ($request->input('status') == 'DRAFT') {
            $xeroTokens = session('xero_tokens');
            
            // Ensure the access token is present
            if (isset($xeroTokens['access_token'])) {
                $xeroAccessToken = $xeroTokens['access_token'];
                
                // Prepare line items array
                $lineItems = [];
                $itemCount = count($request->input('item_description'));
                
                
                for ($i = 0; $i < $itemCount; $i++) {
                    $itemsName[]=$request->input('name')[$i];
                    
                }
                for ($i = 0; $i < $itemCount; $i++) {
                    $lineItems[] = [
                        'ItemID' => $request->input('item_id')[$i],
                        'Description' => $request->input('item_description')[$i],
                        'Quantity' => (int)$request->input('item_quantity')[$i],
                        'UnitAmount' => (float)$request->input('item_price')[$i],
                        'DiscountRate' => (float)$request->input('item_discount')[$i],
                        'AccountCode' => $request->input('item_account')[$i],
                        'LineAmount' => $request->input('item_amount')[$i],
                    ];
                }
                // dd($lineItems);
                $quoteID = $request->input('quote_id');
                
                $quoteData = [
                    'Quotes' => [
                        [
                            'QuoteNumber' => $request->input('quote_number'),
                            'Contact' => [
                                'ContactID' => $request->input('customer'),
                            ],
                            'LineItems' => $lineItems,
                            'Date' => $request->input('issue_date'),
                            'ExpiryDate' => $request->input('expiry_date'),
                            'Title' => $request->input('title'),
                            'Summary' => $request->input('summary'),
                            'Reference' => $request->input('reference'),
                            'Terms' => $request->input('terms'),
                            
                        ],
                    ],
                ];
                
                // Call the Xero API
                //  dd($quoteData);
                $response = $this->updateXeroApi($quoteData, $xeroAccessToken, $quoteID);
                
                if ($response) {
                    // Store the Xero API response in the database
                    $this->updateXeroApiResponse($response, $itemsName, $lineItems);
                    
                    // Fetch the latest Xero data
                    $updatedXeroData = \App\Helpers\Helpers::getXeroContacts($xeroAccessToken);
                    
                    // Update the session with the latest Xero data
                    session(['xero' => $updatedXeroData]);
                    
                    // Success message
                    // Redirect to the showquote page with the updated list of quotes
                    // return redirect()->route('quote')->with('success', 'Quote created successfully in Xero.');
                    return redirect()->back()->with('success', 'Quote updated successfully in Xero.');
                } else {
                    // Error message
                    return redirect()->back()->with('error', 'Failed to create a quote in Xero.')->withInput();
                }
            } else {
                // Error message if Xero access token not found
                
                return redirect()->back()->with('error', 'Xero access token not found.')->withInput();
            }
            
        }else{
            $xeroTokens = session('xero_tokens');
            
            // Ensure the access token is present
            if (isset($xeroTokens['access_token'])) {
                $xeroAccessToken = $xeroTokens['access_token'];
                
                // Prepare line items array
                $lineItems = [];
                $itemCount = count($request->input('item_description'));
                
                
                for ($i = 0; $i < $itemCount; $i++) {
                    $itemsName[]=$request->input('name')[$i];
                    
                }
                for ($i = 0; $i < $itemCount; $i++) {
                    $lineItems[] = [
                        'ItemID' => $request->input('item_id')[$i],
                        'Description' => $request->input('item_description')[$i],
                        'Quantity' => (int)$request->input('item_quantity')[$i],
                        'UnitAmount' => (float)$request->input('item_price')[$i],
                        'DiscountRate' => (float)$request->input('item_discount')[$i],
                        'AccountCode' => $request->input('item_account')[$i],
                        'LineAmount' => $request->input('item_amount')[$i],
                    ];
                }
                // dd($lineItems);
                $quoteID = $request->input('quote_id');
                
                $quoteData = [
                    'Quotes' => [
                        [
                            'QuoteNumber' => $request->input('quote_number'),
                            'Contact' => [
                                'ContactID' => $request->input('customer'),
                            ],
                            'LineItems' => $lineItems,
                            'Date' => $request->input('issue_date'),
                            'ExpiryDate' => $request->input('expiry_date'),
                            'Status' => $request->input('status'),
                            'Title' => $request->input('title'),
                            'Summary' => $request->input('summary'),
                            'Reference' => $request->input('reference'),
                            'Terms' => $request->input('terms'),
                            
                        ],
                    ],
                ];
                
                // Call the Xero API
                //  dd($quoteData);
                $response = $this->updateXeroApi($quoteData, $xeroAccessToken, $quoteID);
                
                if ($response) {
                    // Store the Xero API response in the database
                    $this->updateXeroApiResponse($response, $itemsName, $lineItems);
                    
                    // Fetch the latest Xero data
                    $updatedXeroData = \App\Helpers\Helpers::getXeroContacts($xeroAccessToken);
                    
                    // Update the session with the latest Xero data
                    session(['xero' => $updatedXeroData]);
                    
                    // Success message
                    // Redirect to the showquote page with the updated list of quotes
                    // return redirect()->route('quote')->with('success', 'Quote created successfully in Xero.');
                    return redirect()->back()->with('success', 'Quote updated successfully in Xero.');
                } else {
                    // Error message
                    return redirect()->back()->with('error', 'Failed to create a quote in Xero.')->withInput();
                }
            } else {
                // Error message if Xero access token not found
                
                return redirect()->back()->with('error', 'Xero access token not found.')->withInput();
            }
            
        }
    }
    
    
    private function updateXeroApi($quoteData, $xeroAccessToken, $quoteID)
    {
        try {
            $client = new \GuzzleHttp\Client();
            
            $Response = $client->request('POST', "https://api.xero.com/api.xro/2.0/Quotes/{$quoteID}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'json' => $quoteData,
            ]);
            
            // Handle the Xero API response as needed
            return json_decode($Response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log GuzzleHttp request exceptions
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            
            // Return a user-friendly error response
            return ['error' => 'Failed to send quote to Xero. Please try again. call xero api function' . $e->getMessage()];
        } catch (\Exception $e) {
            // Log other exceptions
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            
            // Return a user-friendly error response
            return ['error' => 'An unexpected error occurred. Please try again. call xero api function'];
        }
    }
    
    private function updateXeroApiResponse($response,$itemsName, $lineItems)
    {
        
        
        $quoteID = $response['Quotes'][0]['QuoteID'];
        $quoteNumber = $response['Quotes'][0]['QuoteNumber'];
        $customerName = $response['Quotes'][0]['Contact']['Name'];
        $issueDate = $response['Quotes'][0]['DateString'];
        $formatedissueDate = \Carbon\Carbon::parse($issueDate)->format('Y-m-d H:i:s');
        $expiryDate = $response['Quotes'][0]['ExpiryDateString'];
        $formatedexpiryDate = \Carbon\Carbon::parse($expiryDate)->format('Y-m-d H:i:s');
        $title = $response['Quotes'][0]['Title'];
        $summary = $response['Quotes'][0]['Summary'];
        $reference = $response['Quotes'][0]['Reference'];
        $currency = $response['Quotes'][0]['CurrencyCode'];
        $terms = $response['Quotes'][0]['Terms'];
        $subtotal = $response['Quotes'][0]['SubTotal'];
        $total = $response['Quotes'][0]['Total'];
        $status = $response['Quotes'][0]['Status'];
        $salesPersonID =  backpack_user()->id;
        $salesPerson =  backpack_user()->name;
        
        $existingQuote = DB::table('quotes')->where('quote_id', $quoteID)->first();
        
        if($existingQuote){
            // Update quotes table
            DB::table('quotes')->where('quote_id', $quoteID)->update([
                'customer'         => $customerName,
                'issue_date'       => $formatedissueDate,
                'expiry_date'      => $formatedexpiryDate,
                'quote_number'     => $quoteNumber,
                'title'            => $title,
                'summary'          => $summary,
                'reference'        => $reference,
                'currency'         => $currency,
                'terms'            => $terms,
                'subtotal'         => $subtotal,
                'total'            => $total,
                'salespersonID'    => $salesPersonID,
                'salespersonName'  => $salesPerson,
                'status'           => $status,
                'updated_at'       => now(),
            ]);
            
            // Update items table
            foreach ($lineItems as $index => $item) {
                DB::table('items')->updateOrInsert(
                    ['quote_id' => $quoteID, 'item_name' => $itemsName[$index]],
                    [
                        'quote_id'      => $quoteID,
                        'item_name'     => $itemsName[$index],
                        'description'   => $item['Description'],
                        'quantity'      => $item['Quantity'],
                        'unit_amount'   => $item['UnitAmount'],
                        'account_code'  => $item['AccountCode'],
                        'lineamount'    => $item['LineAmount'],
                        'created_at'    => now(),
                        'updated_at'    => now(),
                        'item_id'       => $item['ItemID'],
                        'discount'      => $item['DiscountRate'],
                    ]
                    );
            }
            
        }else{
            
            
            $ID = request()->route('id');
            
            DB::table('quotes')->where('id', $ID)->update([
                'customer'         => $customerName,
                'issue_date'       => $formatedissueDate,
                'expiry_date'      => $formatedexpiryDate,
                'quote_number'     => $quoteNumber,
                'title'            => $title,
                'summary'          => $summary,
                'reference'        => $reference,
                'currency'         => $currency,
                'terms'            => $terms,
                'subtotal'         => $subtotal,
                'total'            => $total,
                'salespersonID'    => $salesPersonID,
                'salespersonName'  => $salesPerson,
                'status'           => $status,
                'updated_at'       => now(),
                'quote_id'         => $quoteID,
            ]);
            
            foreach ($lineItems as $index => $item) {
                DB::table('items')->updateOrInsert(
                    ['quote_id' => $ID, 'item_name' => $itemsName[$index]],
                    [
                        'quote_id'      => $quoteID,
                        'item_name'     => $itemsName[$index],
                        'description'   => $item['Description'],
                        'quantity'      => $item['Quantity'],
                        'unit_amount'   => $item['UnitAmount'],
                        'account_code'  => $item['AccountCode'],
                        'lineamount'    => $item['LineAmount'],
                        'created_at'    => now(),
                        'updated_at'    => now(),
                        'item_id'    => $item['ItemID'],
                        'discount'    => $item['DiscountRate'],
                    ]
                    );
            }
            
        }
        
    }
    private function updatefromXeroApiResponse($updatedXeroData)
    {
        
        //dd($updatedXeroData);
        $quotesData = data_get($updatedXeroData, 'quotes', []);
        
        foreach ($quotesData as $quoteData) {
            $quoteID = data_get($quoteData, 'QuoteID');
            $status = data_get($quoteData, 'Status');
            
            // Check if the quote is marked as DELETED in Xero
            if ($status === 'DELETED') {
                // Delete items and quote from the database
                DB::table('items')->where('quote_id', $quoteID)->delete();
                DB::table('quotes')->where('quote_id', $quoteID)->delete();
            } else {
                $quoteNumber = data_get($quoteData, 'QuoteNumber');
                $customerName = data_get($quoteData, 'Contact.Name');
                $issueDate = data_get($quoteData, 'DateString');
                $formatedissueDate = Carbon::parse($issueDate)->format('Y-m-d H:i:s');
                $expiryDate = data_get($quoteData, 'ExpiryDateString');
                $formatedexpiryDate = Carbon::parse($expiryDate)->format('Y-m-d H:i:s');
                $title = data_get($quoteData, 'Title');
                $summary = data_get($quoteData, 'Summary');
                $reference = data_get($quoteData, 'Reference');
                $currency = data_get($quoteData, 'CurrencyCode');
                $terms = data_get($quoteData, 'Terms', ''); // Provide a default value if the key is not present
                $subtotal = data_get($quoteData, 'SubTotal');
                $total = data_get($quoteData, 'Total');
                
                
                // Check if quote ID already exists in the quotes table
                $existingQuote = DB::table('quotes')->where('quote_id', $quoteID)->first();
                
                if ($existingQuote) {
                    // Quote ID exists, update the quotes table
                    DB::table('quotes')->where('quote_id', $quoteID)->update([
                        'customer'         => $customerName,
                        'issue_date'       => $formatedissueDate,
                        'expiry_date'      => $formatedexpiryDate,
                        'quote_number'     => $quoteNumber,
                        'title'            => $title,
                        'summary'          => $summary,
                        'reference'        => $reference,
                        'currency'         => $currency,
                        'terms'            => $terms,
                        'subtotal'         => $subtotal,
                        'total'            => $total,
                        'status'           => $status,
                        'updated_at'       => now(),
                    ]);
                    
                    // Update or insert items table
                    foreach (data_get($quoteData, 'LineItems', []) as $item) {
                        DB::table('items')->updateOrInsert(
                            ['quote_id' => $quoteID, 'description' => data_get($item, 'Description')],
                            [
                                'quote_id'      => $quoteID,
                                'description'   => data_get($item, 'Description'),
                                'quantity'      => data_get($item, 'Quantity'),
                                'unit_amount'   => data_get($item, 'UnitAmount'),
                                'account_code'  => data_get($item, 'AccountCode'),
                                'lineamount'    => data_get($item, 'LineAmount'),
                                'updated_at'    => now(),
                                'discount'    => data_get($item, 'DiscountRate'),
                            ]
                            );
                    }
                } else {
                    // Quote ID does not exist, insert a new record into the quotes table
                    $salesPersonID = backpack_user()->id;
                    $salesPerson = backpack_user()->name;
                    
                    DB::table('quotes')->insert([
                        'quote_id'         => $quoteID,
                        'customer'         => $customerName,
                        'issue_date'       => $formatedissueDate,
                        'expiry_date'      => $formatedexpiryDate,
                        'quote_number'     => $quoteNumber,
                        'title'            => $title,
                        'summary'          => $summary,
                        'reference'        => $reference,
                        'currency'         => $currency,
                        'terms'            => $terms,
                        'subtotal'         => $subtotal,
                        'total'            => $total,
                        'salespersonID'    => $salesPersonID,
                        'salespersonName'  => $salesPerson,
                        'status'           => $status,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);
                    
                    // Insert items into the items table for the new quote
                    foreach (data_get($quoteData, 'LineItems', []) as $item) {
                        DB::table('items')->insert([
                            'quote_id'      => $quoteID,
                            'description'   => data_get($item, 'Description'),
                            'quantity'      => data_get($item, 'Quantity'),
                            'unit_amount'   => data_get($item, 'UnitAmount'),
                            'account_code'  => data_get($item, 'AccountCode'),
                            'lineamount'    => data_get($item, 'LineAmount'),
                            'created_at'    => now(),
                            'updated_at'    => now(),
                            'discount'      => data_get($item, 'DiscountRate'),
                        ]);
                    }
                }
            }
        }
    }
    
    
    public function deleteItem($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            
            return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function deletequote(Request $request, $id)
    
    {
        
        
        $quote =   DB::table('quotes')->where('id', $id)->first();
        
        $quoteID = $quote-> quote_id;
        //$date =  \Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
        //dd($quote);
        
        // Delete items associated with the quote
        DB::table('items')->where('quote_id', $quoteID)->delete();
        
        // Mark the quote as deleted in Xero
        $xeroTokens = session('xero_tokens');
        if (isset($xeroTokens['access_token'])) {
            $xeroAccessToken = $xeroTokens['access_token'];
            
            try {
                $client = new \GuzzleHttp\Client();
                
                $jsonData = [
                    'Quotes' => [
                        [
                            'QuoteNumber' => $quote->quote_number,
                            'Contact' => [
                                'Name' => $quote->customer,
                            ],
                            
                            'Date' => $quote->issue_date,
                            'Status' => 'DELETED',
                            'Title' => $quote->title,
                            'Summary' => $quote->summary,
                            'Reference' => $quote->reference,
                            'Terms' => $quote->terms,
                        ],
                    ],
                ];
                
                
                
                //  dd($jsonData);
                
                $response = $client->request('POST', "https://api.xero.com/api.xro/2.0/Quotes/{$quoteID}", [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $xeroAccessToken,
                        'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json',
                    ],
                    'json' => $jsonData,
                ]);
                
                // Handle the Xero API response as needed
                $xeroResponse = json_decode($response->getBody(), true);
                
                if (isset($xeroResponse['Quotes'][0]['Status']) && $xeroResponse['Quotes'][0]['Status'] === 'DELETED') {
                    // Mark the quote as deleted in your local database
                    DB::table('quotes')->where('quote_id', $quoteID)->update(['status' => 'DELETED']);
                    
                    return redirect()->back()->with('success', 'Quote deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete quote in Xero.')->withInput();
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                \Log::error('Xero API Request Error: ' . $e->getMessage());
                
                return redirect()->back()->with('error', 'Failed to delete quote in Xero.')->withInput();
            }
        } else {
            return redirect()->back()->with('error', 'Xero access token not found.')->withInput();
        }
    }
    
    
    private function updateddatafromxero()
    {
        $updatedXeroData = $this->getXeroData();
        $this->updatefromXeroApiResponse($updatedXeroData);
    }
    
    
    
}
