<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuotesRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class QuotesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuotesCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Quotes::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/quotes');
        CRUD::setEntityNameStrings('quotes', 'quotes');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('created_at');
        CRUD::column('currency');
        CRUD::column('customer');
        CRUD::column('expiry_date');
        CRUD::column('issue_date');
        CRUD::column('project');
        CRUD::column('quote_number');
        CRUD::column('reference');
        CRUD::column('subtotal');
        CRUD::column('summary');
        CRUD::column('tax');
        CRUD::column('terms');
        CRUD::column('title');
        CRUD::column('total');
        CRUD::column('updated_at');

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
        CRUD::setValidation(QuotesRequest::class);

        
        // Pass the contacts data to the view
        $this->crud->addField([
            'name'    => 'customer',
            'label'   => 'Customer Contact',
            'type'    => 'select_from_array',
            'options' =>[
                'Customer 1' => 'Customer 1',
            ],
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
            'name'    => 'currency',
            'label'   => 'Currency',
            'type'    => 'select_from_array',
            'options' => [
                'US Dollar' => 'USD',
                'Euro' => 'EUR',
                'Malaysian Ringgit' => 'MYR',
            ],
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        
        $this->crud->addField([
            'name'    => 'project',
            'label'   => 'Project',
            'type'    => 'select_from_array',
            'options' => [
                'Project 1' => 'Project 1',
                
            ],
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
        
        
        
        
        // Terms, Subtotal, and Total
        $this->crud->addField([
            'name'    => 'terms',
            'label'   => 'Terms',
            'type'    => 'textarea',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
        
        $this->crud->addField([
            'name'    => 'subtotal',
            'label'   => 'Subtotal',
            'type'    => 'text',
            
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        $this->crud->addField([
            'name'    => 'total',
            'label'   => 'Total',
            'type'    => 'text',
            
            'wrapper' => ['class' => 'form-group col-md-3'],
        ]);
        
        // File Attachment
        $this->crud->addField([
            'name'    => 'attachments',
            'label'   => 'Attachments',
            'type'    => 'upload',
            'upload'  => true,
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
