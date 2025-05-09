<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvoiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use GuzzleHttp\Exception\RequestException;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
        if(isset($xero['contacts'])) {
            // Fetch contacts from the session
            $contactsData = array_column($xero['contacts'], 'Name', 'ContactID');
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
    
    public function store(Request $request)
    {
        $xeroTokens = session('xero_tokens');
        
        // Ensure the access token is present
        if (isset($xeroTokens['access_token'])) {
            $xeroAccessToken = $xeroTokens['access_token'];
            
            // Prepare line items array
            $lineItems = [];
            $itemCount = count($request->input('item_description'));
            
            for ($i = 0; $i < $itemCount; $i++) {
                $lineItems[] = [
                   
                    'ItemID' => $request->input('item_name')[$i],
                    'Description' => $request->input('item_description')[$i],
                    'Quantity' => (int)$request->input('item_quantity')[$i],
                    'UnitAmount' => (float)$request->input('item_price')[$i],
                    'AccountCode' => $request->input('item_account')[$i],
                    "TaxType" => "NONE", // Add tax type if applicable
                    "LineAmount" => $request->input('item_amount')[$i], // Add line amount if applicable
                ];
            }
            
            $invoiceData = [
                'Invoices' => [
                    [
                        "Type" => "ACCREC",
                        'Contact' => [
                            'ContactID' => $request->input('customer'),
                        ],
                        'LineItems' => $lineItems,
                        'Date' => $request->input('issue_date'),
                        'DueDate' => $request->input('expiry_date'),
                        'Reference' => $request->input('reference'),
                    ],
                ],
            ];
            
            // Call the Xero API
            $response = $this->callXeroApi($invoiceData, $xeroAccessToken);
            
            if ($response) {
                // Fetch the latest Xero data
                $updatedXeroData = $this->getXeroContacts($xeroAccessToken);
                
                // Update the session with the latest Xero data
                session(['xero' => $updatedXeroData]);
                // dd(session('xero'));
                
                // Success message
                // Redirect to the showquote page with the updated list of quotes
                return redirect()->route('invoice.showinvoice')->with('success', 'Invoice created successfully in Xero.');
            } else {
                // Error message
                return redirect()->back()->with('error', 'ailed to create an invoice in Xero.')->withInput();
            }
        } else {
            // Error message if Xero access token not found
            return redirect()->back()->with('error', 'Xero access token not found.')->withInput();
        }
           
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
                    'Xero-Tenant-Id' => '9112b615-0c75-4fdd-b802-553560b6183b',
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



public function syncAllInvoices()
{
    $xeroTokens = session('xero_tokens');

    if (!isset($xeroTokens['access_token'])) {
        \Alert::error('Xero access token not found.')->flash();
        return redirect(backpack_url('invoices'));
    }

    $xeroAccessToken = $xeroTokens['access_token'];

    // Sync invoices from App to Xero
    $localInvoices = \App\Models\Invoice::all();
    foreach ($localInvoices as $invoice) {
        $invoiceData = [
            'Invoices' => [
                [
                    'Type' => 'ACCREC',
                    'Contact' => [
                        'ContactID' => $invoice->customer,
                    ],
                    'LineItems' => [
                        [
                            'ItemID' => $invoice->item_id, 
                            'Description' => $invoice->description, 
                            'Quantity' => $invoice->quantity, 
                            'UnitAmount' => $invoice->unit_amount, 
                            'AccountCode' => $invoice->account_code,
                        ],
                    ],
                    'Date' => $invoice->issue_date,
                    'DueDate' => $invoice->due_date,
                    'Reference' => $invoice->reference,
                ],
            ],
        ];

        // Call the Xero API to sync each invoice
        $this->callXeroApi($invoiceData, $xeroAccessToken);
    }

    // Sync invoices from Xero to App
    $updatedXeroData = $this->getXeroContacts($xeroAccessToken);
    $this->updateFromXeroApiResponse($updatedXeroData);

    \Alert::success('All invoices have been synced successfully between App and Xero.')->flash();
    return redirect(backpack_url('invoices'));
}

        
}
