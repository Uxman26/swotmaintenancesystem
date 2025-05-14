<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvoiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use GuzzleHttp\Exception\RequestException;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\Helpers;
/**
 * Class InvoiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InvoiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Invoice::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/invoice');
        CRUD::setEntityNameStrings('invoice', 'invoices');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    
    public function showinvoice()
    {
        // Fetch the latest Xero data
        $updatedXeroData = $this->getXeroData();
        
        // Pass the Xero data to the view
        return view('admin.quote.invoice', ['xero' => $updatedXeroData]);
    }
    
    private function getXeroData()
    {
        $xeroTokens = session('xero_tokens');
        
        // Ensure the access token is present
        if (isset($xeroTokens['access_token'])) {
            $xeroAccessToken = $xeroTokens['access_token'];
            
            // Fetch the latest Xero data
            $updatedXeroData = $this->getXeroContacts($xeroAccessToken);
            
            // Update the session with the latest Xero data
            session(['xero' => $updatedXeroData]);
            
            return $updatedXeroData;
        }
        
        return [];
    }
    
 
    
    public function editinvoice()
    {
        return view('admin.quote.invoiceEdit');
    }
    
    
    protected function setupListOperation()
    {
        CRUD::column('amount_credited');
        CRUD::column('amount_due');
        CRUD::column('amount_paid');
        CRUD::column('branding_theme_id');
        CRUD::column('contact_id');
        CRUD::column('created_at');
        CRUD::column('currency_code');
        CRUD::column('currency_rate');
        CRUD::column('date');
        CRUD::column('due_date');
        CRUD::column('fully_paid_on_date');
        CRUD::column('has_attachments');
        CRUD::column('invoice_number');
        CRUD::column('line_amount_types');
        CRUD::column('online_invoice_url');
        CRUD::column('sent_to_contact');
        CRUD::column('status');
        CRUD::column('subtotal');
        CRUD::column('total');
        CRUD::column('total_tax');
        CRUD::column('type');
        CRUD::column('updated_at');
        CRUD::column('updated_date_utc');
        CRUD::column('xero_contact_id');
        CRUD::column('xero_invoice_id');
        CRUD::column('xero_payment_id');
        $this->crud->addButtonFromView('top', 'sync_all', 'sync_all_invoices', 'end');
        $this->crud->addButtonFromModelFunction('line', 'sync_invoice', 'getSyncInvoiceButton', 'end');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        
        
        $this->crud->setValidation(InvoiceRequest::class);
        
        // Check if 'contacts' parameter is present in the session
        $xero = session('xero');
        if(isset($xero['contacts']) && isset($xero['contacts']['Contacts'])) {
            // Fetch contacts from the session
            $contactsData = array_column($xero['contacts']['Contacts'], 'Name', 'ContactID');
        } else {
            // If not present, initialize an empty array
            $contactsData = [];
        }
        // $contactsData = array_column($xero['contacts'], 'Name', 'ContactID');
       // $projectsData = array_column($xero['projects']['items'], 'name', 'projectId');
        
        // Pass the contacts data to the view
        $this->crud->addField([
            'name'    => 'customer',
            'label'   => 'To',
            'type'    => 'select_from_array',
            'options' => $contactsData,
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
            'name'    => 'reference',
            'label'   => 'Reference',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        
        $this->crud->addField([
            'name'    => 'tax',
            'label'   => 'Tax',
            'type'    => 'select_from_array',
            'options' => [
                'exclusive' => 'Tax Exclusive',
                'inclusive' => 'Tax Inclusive',
                'no_tax'    => 'No Tax',
            ],
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
        
        
        // File Attachment
        $this->crud->addField([
            'name'    => 'attachments',
            'label'   => 'Attachments',
            'type'    => 'upload',
            'upload'  => true,
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);
        
        
    }
    
    // public function store(Request $request)
    // {
    //     $user_id = backpack_user()->id;
        
    //     // Refresh token before attempting the API call
    //     Helpers::refreshAccessToken($user_id);
    //     $xeroTokens = session('xero_tokens');
        
    //     if(empty($xeroTokens)){
    //         $authRedirectUrl = env('XERO_AUTH_REDIRECT_URL') . '?from=' . url()->current();
    //         return redirect($authRedirectUrl);
    //     }

    //     if (isset($xeroTokens['access_token'])) {
    //         $xeroAccessToken = $xeroTokens['access_token'];
            
    //         try {
    //             $lineItems = [];
    //             $itemCount = count($request->input('item_description'));
                
    //             for ($i = 0; $i < $itemCount; $i++) {
    //                 $lineItems[] = [
    //                     'Description' => $request->input('item_description')[$i],
    //                     'Quantity' => (float)$request->input('item_quantity')[$i], // Cast to float for decimal quantities
    //                     'UnitAmount' => (float)$request->input('item_price')[$i],
    //                     'AccountCode' => $request->input('item_account')[$i],
    //                     'TaxType' => "NONE" // Add tax type as required by Xero
    //                 ];
                    
    //                 // Only add ItemID if it exists (for inventory items)
    //                 if (!empty($request->input('item_name')[$i])) {
    //                     $lineItems[$i]['ItemID'] = $request->input('item_name')[$i];
    //                 }
    //             }
                
    //             $invoiceData = [
    //                 'Type' => "ACCREC", // Moved from nested array
    //                 'Contact' => [
    //                     'ContactID' => $request->input('customer'),
    //                 ],
    //                 'LineItems' => $lineItems,
    //                 'Date' => $request->input('issue_date'),
    //                 'DueDate' => $request->input('expiry_date'),
    //                 'Reference' => $request->input('reference'),
    //                 'Status' => 'DRAFT' // Default to DRAFT for safety
    //             ];
                
    //             // Call the Xero API
    //             $response = $this->callXeroApi($invoiceData, $xeroAccessToken);
                
    //             if (isset($response['Invoices']) && !empty($response['Invoices'])) {
    //                 // Success - invoice created
    //                 return redirect()->back()->with('success', 'Invoice created successfully in Xero.');
    //             } else {
    //                 // Some error occurred
    //                 dd($response);
    //                 return redirect()->back()->with('error', 'Failed to create invoice in Xero. Please try again.');
    //             }
                
    //         } catch (\Exception $e) {
    //             // Handle exceptions
    //             dd($e->getMessage());
    //             return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'No valid Xero token available.');
    //     }
    // }

    public function store(Request $request)
{
    $user_id = backpack_user()->id;
    
    // Refresh token before attempting the API call
    Helpers::refreshAccessToken($user_id);
    $xeroTokens = session('xero_tokens');
    
    if(empty($xeroTokens)){
        $authRedirectUrl = env('XERO_AUTH_REDIRECT_URL') . '?from=' . url()->current();
        return redirect($authRedirectUrl);
    }

    if (isset($xeroTokens['access_token'])) {
        $xeroAccessToken = $xeroTokens['access_token'];
        
        try {
            // First save to local database
            $invoice = new \App\Models\Invoice();
            $invoice->contact_id = $request->input('customer');
            $invoice->xero_contact_id = $request->input('xero_contact_id', null);
            $invoice->date = $request->input('issue_date');
            $invoice->due_date = $request->input('expiry_date');
            $invoice->type = 1; // Assuming 1 = ACCREC type in your system
            $invoice->invoice_number = $this->generateInvoiceNumber();
            $invoice->reference = $request->input('reference');
            $invoice->currency_code = $request->input('currency_code', 'USD'); // Default to USD if not provided
            $invoice->status = 12; // Assuming 12 = DRAFT status in your system
            
            // Calculate totals
            $subtotal = 0;
            $total_tax = 0;
            $itemCount = count($request->input('item_description'));
            
            for ($i = 0; $i < $itemCount; $i++) {
                $quantity = (float)$request->input('item_quantity')[$i];
                $unitPrice = (float)$request->input('item_price')[$i];
                $lineTotal = $quantity * $unitPrice;
                $subtotal += $lineTotal;
            }
            
            $invoice->subtotal = $subtotal;
            $invoice->total_tax = $total_tax;
            $invoice->total = $subtotal + $total_tax;
            
            // Save the invoice
            $invoice->save();
            
            // Build line items for both local DB and Xero API
            $xeroLineItems = [];
            for ($i = 0; $i < $itemCount; $i++) {
                // Save line item to local database
                $invoiceLine = new \App\Models\InvoiceLine();
                $invoiceLine->invoice_id = $invoice->id;
                $invoiceLine->description = $request->input('item_description')[$i];
                $invoiceLine->quantity = (float)$request->input('item_quantity')[$i];
                $invoiceLine->unit_price = (float)$request->input('item_price')[$i];
                $invoiceLine->account_code = $request->input('item_account')[$i];
                $invoiceLine->item_id = $request->input('item_name')[$i] ?? null;
                $invoiceLine->line_amount = $invoiceLine->quantity * $invoiceLine->unit_price;
                $invoiceLine->save();
                
                // Build Xero line item
                $xeroLineItem = [
                    'Description' => $request->input('item_description')[$i],
                    'Quantity' => (float)$request->input('item_quantity')[$i],
                    'UnitAmount' => (float)$request->input('item_price')[$i],
                    'AccountCode' => $request->input('item_account')[$i],
                    'TaxType' => "NONE"
                ];
                
                // Only add ItemID if it exists (for inventory items)
                if (!empty($request->input('item_name')[$i])) {
                    $xeroLineItem['ItemID'] = $request->input('item_name')[$i];
                }
                
                $xeroLineItems[] = $xeroLineItem;
            }
            
            // Build Xero invoice data
            $invoiceData = [
                'Type' => "ACCREC",
                'Contact' => [
                    'ContactID' => $request->input('customer'),
                ],
                'LineItems' => $xeroLineItems,
                'Date' => $request->input('issue_date'),
                'DueDate' => $request->input('expiry_date'),
                'Reference' => $request->input('reference'),
                'Status' => 'DRAFT'
            ];
            
            // Call the Xero API
            $response = $this->callXeroApi($invoiceData, $xeroAccessToken);
            
            if (isset($response['Invoices']) && !empty($response['Invoices'])) {
                // Success - invoice created in Xero
                // Update local invoice with Xero invoice ID
                $xeroInvoiceId = $response['Invoices'][0]['InvoiceID'] ?? null;
                
                if ($xeroInvoiceId) {
                    $invoice->xero_invoice_id = $xeroInvoiceId;
                    $invoice->save();
                }
                
                return redirect()->back()->with('success', 'Invoice created successfully in both systems.');
            } else {
                // Xero API failed but local DB succeeded
                return redirect()->back()->with('warning', 'Invoice saved locally but failed to sync with Xero.');
            }
            
        } catch (\Exception $e) {
            // Handle exceptions
            \Log::error('Invoice creation error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    } else {
        return redirect()->back()->with('error', 'No valid Xero token available.');
    }
}

/**
 * Generate a unique invoice number
 * 
 * @return string
 */
