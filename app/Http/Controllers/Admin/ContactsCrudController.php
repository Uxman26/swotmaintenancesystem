<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Helpers;



/**
 * Class ContactsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Contacts::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contacts');
        CRUD::setEntityNameStrings('contacts', 'contacts');
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
        
        CRUD::column('name');
        CRUD::column('first_name');
        CRUD::column('last_name');
        CRUD::column('email_address');
     //   CRUD::column('phone_number');
        CRUD::column('created_by');
        $this->crud->removeButton('delete'); // remove Backpack's default delete
        $this->crud->addButtonFromModelFunction('line', 'customDelete', 'getCustomDeleteButton', 'end');
        $this->crud->addButtonFromView('top', 'sync_contacts', 'sync_contacts_button');
        $this->crud->addButtonFromView('line', 'sync_to_xero', 'sync_to_xero_button', 'end');


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
        
        $this->crud->addField([
            'name'    => 'contact_id',
            'label'   => 'Contact ID',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        // Contact Name Field
        $this->crud->addField([
            'name'    => 'name',
            'label'   => 'Contact Name',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        
        // First Name Field
        $this->crud->addField([
            'name'    => 'first_name',
            'label'   => 'First Name',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        // Last Name Field
        $this->crud->addField([
            'name'    => 'last_name',
            'label'   => 'Last Name',
            'type'    => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        // Email Address Field
        $this->crud->addField([
            'name'    => 'email_address',
            'label'   => 'Email Address',
            'type'    => 'email',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
    
       
    }
    
    public function refreshXeroToken($refreshToken)
{
    // Call to the Xero API to refresh the token
    $client = new Client();
    $response = $client->post('https://identity.xero.com/connect/token', [
        'form_params' => [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id'     => env('XERO_CLIENT_ID'),
            'client_secret' => env('XERO_CLIENT_SECRET'),
        ],
    ]);
    $data = json_decode($response->getBody(), true);
    
    return [
        'access_token'  => $data['access_token'],
        'refresh_token' => $data['refresh_token'],
    ];
}

    
    public function store(Request $request)
    {
        $user_id = backpack_user()->id;
        Helpers::refreshAccessToken($user_id);
          $xeroTokens = session('xero_tokens');
          if(empty($xeroTokens)){
              
              $authRedirectUrl = env('XERO_AUTH_REDIRECT_URL') . '?from=' . url()->current();
              
              header('Location: ' . $authRedirectUrl);
          }
            // Ensure the access token is present
            if (isset($xeroTokens['access_token'])) {
                $xeroAccessToken = $xeroTokens['access_token'];
                $contactData = [
                    'Contacts' => [
                        [
                            
                            'Name' => $request->input('name'),
                            'FirstName' => $request->input('first_name'),
                            'LastName' => $request->input('last_name'),
                            'EmailAddress' => $request->input('email_address'),
                            'IsCustomer' => true,
                        ],
                    ],
                ];
                
                // Call the Xero API
                dd($xeroAccessToken);
                $response = $this->callXeroApi($contactData, $xeroAccessToken);
                
                
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
                    return redirect()->back()->with('success', 'Contacts created successfully in Xero.');
                    
                } else {
                    // Error message
                    return redirect()->back()->with('error', 'Failed to create a quote in Xero.')->withInput();
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
        $contactID = $response['Contacts'][0]['ContactID'];
        $Name = $response['Contacts'][0]['Name'];
        $firstName = $response['Contacts'][0]['FirstName'];
        $lastName = $response['Contacts'][0]['LastName'];              
        $email = $response['Contacts'][0]['EmailAddress'];
        $salesPersonID = backpack_user()->id;
        $salesPerson = backpack_user()->name;
        
        // Insert data into the 'quotes' table
        DB::table('xerocontacts')->insert([
            'contact_id'        => $contactID,
            'name'              => $Name,
            'first_name'        => $firstName,
            'last_name'         => $lastName,
            'email_address'     => $email,
            'created_by'        => $salesPerson,
            'created_by_id'     => $salesPersonID,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
        
    }
    
    private function callXeroApi($contactData, $xeroAccessToken)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $Response = $client->request('POST', 'https://api.xero.com/api.xro/2.0/Contacts', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'json' => $contactData,
            ]);
            // Handle the Xero API response as needed
            return json_decode($Response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log GuzzleHttp request exceptions
            \Log::error('Xero API Request Error: ' . $e->getMessage());
            dd('Request failed: ' . $e->getMessage());
            
            // Return a user-friendly error response
            return ['error' => 'Failed to send contacts to Xero. Please try again. call xero api function' . $e->getMessage()];
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
            $updatedXeroData = $this->getXeroContacts($xeroAccessToken);
            
            // Update the session with the latest Xero data
            session(['xero' => $updatedXeroData]);
            
            return $updatedXeroData;
        }
        
        return [];
    }
    
    
    private function getXeroContacts($xeroAccessToken)
    {
        try {
            $client = new \GuzzleHttp\Client();
            
            $contactsResponse = $client->request('GET', 'https://api.xero.com/api.xro/2.0/Contacts', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                ],
            ]);
            
            $contacts = json_decode($contactsResponse->getBody(), true);
            
       
            return [
                
                'contacts' => $contacts,                
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
        $contactsData = data_get($updatedXeroData, 'contacts.Contacts', []);
        
       // dd($contactsData);
        
        foreach ($contactsData as $contactData) {
            
            $contactID = data_get($contactData, 'ContactID');
            $name = data_get($contactData, 'Name');
            $firstName = data_get($contactData, 'FirstName');
            $lastName = data_get($contactData, 'LastName');
            $email = data_get($contactData, 'EmailAddress');
            $salesPersonID = backpack_user()->id;
            $salesPerson = backpack_user()->name;
            
            
            
            // Check if quote ID already exists in the quotes table
            $existingQuote = DB::table('xerocontacts')->where('contact_id', $contactID)->first();
            
            if ($existingQuote) {
                // Quote ID exists, update the quotes table
                DB::table('xerocontacts')->where('contact_id', $contactID)->update([
                    'name'                     => $name,
                    'first_name'               => $firstName,
                    'last_name'                => $lastName,
                    'email_address'            => $email,                
                    'updated_at'               => now(),
                ]);
                
                
            } else {
                // Quote ID does not exist, insert a new record into the quotes table
                DB::table('xerocontacts')->insert([
                    'name'                     => $name,
                    'first_name'               => $firstName,
                    'last_name'                => $lastName,
                    'email_address'            => $email, 
                    'created_by'               => $salesPerson,
                    'created_by_id'            => $salesPersonID,
                    'contact_id'               => $contactID,
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
            $contactID = $request->input('contact_id');
            
            $contactData = [
                'Contacts' => [
                    [
                        
                        'Name' => $request->input('name'),
                        'FirstName' => $request->input('first_name'),
                        'LastName' => $request->input('last_name'),
                        'EmailAddress' => $request->input('email_address'),
                        
                    ],
                ],
            ];
            
            // Call the Xero API
            //  dd($quoteData);
            $response = $this->updateXeroApi($contactData, $xeroAccessToken, $contactID);
            
            if ($response) {
                // Store the Xero API response in the database
                $this->updateXeroApiResponse($response);
                
                // Fetch the latest Xero data
                $updatedXeroData = $this->getXeroContacts($xeroAccessToken);
                
                // Update the session with the latest Xero data
                session(['xero' => $updatedXeroData]);
                
                // Success message
                // Redirect to the showquote page with the updated list of quotes
                // return redirect()->route('quote')->with('success', 'Quote created successfully in Xero.');
                return redirect()->back()->with('success', 'Contact updated successfully in Xero.');
            } else {
                // Error message
                return redirect()->back()->with('error', 'Failed to update a Contact in Xero.')->withInput();
            }
        } else {
            // Error message if Xero access token not found
            
            return redirect()->back()->with('error', 'Xero access token not found.')->withInput();
        }
        
        
    }
    
    private function updateXeroApi($contactData, $xeroAccessToken, $contactID)
    {
        try {
            $client = new \GuzzleHttp\Client();
            
            $Response = $client->request('POST', "https://api.xero.com/api.xro/2.0/Contacts/{$contactID}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $xeroAccessToken,
                    'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'json' => $contactData,
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
        
        $contactID = $response['Contacts'][0]['ContactID'];
        $Name = $response['Contacts'][0]['Name'];
        $firstName = $response['Contacts'][0]['FirstName'];
        $lastName = $response['Contacts'][0]['LastName'];
        $email = $response['Contacts'][0]['EmailAddress'];
        $salesPersonID =  backpack_user()->id;
        $salesPerson =  backpack_user()->name;
        
        $existingQuote = DB::table('xerocontacts')->where('contact_id', $contactID)->first();
        
        if($existingQuote){
            // Update quotes table
            DB::table('xerocontacts')->where('contact_id', $contactID)->update([
                'name'            => $Name,
                'first_name'      => $firstName,
                'last_name'       => $lastName,
                'email_address'   => $email,
                'updated_at'      => now(),
            ]);
        }
        
    }
    public function customDelete($id)
{
    $contact = DB::table('xerocontacts')->where('id', $id)->first();

    if (!$contact) {
        \Alert::error('Contact not found.')->flash();
        return back();
    }

    $xeroTokens = session('xero_tokens');

    if (!isset($xeroTokens['access_token'])) {
        \Alert::error('Xero access token not found.')->flash();
        return back();
    }

    $xeroAccessToken = $xeroTokens['access_token'];
    $contactID = $contact->contact_id;

    // Delete from Xero (Archive)
    $deletedFromXero = $this->deleteXeroContact($xeroAccessToken, $contactID);

    // if ($deletedFromXero) {
        // Delete from DB
        DB::table('xerocontacts')->where('id', $id)->delete();

        \Alert::success('Contact deleted from Xero and app.')->flash();
        return redirect(backpack_url('contacts'));


    // }

    \Alert::error('Failed to delete contact from Xero.')->flash();
    return redirect(backpack_url('contacts'));


}
private function deleteXeroContact($xeroAccessToken, $contactID)
{
    try {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', "https://api.xero.com/api.xro/2.0/Contacts/{$contactID}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $xeroAccessToken,
                'Xero-Tenant-Id' => env('XERO_TENANT_ID'),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'Contacts' => [
                    [
                        'ContactID' => $contactID,
                        'ContactStatus' => 'ARCHIVED', // Xero does not allow hard deletes, so we archive instead
                    ],
                ],
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        return isset($result['Contacts'][0]['ContactID']);

    } catch (\Exception $e) {
        \Log::error('Xero delete error: ' . $e->getMessage());
        return false;
    }
}
public function syncContacts() 
{
    $user_id = backpack_user()->id;
    Helpers::refreshAccessToken($user_id);

    $xeroTokens = session('xero_tokens');

    if (!isset($xeroTokens['access_token'])) {
        \Alert::error('Xero access token not found.')->flash();
        return redirect(backpack_url('contacts'));
    }

    $xeroAccessToken = $xeroTokens['access_token'];

    // 🔁 Fetch contacts from Xero
    $updatedXeroData = $this->getXeroContacts($xeroAccessToken);

    // 🔁 Fetch contacts from your local database
    $localContacts = DB::table('xerocontacts')->get();

    if (empty($updatedXeroData)) {
        \Alert::error('Failed to fetch contacts from Xero.')->flash();
        return redirect(backpack_url('contacts'));
    }

    $xeroContacts = data_get($updatedXeroData, 'contacts.Contacts', []);

    // ➡️ Prepare lookup by email for easy comparison
    $xeroByEmail = collect($xeroContacts)->keyBy('EmailAddress');
    $localByEmail = $localContacts->keyBy('email_address');

    // ➡️ 1. Sync from Xero ➡️ Laravel (App)
    foreach ($xeroByEmail as $email => $xeroContact) {
        if (!$localByEmail->has($email)) {
            // Not found locally → Insert into your database
            DB::table('xerocontacts')->insert([
                'contact_id' => data_get($xeroContact, 'ContactID'),
                'name' => data_get($xeroContact, 'Name'),
                'first_name' => data_get($xeroContact, 'FirstName'),
                'last_name' => data_get($xeroContact, 'LastName'),
                'email_address' => data_get($xeroContact, 'EmailAddress'),
                'created_by' => backpack_user()->name,
                'created_by_id' => backpack_user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Optional: else if email exists, you can update fields if any field changed
    }

    // ➡️ 2. Sync from Laravel (App) ➡️ Xero
    foreach ($localByEmail as $email => $localContact) {
        if (!$xeroByEmail->has($email)) {
            // Not found in Xero → Create in Xero
            $contactData = [
                'Contacts' => [
                    [
                        'Name' => $localContact->name,
                        'FirstName' => $localContact->first_name,
                        'LastName' => $localContact->last_name,
                        'EmailAddress' => $localContact->email_address,
                        'IsCustomer' => true,
                    ],
                ],
            ];

            $this->callXeroApi($contactData, $xeroAccessToken);
        }
        // Optional: else if exists, you can update Xero fields
    }

    \Alert::success('Contacts synced successfully between App and Xero.')->flash();
    return redirect(backpack_url('contacts'));
}

public function syncFromAppToXero() 
{
    $user_id = backpack_user()->id;
    Helpers::refreshAccessToken($user_id);

    $xeroTokens = session('xero_tokens');

    if (!isset($xeroTokens['access_token'])) {
        \Alert::error('Xero access token not found.')->flash();
        return redirect(backpack_url('contacts'));
    }

    $xeroAccessToken = $xeroTokens['access_token'];

    // 🔁 Fetch contacts from your local database
    $localContacts = DB::table('xerocontacts')->get();

    // ➡️ Sync from Laravel (App) ➡️ Xero
    foreach ($localContacts as $localContact) {
        $contactData = [
            'Contacts' => [
                [
                    'Name' => $localContact->name,
                    'FirstName' => $localContact->first_name,
                    'LastName' => $localContact->last_name,
                    'EmailAddress' => $localContact->email_address,
                    'IsCustomer' => true,
                ],
            ],
        ];

        $this->callXeroApi($contactData, $xeroAccessToken);
    }

    \Alert::success('Contacts synced successfully from App to Xero.')->flash();
    return redirect(backpack_url('contacts'));
}

public function syncFromXeroToApp() 
{
    $user_id = backpack_user()->id;
    Helpers::refreshAccessToken($user_id);

    $xeroTokens = session('xero_tokens');

    if (!isset($xeroTokens['access_token'])) {
        \Alert::error('Xero access token not found.')->flash();
        return redirect(backpack_url('contacts'));
    }

    $xeroAccessToken = $xeroTokens['access_token'];

    // 🔁 Fetch contacts from Xero
    $updatedXeroData = $this->getXeroContacts($xeroAccessToken);

    // 🔁 Fetch contacts from your local database
    $localContacts = DB::table('xerocontacts')->get();

    if (empty($updatedXeroData)) {
        \Alert::error('Failed to fetch contacts from Xero.')->flash();
        return redirect(backpack_url('contacts'));
    }

    $xeroContacts = data_get($updatedXeroData, 'contacts.Contacts', []);

    // ➡️ Prepare lookup by email for easy comparison
    $xeroByEmail = collect($xeroContacts)->keyBy('EmailAddress');
    $localByEmail = $localContacts->keyBy('email_address');

    // ➡️ Sync from Xero ➡️ Laravel (App)
    foreach ($xeroByEmail as $email => $xeroContact) {
        if (!$localByEmail->has($email)) {
            // Not found locally → Insert into your database
            DB::table('xerocontacts')->insert([
                'contact_id' => data_get($xeroContact, 'ContactID'),
                'name' => data_get($xeroContact, 'Name'),
                'first_name' => data_get($xeroContact, 'FirstName'),
                'last_name' => data_get($xeroContact, 'LastName'),
                'email_address' => data_get($xeroContact, 'EmailAddress'),
                'created_by' => backpack_user()->name,
                'created_by_id' => backpack_user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Optional: Update logic can be added
    }

    \Alert::success('Contacts synced successfully from Xero to App.')->flash();
    return redirect(backpack_url('contacts'));
}

public function syncContactWithXero($id) 
{
    $user_id = backpack_user()->id;
    Helpers::refreshAccessToken($user_id);

    $xeroTokens = session('xero_tokens');
    if (!isset($xeroTokens['access_token'])) {
        \Alert::error('Xero access token not found.')->flash();
        return redirect(backpack_url('contacts'));
    }

    $xeroAccessToken = $xeroTokens['access_token'];

    // Get the selected contact from the local database
    $localContact = DB::table('xerocontacts')->where('id', $id)->first();
    if (!$localContact) {
        \Alert::error('Contact not found.')->flash();
        return redirect(backpack_url('contacts'));
    }

    // Prepare contact data for Xero sync
    $contactData = [
        'Contacts' => [
            [
                'Name' => $localContact->name,
                'FirstName' => $localContact->first_name,
                'LastName' => $localContact->last_name,
                'EmailAddress' => $localContact->email_address,
                'IsCustomer' => true,
            ],
        ],
    ];

    // Call the Xero API to sync the contact
    $response = $this->callXeroApi($contactData, $xeroAccessToken);
    
    if ($response) {
        // Store the Xero API response in the database
        $this->storeXeroApiResponse($response);
        \Alert::success('Contact successfully synced with Xero.')->flash();
    } else {
        \Alert::error('Failed to sync contact with Xero.')->flash();
    }

    return redirect(backpack_url('contacts'));
}


}
 