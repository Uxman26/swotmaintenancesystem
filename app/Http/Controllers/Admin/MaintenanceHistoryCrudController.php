<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MaintenanceHistoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MaintenanceHistoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MaintenanceHistoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\MaintenanceHistory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/maintenance-history');
        CRUD::setEntityNameStrings('maintenance history', 'maintenance histories');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('project_id')->label('projects');
        CRUD::column('maintenance_hour');
        CRUD::column('maintenance_remark');
        CRUD::column('is_email_send');
        CRUD::column('created_at');

        $this->crud->addFilter([
            'name'  => 'project_id',
            'type'  => 'select2',
            'label' => 'projects'
        ], function () {
            return \App\Models\Project::pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'project_id', $value);
        });

        $this->crud->addFilter(
            [
                'type'  => 'date_range',
                'name'  => 'created_at',
                'label' => 'Created at'
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'created_at', '>=', $dates->from);
                $this->crud->addClause('where', 'created_at', '<=', $dates->to . ' 23:59:59');
            }
        );
        
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
        CRUD::setValidation(MaintenanceHistoryRequest::class);

        CRUD::addField([
            'name' => 'project_id',
            'label' => 'projects',
            'type' => 'select2',

            'entity'    => 'project', // the method that defines the relationship in your Model
            'model'     => "App\Models\Project", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
        ]);
        CRUD::field('maintenance_hour');
        CRUD::field('maintenance_remark')->type('textarea');
        CRUD::addField([
            'name' => 'is_email_send',
            'label' => 'Is Email Send?',
            'type' => 'select_from_array',
            'options' => [
                0 => 'NO',
                1 => 'YES'
            ],
            'allows_null' => false,
            'default' => '0'
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
