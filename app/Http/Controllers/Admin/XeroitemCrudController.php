<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\XeroitemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class XeroitemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class XeroitemCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Xeroitem::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/xeroitem');
        CRUD::setEntityNameStrings('Item', 'Items');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        
        $this->updateddatafromxero();
        
        $this->crud->addColumn([
            'name'    => 'code',
            'label'   => 'Code',
            'type'    => 'text',
        ]);
        
        $this->crud->addColumn([
            'name'    => 'item-name',
            'label'   => 'Name',
            'type'    => 'text',
        ]);
        
        $this->crud->addColumn([
            'name'    => 'cost-price',
            'label'   => 'Cost Price',
            'type'    => 'text',
        ]);
        
        
        $this->crud->addColumn([
            'name'    => 'purchase-tax',
            'label'   => 'Purchase Tax Rate',
            'type'    => 'text',
            
        ]);
        
        $this->crud->addColumn([
            'name'    => 'purchase-description',
            'label'   => 'Purchase Description',
            'type'    => 'text',
        ]);
        
        $this->crud->addColumn([
            'name'    => 'sell-price',
            'label'   => 'Sell Price',
            'type'    => 'text',
        ]);
        
        $this->crud->addColumn([
            'name'    => 'sales-account',
            'label'   => 'Sales Account',
            'type'    => 'text',
            
        ]);
        
        $this->crud->addColumn([
            'name'    => 'sales-tax',
            'label'   => 'Sales Tax Rate',
            'type'    => 'text',
            
        ]);
        
        $this->crud->addColumn([
            'name'    => 'sales-description',
            'label'   => 'Sales Description',
            'type'    => 'text',
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
        $this->updateddatafromxero();
        
        $xero = session('xero');
        //dd($xero);
        
       
        
        if (empty($xero['accounts'])) {
            
            
            $authRedirectUrl = env('XERO_AUTH_REDIRECT_URL') . '?from=' . url()->current();
            
            header('Location: ' . $authRedirectUrl);
            exit();
        }
        $accountData = array_column($xero['accounts']['Accounts'], null, 'Code');
        $taxData = array_column($xero['taxes']['TaxRates'], 'Name', 'TaxType');
        
        $options = [];
        foreach ($accountData as $code => $account) {
            $options[$code] = $account['Name'] . ' - ' . $code;
        }
        
        $this->crud->addField([
            'name'    => 'item-id',
            'label'   => 'Item',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        $this->crud->addField([
            'name'    => 'code',
            'label'   => 'Code (required)',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        
      
        $this->crud->addField([
            'name'    => 'item-name',
            'label'   => 'Name',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        
        $this->crud->addField([
            'name'    => 'cost-price',
            'label'   => 'Cost Price',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        

      
        $this->crud->addField([
            'name'    => 'purchase-account',
            'label'   => 'Purchase Account',
            'type'    => 'select_from_array',
            'options' => $options,
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        
        $this->crud->addField([
            'name'    => 'purchase-tax-rate',
            'label'   => 'Tax Rate',
            'type'    => 'select_from_array',
            'options' => $taxData,
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        
        $this->crud->addField([
            'name'    => 'purchase-description',
            'label'   => 'Description',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);
        
        
        $this->crud->addField([
            'name'    => 'sell-price',
            'label'   => 'Sell Price',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        
        
        
        $this->crud->addField([
            'name'    => 'sales-account',
            'label'   => 'Sales Account',
            'type'    => 'select_from_array',
            'options' => $options,
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        
        $this->crud->addField([
            'name'    => 'sales-tax-rate',
            'label'   => 'Tax Rate',
            'type'    => 'select_from_array',
            'options' => $taxData,
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);
        
        $this->crud->addField([
            'name'    => 'sales-description',
            'label'   => 'Description',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);
        
    }
    
    
    
    public function store(Request $request)
    {
        $xeroTokens = session('xero_tokens');
        
        if(empty($xeroTokens)){
            
            $authRedirectUrl = env('XERO_AUTH_REDIRECT_URL') . '?from=' . url()->current();
            
            header('Location: ' . $authRedirectUrl);
        }
        // Ensure the access token is present
        if (isset($xeroTokens['access_token'])) {
            $xeroAccessToken = $xeroTokens['access_token'];
            
            
            $itemData = [
                'Items' => [
                    [
                        
                        'Code' => $request->input('code'),
                        'Name' => $request->input('item-name'),
                        'Description' => $request->input('sales-description'),
                        'PurchaseDescription' => $request->input('purchase-description'),
                        
                        'PurchaseDetails' => [
                            'UnitPrice' => $request->input('cost-price'),
                            'AccountCode' => $request->input('purchase-account'),
                            'TaxType' => $request->input('purchase-tax-rate'),
                        ],
                        
                        
                        'SalesDetails' => [
                            'UnitPrice' => $request->input('sell-price'),
                            'AccountCode' => $request->input('sales-account'),
                            'TaxType' => $request->input('sales-text-rate'),
                        ],
                        
                        
                    ],
                ],
            ];
            
            // Call the Xero API
            $response = $this->callXeroApi( $itemData, $xeroAccessToken);
            
            //   dd($response);
            
            if ($response) {
                // Store the Xero API response in the database
                $this->storeXeroApiResponse($response);
                
                // Fetch the latest Xero data
                // $updatedXeroData = $this->getXeroContacts($xeroAccessToken);
                
                // Update the session with the latest Xero data
                //  session(['xero' => $updatedXeroData]);
                
                // Success message
                // Redirect to the showquote page with the updated list of quotes
                //  return redirect()->route('quote')->with('success', 'Quote created successfully in Xero.');
                return redirect()->back()->with('success', 'Item created successfully in Xero.');
                
            } else {
                // Error message
                return redirect()->back()->with('error', 'Failed to create a item in Xero.')->withInput();
            }
        } else {
            // Error message if Xero access token not found
            return redirect()->back()->with('error', 'Xero access token not found.')->withInput();
        }
        
        
    }
    
    /**
     * Store Xero API response in the database.
     *
     * @param array $response
     * @return void
     */
    
    private function storeXeroApiResponse($response)
    {
     //   dd($response);
        $itemID = $response['Items'][0]['ItemID'];
        $Code = $response['Items'][0]['Code'];
        $Name = $response['Items'][0]['Name'];
        $description = $response['Items'][0]['Description'];
        $purchaseDescription = $response['Items'][0]['PurchaseDescription'];
        $costPrice = $response['Items'][0]['PurchaseDetails'] ['UnitPrice'];
        $purchaseAccount = $response['Items'][0]['PurchaseDetails'] ['AccountCode'];
        $purchaseTax = $response['Items'][0]['PurchaseDetails'] ['TaxType'];
        $sellPrice = $response['Items'][0]['SalesDetails'] ['UnitPrice'];
        $salesAccount = $response['Items'][0] ['SalesDetails']['AccountCode'];
        $salesTax = $response['Items'][0] ['SalesDetails'] ['TaxType'];
        $salesPersonID = backpack_user()->id;
        $salesPerson = backpack_user()->name;
        
        
        DB::table('xeroitems')->insert([
            'item-id'               => $itemID,
            'code'                  => $Code,
            'item-name'             => $Name,
            'sales-description'     => $description,
            'purchase-description'  => $purchaseDescription,
            'cost-price'            => $costPrice,
            'purchase-account'      => $purchaseAccount,
            'purchase-tax'          => $purchaseTax,
            'sell-price'            => $sellPrice,
            'sales-account'         => $salesAccount,
            'sales-tax'             => $salesTax,
            'created_by'            => $salesPerson,
            'created_by_id'         => $salesPersonID,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        
    }
    
    private function callXeroApi($itemData, $xeroAccessToken)
    {
        
       
        
        try {
            $client = new \GuzzleHttp\Client();
            
            $Response = $client->request('POST', 'https://api.xero.com/api.xro/2.0/Items', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'json' =>  $itemData,
            ]);
            
            // Handle the Xero API response as needed
            return json_decode($Response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log GuzzleHttp request exceptions
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            
            // Return a user-friendly error response
            return ['error' => 'Failed to send items to Xero. Please try again. call xero api function' . $e->getMessage()];
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
    
    
    private function getXeroData()
    {
        $xeroTokens = session('xero_tokens');
        
        // Ensure the access token is present
        if (isset($xeroTokens['access_token'])) {
            $xeroAccessToken = $xeroTokens['access_token'];
            
            // Fetch the latest Xero data
            $updatedXeroData = $this->getXeroItems($xeroAccessToken);
            
            // Update the session with the latest Xero data
            session(['xero' => $updatedXeroData]);
            
            return $updatedXeroData;
        }
        
        return [];
    }
    
    
    private function getXeroItems($xeroAccessToken)
    {
        try {
            $client = new \GuzzleHttp\Client();
            // Fetch items
            $itemsResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Items', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                ],
            ]);
            
            $items = json_decode($itemsResponse->getBody(), true);
            
            // Fetch item account codes
            $accountsResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Accounts', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                ],
            ]);
            
            
            $accounts = json_decode($accountsResponse->getBody(), true);
            
            // Fetch tax rates
            $taxesResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/TaxRates', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                ],
            ]);
            
            
            $taxes = json_decode($taxesResponse->getBody(), true);
            return [
                
                'items' => $items,
                'accounts' => $accounts,
                'taxes' => $taxes,
            ];
            
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log or handle the error as needed
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            return [];
            
        }
    }
    
    private function updateddatafromxero()
    {
        $updatedXeroData = $this->getXeroData();
        $this->updatefromXeroApiResponse($updatedXeroData);
    }
    
    
    private function updatefromXeroApiResponse($updatedXeroData)
    {
        $itemsData = data_get($updatedXeroData, 'items.Items', []);
        
        foreach ($itemsData as $itemData) {
            
                $itemID = data_get($itemData, 'ItemID');
                $code = data_get($itemData, 'Code');
                $name = data_get($itemData, 'Name');             
                $description = data_get($itemData, 'Description');
                $purchaseDescription = data_get($itemData, 'PurchaseDescription');
                $costPrice = data_get($itemData, 'PurchaseDetails.UnitPrice');
                $purchaseAccount= data_get($itemData, 'PurchaseDetails.AccountCode');     
                $purchaseTax = data_get($itemData, 'PurchaseDetails.TaxType');
                $salesPrice = data_get($itemData, 'SalesDetails.UnitPrice');
                $salesAccount= data_get($itemData, 'SalesDetails.AccountCode');
                $salesTax = data_get($itemData, 'SalesDetails.TaxType');
                $salesPersonID = backpack_user()->id;
                $salesPerson = backpack_user()->name;
                
                
                
                // Check if quote ID already exists in the quotes table
                $existingQuote = DB::table('xeroitems')->where('item-id', $itemID)->first();
                
                if ($existingQuote) { 
                    // Quote ID exists, update the quotes table
                    DB::table('xeroitems')->where('item-id', $itemID)->update([
                        'code'                     => $code,
                        'item-name'                => $name,
                        'sales-description'        => $description,
                        'purchase-description'     => $purchaseDescription,
                        'cost-price'               => $costPrice,
                        'purchase-account'         => $purchaseAccount,
                        'purchase-tax'             => $purchaseTax,
                        'sell-price'               => $salesPrice,
                        'sales-account'            => $salesAccount,
                        'sales-tax'                => $salesTax,                    
                        'updated_at'               => now(),
                    ]);
                    

                } else {
                    // Quote ID does not exist, insert a new record into the quotes table
                    DB::table('xeroitems')->insert([
                        'item-id'                  => $itemID,
                        'code'                     => $code,
                        'item-name'                => $name,
                        'sales-description'        => $description,
                        'purchase-description'     => $purchaseDescription,
                        'cost-price'               => $costPrice,
                        'purchase-account'         => $purchaseAccount,
                        'purchase-tax'             => $purchaseTax,
                        'sell-price'               => $salesPrice,
                        'sales-account'            => $salesAccount,
                        'sales-tax'                => $salesTax,
                        'created_by'               => $salesPerson,
                        'created_by_id'            => $salesPersonID,
                        'created_at'               => now(),
                        'updated_at'               => now(),
                    ]);
                    
                }
        }
        
                
    }
    
    
    
    
 
    protected function setupUpdateOperation()
    {
        
        $this->setupCreateOperation();
        
    }
    
    
    
    public function update(Request $request)
    {
        $xeroTokens = session('xero_tokens');
        // Ensure the access token is present
        if (isset($xeroTokens['access_token'])) {
            $xeroAccessToken = $xeroTokens['access_token'];
            $itemID = $request->input('item-id');
            
            $itemData = [
                'Items' => [
                    [
                        
                        'Code' => $request->input('code'),
                        'Name' => $request->input('item-name'),
                        'Description' => $request->input('sales-description'),
                        'PurchaseDescription' => $request->input('purchase-description'),
                        
                        'PurchaseDetails' => [
                            'UnitPrice' => $request->input('cost-price'),
                            'AccountCode' => $request->input('purchase-account'),
                            'TaxType' => $request->input('purchase-tax-rate'),
                        ],
                        
                        
                        'SalesDetails' => [
                            'UnitPrice' => $request->input('sell-price'),
                            'AccountCode' => $request->input('sales-account'),
                            'TaxType' => $request->input('sales-text-rate'),
                        ],
                        
                        
                    ],
                ],
            ];
                // Call the Xero API
                //  dd($quoteData);
            $response = $this->updateXeroApi($itemData, $xeroAccessToken, $itemID);
                
                if ($response) {
                    // Store the Xero API response in the database
                    $this->updateXeroApiResponse($response);
                    
                    // Fetch the latest Xero data
                    $updatedXeroData = $this->getXeroItems($xeroAccessToken);
                    
                    // Update the session with the latest Xero data
                    session(['xero' => $updatedXeroData]);
                    
                    // Success message
                    // Redirect to the showquote page with the updated list of quotes
                    // return redirect()->route('quote')->with('success', 'Quote created successfully in Xero.');
                    return redirect()->back()->with('success', 'Item updated successfully in Xero.');
                } else {
                    // Error message
                    return redirect()->back()->with('error', 'Failed to create a Item in Xero.')->withInput();
                }
            } else {
                // Error message if Xero access token not found
                
                return redirect()->back()->with('error', 'Xero access token not found.')->withInput();
            }
            
        
    }
    
    private function updateXeroApi($itemData, $xeroAccessToken, $itemID)
    {
        try {
            $client = new \GuzzleHttp\Client();
            
            $Response = $client->request('POST', "https://api.xero.com/api.xro/2.0/Items/{$itemID}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'json' => $itemData,
            ]);
            
            // Handle the Xero API response as needed
            return json_decode($Response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log GuzzleHttp request exceptions
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            
            // Return a user-friendly error response
            return ['error' => 'Failed to send item to Xero. Please try again. call xero api function' . $e->getMessage()];
        } catch (\Exception $e) {
            // Log other exceptions
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            
            // Return a user-friendly error response
            return ['error' => 'An unexpected error occurred. Please try again. call xero api function'];
        }
    }
    
    private function updateXeroApiResponse($response)
    {
        // dd($response);
        
        $itemID = $response['Items'][0]['ItemID'];
        $Code = $response['Items'][0]['Code'];
        $Name = $response['Items'][0]['Name'];
        $description = $response['Items'][0]['Description'];
        $purchaseDescription = $response['Items'][0]['PurchaseDescription'];
        $costPrice = $response['Items'][0]['PurchaseDetails'] ['UnitPrice'];
        $purchaseAccount = $response['Items'][0]['PurchaseDetails'] ['AccountCode'];
        $purchaseTax = $response['Items'][0]['PurchaseDetails'] ['TaxType'];
        $sellPrice = $response['Items'][0]['SalesDetails'] ['UnitPrice'];
        $salesAccount = $response['Items'][0] ['SalesDetails']['AccountCode'];
        $salesTax = $response['Items'][0] ['SalesDetails'] ['TaxType'];
        $salesPersonID =  backpack_user()->id;
        $salesPerson =  backpack_user()->name;
        
        $existingQuote = DB::table('xeroitems')->where('item-id', $itemID)->first();
        
        if($existingQuote){
            // Update quotes table
            DB::table('xeroitems')->where('item-id', $itemID)->update([              
                'code'                  => $Code,
                'item-name'             => $Name,
                'sales-description'     => $description,
                'purchase-description'  => $purchaseDescription,
                'cost-price'            => $costPrice,
                'purchase-account'      => $purchaseAccount,
                'purchase-tax'          => $purchaseTax,
                'sell-price'            => $sellPrice,
                'sales-account'         => $salesAccount,
                'sales-tax'             => $salesTax,
                'updated_at'       => now(),
            ]);
            
           
            
        
            
        }
        
    }
    
}