private function generateInvoiceNumber()
{
    // Get the latest invoice number
    $latestInvoice = \App\Models\Invoice::orderBy('id', 'desc')->first();
    
    if (!$latestInvoice) {
        // No invoices yet, start with INV-0001
        return 'INV-0001';
    }
    
    // Get the numeric part of the latest invoice number
    $latestNumber = $latestInvoice->invoice_number;
    
    if (preg_match('/INV-(\d+)/', $latestNumber, $matches)) {
        $number = (int)$matches[1];
        $number++;
        return 'INV-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
    
    // Fallback - use timestamp
    return 'INV-' . date('YmdHis');
}
    
    
    private function getXeroContacts($xeroAccessToken)
    {
        try {
            $client = new \GuzzleHttp\Client();
            
            // Fetch contacts
            $contactsResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Contacts', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => '9112b615-0c75-4fdd-b802-553560b6183b',
                    'Accept'        => 'application/json',
                ],
            ]);
            
            $contactsArray = json_decode($contactsResponse->getBody(), true);
            
            // Log or dump the entire response to understand its structure
            \Log::info('Xero API Response:', ['response' => $contactsArray]);
            
            // Check if 'Contacts' key exists in the response
            if (array_key_exists('Contacts', $contactsArray)) {
                $contacts = $contactsArray['Contacts'];
                
                // Fetch projects
                $projectsResponse = $client->request('GET', 'https://api.xero.com/projects.xro/2.0/Projects', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $xeroAccessToken,
                        'Xero-Tenant-Id' => '9112b615-0c75-4fdd-b802-553560b6183b',
                        'Accept'        => 'application/json',
                    ],
                ]);
                
                $projects = json_decode($projectsResponse->getBody(), true);
                
                // Fetch items
                $itemsResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Items', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $xeroAccessToken,
                        'Xero-Tenant-Id' => '9112b615-0c75-4fdd-b802-553560b6183b',
                        'Accept'        => 'application/json',
                    ],
                ]);
                
                $items = json_decode($itemsResponse->getBody(), true);
                
                
                // Fetch quotes
                $quotesResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Quotes', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $xeroAccessToken,
                        'Xero-Tenant-Id' => '9112b615-0c75-4fdd-b802-553560b6183b',
                        'Accept'        => 'application/json',
                    ],
                ]);
                
                $quotes = json_decode($quotesResponse->getBody(), true);
                
                // Fetch invoice
                $invoiceResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Invoices', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $xeroAccessToken,
                        'Xero-Tenant-Id' => '9112b615-0c75-4fdd-b802-553560b6183b',
                        'Accept'        => 'application/json',
                    ],
                ]);
                
                $invoices = json_decode($invoiceResponse->getBody(), true);
                
                return [
                    'contacts' => $contacts,
                    'projects' => $projects,
                    'items' => $items,
                    'quotes' => $quotes,
                    'invoices' => $invoices,
                    
                ];
            } else {
                // Log an error or handle the absence of 'Contacts' key
                \Log::error('Contacts key not found in Xero API response.', ['response' => $contactsArray]);
                return [];
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log or handle the error as needed
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            return [];
        } catch (\Exception $e) {
            // Log any other unexpected exceptions
            \Log::error('Unexpected Error: ' . $e->getMessage());
            return [];
        }
    }
    
    
    
    private function callXeroApi($quoteData, $xeroAccessToken)
    {
        
        
        
        
        // dd($jsonQuoteData);
        
        try {
            $client = new \GuzzleHttp\Client();
            
            $Response = $client->request('POST', 'https://api.xero.com/api.xro/2.0/Invoices', [
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
            return ['error' => 'Failed to send invoice to Xero. Please try again. call xero api function' . $e->getMessage()];
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
        
    }

    public function syncInvoiceWithXero($id)
{
    $xeroTokens = session('xero_tokens');
    
    if (!isset($xeroTokens['access_token'])) {
        \Alert::error('Xero access token not found.')->flash();
        return redirect(backpack_url('invoices'));
    }

    $xeroAccessToken = $xeroTokens['access_token'];

    // Fetch the invoice from the database
    $invoice = \App\Models\Invoice::find($id);

    if (!$invoice) {
        \Alert::error('Invoice not found.')->flash();
        return redirect(backpack_url('invoices'));
    }

    // Prepare the data to be sent to Xero
    $invoiceData = [
        'Invoices' => [
            [
                'Type' => 'ACCREC', // For receivable invoices
                'Contact' => [
                    'ContactID' => $invoice->customer, // Assuming 'customer' stores Xero's ContactID
                ],
                'LineItems' => [
                    [
                        'ItemID' => $invoice->item_id, // Replace with actual item field
                        'Description' => $invoice->description, // Replace with actual description field
                        'Quantity' => $invoice->quantity, // Replace with actual quantity
                        'UnitAmount' => $invoice->unit_amount, // Replace with actual amount
                        'AccountCode' => $invoice->account_code, // Replace with account code
                    ],
                ],
                'Date' => $invoice->issue_date,
                'DueDate' => $invoice->due_date,
                'Reference' => $invoice->reference,
            ],
        ],
    ];

    // Call the Xero API to sync the invoice
    $response = $this->callXeroApi($invoiceData, $xeroAccessToken);

    if ($response) {
        \Alert::success('Invoice synced successfully with Xero.')->flash();
    } else {
        \Alert::error('Failed to sync the invoice with Xero.')->flash();
    }

    return redirect(backpack_url('invoices'));
}



// public function syncAllInvoices()
// {
//     $xeroTokens = session('xero_tokens');

//     if (!isset($xeroTokens['access_token'])) {
//         \Alert::error('Xero access token not found.')->flash();
//         return redirect(backpack_url('invoices'));
//     }

//     $xeroAccessToken = $xeroTokens['access_token'];

//     // Sync invoices from App to Xero
//     $localInvoices = \App\Models\Invoice::all();
//     foreach ($localInvoices as $invoice) {
//         $invoiceData = [
//             'Invoices' => [
//                 [
//                     'Type' => 'ACCREC',
//                     'Contact' => [
//                         'ContactID' => $invoice->customer,
//                     ],
//                     'LineItems' => [
//                         [
//                             'ItemID' => $invoice->item_id, 
//                             'Description' => $invoice->description, 
//                             'Quantity' => $invoice->quantity, 
//                             'UnitAmount' => $invoice->unit_amount, 
//                             'AccountCode' => $invoice->account_code,
//                         ],
//                     ],
//                     'Date' => $invoice->issue_date,
//                     'DueDate' => $invoice->due_date,
//                     'Reference' => $invoice->reference,
//                 ],
//             ],
//         ];

//         // Call the Xero API to sync each invoice
//         $this->callXeroApi($invoiceData, $xeroAccessToken);
//     }

//     // Sync invoices from Xero to App
//     $updatedXeroData = $this->getXeroContacts($xeroAccessToken);
//     $this->updateFromXeroApiResponse($updatedXeroData);

//     \Alert::success('All invoices have been synced successfully between App and Xero.')->flash();
//     return redirect(backpack_url('invoices'));
// }

/**
 * Sync invoices between local database and Xero
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function syncAllInvoices()
{
    $user_id = backpack_user()->id;
    
    try {
        // Refresh token before attempting the API call
        Helpers::refreshAccessToken($user_id);
        $xeroTokens = session('xero_tokens');
        
        if (!isset($xeroTokens['access_token'])) {
            \Alert::error('Xero access token not found.')->flash();
            return redirect(backpack_url('invoices'));
        }
        
        $xeroAccessToken = $xeroTokens['access_token'];
        $tenant_id = session('xero_tenant_id', env('XERO_TENANT_ID'));
        
        if (empty($tenant_id)) {
            \Alert::error('Xero tenant ID not found.')->flash();
            return redirect(backpack_url('invoices'));
        }
        
        // 1. First, pull invoices from Xero to local DB
        $this->syncFromXeroToLocal($xeroAccessToken, $tenant_id);
        
        // 2. Then, push local invoices to Xero that don't have a Xero ID yet
        $this->syncFromLocalToXero($xeroAccessToken, $tenant_id);
        
        \Alert::success('All invoices have been synced successfully between your app and Xero.')->flash();
        return redirect(backpack_url('invoices'));
        
    } catch (\Exception $e) {
        \Log::error('Invoice sync error', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        \Alert::error('Error syncing invoices: ' . $e->getMessage())->flash();
        return redirect(backpack_url('invoices'));
    }
}

/**
 * Pull invoices from Xero and save them to local database
 *
 * @param string $accessToken
 * @param string $tenantId
 * @return void
 */
private function syncFromXeroToLocal($accessToken, $tenantId)
{
    // Get all invoices from Xero
    $client = new \GuzzleHttp\Client();
    
    try {
        $response = $client->request(
            'GET',
            'https://api.xero.com/api.xro/2.0/Invoices',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Xero-tenant-id' => $tenantId,
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'where' => 'Type=="ACCREC"',  // Only get sales invoices
                    'order' => 'Date DESC',
                    'page' => 1
                ]
            ]
        );
        
        $responseData = json_decode($response->getBody()->getContents(), true);
        
        if (!isset($responseData['Invoices']) || empty($responseData['Invoices'])) {
            \Log::info('No invoices found in Xero');
            return;
        }
        
        $syncCount = 0;
        
        foreach ($responseData['Invoices'] as $xeroInvoice) {
            // Check if we already have this invoice in our system
            $existingInvoice = \App\Models\Invoice::where('xero_invoice_id', $xeroInvoice['InvoiceID'])->first();
            
            if ($existingInvoice) {
                // Update existing invoice
                $this->updateLocalInvoiceFromXero($existingInvoice, $xeroInvoice);
            } else {
                // Create new invoice
                $this->createLocalInvoiceFromXero($xeroInvoice);
            }
            
            $syncCount++;
        }
        
        \Log::info("Synced $syncCount invoices from Xero to local database");
        
    } catch (\Exception $e) {
        \Log::error('Error pulling invoices from Xero', [
            'message' => $e->getMessage()
        ]);
        throw $e;
    }
}

/**
 * Push local invoices to Xero that don't have a Xero ID
 *
 * @param string $accessToken
 * @param string $tenantId
 * @return void
 */
private function syncFromLocalToXero($accessToken, $tenantId)
{
    // Get all invoices that don't have a Xero ID
    $localInvoices = \App\Models\Invoice::whereNull('xero_invoice_id')
                        ->orWhere('xero_invoice_id', '')
                        ->get();
    
    if ($localInvoices->isEmpty()) {
        \Log::info('No local invoices found to sync to Xero');
        return;
    }
    
    $syncCount = 0;
    
    foreach ($localInvoices as $invoice) {
        try {
            // Get invoice line items
            $lineItems = \App\Models\InvoiceLine::where('invoice_id', $invoice->id)->get();
            
            if ($lineItems->isEmpty()) {
                \Log::warning("Invoice #{$invoice->id} has no line items, skipping");
                continue;
            }
            
            // Format line items for Xero
            $xeroLineItems = [];
            foreach ($lineItems as $line) {
                $lineItem = [
                    'Description' => $line->description,
                    'Quantity' => (float)$line->quantity,
                    'UnitAmount' => (float)$line->unit_price,
                    'AccountCode' => $line->account_code,
                    'TaxType' => 'NONE'
                ];
                
                // Only add ItemID if it exists
                if (!empty($line->item_id)) {
                    $lineItem['ItemID'] = $line->item_id;
                }
                
                $xeroLineItems[] = $lineItem;
            }
            
            // Build invoice data for Xero
            $invoiceData = [
                'Type' => 'ACCREC',
                'Contact' => [
                    'ContactID' => $invoice->xero_contact_id ?? $invoice->contact_id
                ],
                'LineItems' => $xeroLineItems,
                'Date' => $invoice->date,
                'DueDate' => $invoice->due_date,
                'Reference' => $invoice->reference,
                'InvoiceNumber' => $invoice->invoice_number,
                'Status' => $this->mapStatusToXero($invoice->status)
            ];
            
            // Call Xero API to create invoice
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'POST',
                'https://api.xero.com/api.xro/2.0/Invoices',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Xero-tenant-id' => $tenantId,
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $invoiceData
                ]
            );
            
            $responseData = json_decode($response->getBody()->getContents(), true);
            
            if (isset($responseData['Invoices'][0]['InvoiceID'])) {
                // Update local invoice with Xero ID
                $invoice->xero_invoice_id = $responseData['Invoices'][0]['InvoiceID'];
                $invoice->save();
                $syncCount++;
            }
            
        } catch (\Exception $e) {
            \Log::error("Error syncing invoice #{$invoice->id} to Xero", [
                'message' => $e->getMessage()
            ]);
            // Continue with next invoice
        }
    }
    
    \Log::info("Synced $syncCount invoices from local database to Xero");
}

