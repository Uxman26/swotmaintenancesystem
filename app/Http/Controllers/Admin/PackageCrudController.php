<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PackageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PackageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PackageCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Package::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/package');
        CRUD::setEntityNameStrings('package', 'packages');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('price')->label('Price (RM)');
        CRUD::addColumn([
            'name' => 'domain',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => 0
        ]);
        CRUD::column('web_pages_design')->label('Web Pages Design (Page)');
        CRUD::column('web_storage')->label('Web Storage (GB)');
        CRUD::column('email_users');
        CRUD::addColumn([
            'name' => 'mobile_responsive',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::addColumn([
            'name' => 'premium_wordpress_template',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::column('revisions');
        CRUD::column('products_upload');
        CRUD::column('animated_banner');
        CRUD::addColumn([
            'name' => 'jpeg_mock',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::addColumn([
            'name' => 'content_management_system',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::addColumn([
            'name' => 'ownership_and_access',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::addColumn([
            'name' => 'ssl_certificate',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::column('stock_photos');
        CRUD::column('graphical_design');
        CRUD::column('trip_of_visits');
        CRUD::column('website_maintenance')->label('Website Maintentance (hour)');
        CRUD::column('premium_paid_plugin');
        CRUD::column('web_maintenance_guideline')->label('Website Maintenance Guideline (module)');
        CRUD::addColumn([
            'name' => 'technical_support',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::column('Renewal')->type('number');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    protected function setupShowOperation() {
        $this->setupListOperation();
        CRUD::column('created_at');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PackageRequest::class);

        CRUD::field('name');
        CRUD::field('price')->label('Price (RM)');
        CRUD::addField([
            'name' => 'domain',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::field('web_pages_design')->label('Web Pages Design (Page)');
        CRUD::field('web_storage')->label('Web Storage (GB)');
        CRUD::field('email_users');
        CRUD::addField([
            'name' => 'mobile_responsive',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::addField([
            'name' => 'premium_wordpress_template',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::field('revisions');
        CRUD::field('products_upload');
        CRUD::field('animated_banner');
        CRUD::addField([
            'name' => 'jpeg_mock',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::addField([
            'name' => 'content_management_system',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::addField([
            'name' => 'ownership_and_access',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::addField([
            'name' => 'ssl_certificate',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::field('stock_photos');
        CRUD::field('graphical_design');
        CRUD::field('trip_of_visits');
        CRUD::field('website_maintenance')->label('Website Maintentance (hour)');
        CRUD::field('premium_paid_plugin');
        CRUD::field('web_maintenance_guideline')->label('Website Maintenance Guideline (module)');
        CRUD::addField([
            'name' => 'technical_support',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
        ]);
        CRUD::field('Renewal')->type('number');

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
        CRUD::field('created_at');
    }
}