/**
 * Update existing local invoice with data from Xero
 *
 * @param \App\Models\Invoice $localInvoice
 * @param array $xeroInvoice
 * @return void
 */
private function updateLocalInvoiceFromXero($localInvoice, $xeroInvoice)
{
    // Update basic invoice details
    $localInvoice->xero_invoice_id = $xeroInvoice['InvoiceID'];
    $localInvoice->invoice_number = $xeroInvoice['InvoiceNumber'];
    $localInvoice->xero_contact_id = $xeroInvoice['Contact']['ContactID'];
    $localInvoice->date = $xeroInvoice['Date'];
    $localInvoice->due_date = $xeroInvoice['DueDate'];
    $localInvoice->reference = $xeroInvoice['Reference'] ?? null;
    $localInvoice->status = $this->mapXeroStatus($xeroInvoice['Status']);
    $localInvoice->subtotal = $xeroInvoice['SubTotal'];
    $localInvoice->total_tax = $xeroInvoice['TotalTax'];
    $localInvoice->total = $xeroInvoice['Total'];
    $localInvoice->currency_code = $xeroInvoice['CurrencyCode'];
    
    // Save the invoice
    $localInvoice->save();
    
    // Delete existing line items and recreate them
    \App\Models\InvoiceLine::where('invoice_id', $localInvoice->id)->delete();
    
    // Create new line items from Xero data
    if (isset($xeroInvoice['LineItems']) && !empty($xeroInvoice['LineItems'])) {
        foreach ($xeroInvoice['LineItems'] as $xeroLineItem) {
            $lineItem = new \App\Models\InvoiceLine();
            $lineItem->invoice_id = $localInvoice->id;
            $lineItem->description = $xeroLineItem['Description'];
            $lineItem->quantity = $xeroLineItem['Quantity'];
            $lineItem->unit_price = $xeroLineItem['UnitAmount'];
            $lineItem->line_amount = $xeroLineItem['LineAmount'];
            $lineItem->account_code = $xeroLineItem['AccountCode'] ?? null;
            $lineItem->item_id = $xeroLineItem['ItemID'] ?? null;
            $lineItem->save();
        }
    }
}

/**
 * Create a new local invoice from Xero data
 *
 * @param array $xeroInvoice
 * @return void
 */
private function createLocalInvoiceFromXero($xeroInvoice)
{
    // Create a new invoice
    $invoice = new \App\Models\Invoice();
    $invoice->xero_invoice_id = $xeroInvoice['InvoiceID'];
    $invoice->invoice_number = $xeroInvoice['InvoiceNumber'];
    $invoice->xero_contact_id = $xeroInvoice['Contact']['ContactID'];
    
    // Try to match the Xero contact with a local contact
    $contact = \App\Models\Contact::where('xero_contact_id', $xeroInvoice['Contact']['ContactID'])->first();
    if ($contact) {
        $invoice->contact_id = $contact->id;
    }
    
    $invoice->date = $xeroInvoice['Date'];
    $invoice->due_date = $xeroInvoice['DueDate'];
    $invoice->reference = $xeroInvoice['Reference'] ?? null;
    $invoice->status = $this->mapXeroStatus($xeroInvoice['Status']);
    $invoice->type = 1; // ACCREC type
    $invoice->subtotal = $xeroInvoice['SubTotal'];
    $invoice->total_tax = $xeroInvoice['TotalTax'];
    $invoice->total = $xeroInvoice['Total'];
    $invoice->currency_code = $xeroInvoice['CurrencyCode'];
    
    // Save the invoice
    $invoice->save();
    
    // Create line items
    if (isset($xeroInvoice['LineItems']) && !empty($xeroInvoice['LineItems'])) {
        foreach ($xeroInvoice['LineItems'] as $xeroLineItem) {
            $lineItem = new \App\Models\InvoiceLine();
            $lineItem->invoice_id = $invoice->id;
            $lineItem->description = $xeroLineItem['Description'];
            $lineItem->quantity = $xeroLineItem['Quantity'];
            $lineItem->unit_price = $xeroLineItem['UnitAmount'];
            $lineItem->line_amount = $xeroLineItem['LineAmount'];
            $lineItem->account_code = $xeroLineItem['AccountCode'] ?? null;
            $lineItem->item_id = $xeroLineItem['ItemID'] ?? null;
            $lineItem->save();
        }
    }
}

/**
 * Map Xero status to local status code
 *
 * @param string $xeroStatus
 * @return int
 */
private function mapXeroStatus($xeroStatus)
{
    $statusMap = [
        'DRAFT' => 12,
        'SUBMITTED' => 13,
        'AUTHORISED' => 14,
        'PAID' => 15,
        'VOIDED' => 16,
        'DELETED' => 17,
    ];
    
    return $statusMap[$xeroStatus] ?? 12; // Default to DRAFT
}

/**
 * Map local status code to Xero status
 *
 * @param int $localStatus
 * @return string
 */
private function mapStatusToXero($localStatus)
{
    $statusMap = [
        12 => 'DRAFT',
        13 => 'SUBMITTED',
        14 => 'AUTHORISED',
        15 => 'PAID',
        16 => 'VOIDED',
        17 => 'DELETED',
    ];
    
    return $statusMap[$localStatus] ?? 'DRAFT'; // Default to DRAFT
}
        
}
