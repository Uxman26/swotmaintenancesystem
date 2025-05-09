<?php

namespace App\Http\Controllers\Admin;

use App\Models\MaintenanceHistory;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProjectRequest;
use App\Mail\MaintenanceHistoryEmail;
use Illuminate\Support\Facades\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }

    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Project::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
        CRUD::setEntityNameStrings('project', 'projects');
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
        CRUD::column('user')->label('Owner')->searchLogic(false);
        // CRUD::addColumn([
        //     'name' => 'description',
        //     'type' => 'custom_html',
        //     'value' => fn($v) => $v->description
        // ]);
        CRUD::column('person_in_charge_name');
        CRUD::column('domain_name');
        CRUD::column('company_name');
        CRUD::column('one_time_fee');
        CRUD::column('renewal_fee');
        CRUD::column('package')->searchLogic(false);
        CRUD::column('server_url');
        CRUD::column('server_username');
        CRUD::column('server_password');
        CRUD::column('wordpress_url');
        CRUD::column('wordpress_username');
        CRUD::column('wordpress_password');
        // CRUD::addColumn([
        //     'name' => 'remark',
        //     'type' => 'custom_html',
        //     'value' => fn($v) => $v->remark
        // ]);
        CRUD::addColumn([
            'name' => 'status',
            'type' => 'select_from_array',
            'options' => [
                1 => 'NEW',
                2 => 'QUOTATION',
                3 => 'DESIGN',
                4 => 'DEVELOPING MOCK',
                5 => 'AMENDMENT STAGE',
                6 => 'COMPLETION',
            ],
            'searchLogic' => false
        ]);
        CRUD::column('revision');
        CRUD::column('maintenance')->label('Maintenance Hour Balance');


        $this->crud->addFilter([
            'name'  => 'user_id',
            'type'  => 'select2',
            'label' => 'Owner'
        ], function () {
            return \App\Models\User::pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'user_id', $value);
        });

        $this->crud->addFilter([
            'name'  => 'package_id',
            'type'  => 'select2',
            'label' => 'Package'
        ], function () {
            return \App\Models\Package::pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'package_id', $value);
        });

        $this->crud->addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Status'
        ], function () {
            return [
                1 => 'NEW',
                2 => 'QUOTATION',
                3 => 'DESIGN',
                4 => 'DEVELOPING MOCK',
                5 => 'AMENDMENT STAGE',
                6 => 'COMPLETION',
            ];
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'status', $value);
        });

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }


    protected function setupshowOperation()
    {
        CRUD::column('name');
        CRUD::column('user')->label('Owner');
        CRUD::addColumn([
            'name' => 'description',
            'type' => 'custom_html',
            'value' => fn ($v) => $v->description
        ]);
        CRUD::column('person_in_charge_name');
        CRUD::column('domain_name');
        CRUD::column('company_name');
        CRUD::column('one_time_fee');
        CRUD::column('renewal_fee');
        CRUD::column('package');
        CRUD::column('server_url');
        CRUD::column('server_username');
        CRUD::column('server_password');
        CRUD::column('wordpress_url');
        CRUD::column('wordpress_username');
        CRUD::column('wordpress_password');
        CRUD::addColumn([
            'name' => 'remark',
            'type' => 'custom_html',
            'value' => fn ($v) => $v->remark
        ]);
        CRUD::addColumn([
            'name' => 'status',
            'type' => 'select_from_array',
            'options' => [
                1 => 'NEW',
                2 => 'QUOTATION',
                3 => 'DESIGN',
                4 => 'DEVELOPING MOCK',
                5 => 'AMENDMENT STAGE',
                6 => 'COMPLETION',
            ]
        ]);
        CRUD::column('revision');
        CRUD::column('maintenance')->label('Maintenance Hour Balance');
    }
    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProjectRequest::class);

        CRUD::field('name');
        CRUD::addField([
            'name' => 'user_id',
            'label' => 'Owner',
            'type' => 'select2',

            'entity'    => 'user', // the method that defines the relationship in your Model
            'model'     => "App\Models\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
        ]);
        CRUD::field('description')->type('tinymce');
        CRUD::field('person_in_charge_name');
        CRUD::field('domain_name');
        CRUD::field('company_name');
        CRUD::field('one_time_fee');
        CRUD::field('renewal_fee');
        CRUD::addField([
            'name' => 'package_id',
            'label' => 'Package',
            'type' => 'select2',

            'entity'    => 'package', // the method that defines the relationship in your Model
            'model'     => "App\Models\Package", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
        ]);
        CRUD::field('server_url');
        CRUD::field('server_username');
        CRUD::field('server_password');
        CRUD::field('wordpress_url');
        CRUD::field('wordpress_username');
        CRUD::field('wordpress_password');
        CRUD::field('remark')->type('tinymce');
        CRUD::addField([
            'name' => 'status',
            'type' => 'select2_from_array',
            'options' => [
                1 => 'NEW',
                2 => 'QUOTATION',
                3 => 'DESIGN',
                4 => 'DEVELOPING MOCK',
                5 => 'AMENDMENT STAGE',
                6 => 'COMPLETION',
            ],
            'allows_null' => false
        ]);
        CRUD::field('revision');
        CRUD::field('maintenance')->label('Maintenance Hour Balance')->type('number');
        CRUD::field('maintenance_remark')->label('Maintenance Remark')->fake(true);

        $project_id = $this->crud->getRequest()->id;
        $m_hists = \App\Models\MaintenanceHistory::where('project_id', $project_id)->get();
        if (count($m_hists)) {
            $html = '';
            $html .= '    <table class="table table-bordered">';
            $html .= '        <thead>';
            $html .= '            <tr>';
            $html .= '                <th>Maintenance Hour Balance</th>';
            $html .= '                <th>Maintenance Remark</th>';
            $html .= '                <th>Created At</th>';
            $html .= '                <th>Is Email Send?</th>';
            $html .= '                <th>Action</th>';
            $html .= '            </tr>';
            $html .= '        </thead>';
            $html .= '        <tbody>';

            foreach ($m_hists as $hist) {
                $html .= '<tr>';
                $html .= '<td>' . $hist['maintenance_hour'] . '</td>';
                $html .= '<td>' . $hist['maintenance_remark'] . '</td>';
                $html .= '<td>' . $hist['created_at'] . '</td>';
                $html .= '<td>' . ($hist['is_email_send'] ? 'YES' : 'NO') . '</td>';

                $html .= '<td>
                    <a class="btn btn-link btn-primary" href=' . route('maintenance-history.edit', ['id' => $hist['id']]) . '>Edit</a>
                    <a class="mt-1 btn btn-link btn-secondary text-dark" href=' . route('send_maintenance_email', ['maintenance_history' => $hist['id']]) . '>Send Email</a>
                </td>';

                $html .= '</tr>';
            }

            $html .= '        </tbody>';
            $html .= '    </table>';

            CRUD::addField([
                'name' => 'maintainance_hours',
                'fake' => true,
                'type' => 'custom_html',
                'value' => $html
            ]);
        }

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

    public function store()
    {
        // do something before validation, before save, before everything; for example:
        // $this->crud->addField(['type' => 'hidden', 'name' => 'author_id']);
        // $this->crud->removeField('password_confirmation');

        // Note: By default Backpack ONLY saves the inputs that were added on page using Backpack fields.
        // This is done by stripping the request of all inputs that do NOT match Backpack fields for this
        // particular operation. This is an added security layer, to protect your database from malicious
        // users who could theoretically add inputs using DeveloperTools or JavaScript. If you're not properly
        // using $guarded or $fillable on your model, malicious inputs could get you into trouble.

        // However, if you know you have proper $guarded or $fillable on your model, and you want to manipulate 
        // the request directly to add or remove request parameters, you can also do that.
        // We have a config value you can set, either inside your operation in `config/backpack/crud.php` if
        // you want it to apply to all CRUDs, or inside a particular CrudController:
        // $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);
        // The above will make Backpack store all inputs EXCEPT for the ones it uses for various features.
        // So you can manipulate the request and add any request variable you'd like.
        // $this->crud->getRequest()->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->getRequest()->request->remove('password_confirmation');
        $_request = $this->crud->getRequest();
        $maintenance_hour = $_request->maintenance;
        $maintenance_remark = $_request->maintenance_remark;

        $response = $this->traitStore();

        // do something after save
        if (!empty($maintenance_hour)) {
            $project_id = $this->crud->entry->id;
            \App\Models\MaintenanceHistory::create([
                'project_id' => $project_id,
                'maintenance_hour' => $maintenance_hour,
                'maintenance_remark' => $maintenance_remark,
                'is_email_send' => 0
            ]);
        }
        return $response;
    }

    public function update()
    {
        // do something before validation, before save, before everything; for example:
        // $this->crud->addField(['type' => 'hidden', 'name' => 'author_id']);
        // $this->crud->removeField('password_confirmation');

        // Note: By default Backpack ONLY saves the inputs that were added on page using Backpack fields.
        // This is done by stripping the request of all inputs that do NOT match Backpack fields for this
        // particular operation. This is an added security layer, to protect your database from malicious
        // users who could theoretically add inputs using DeveloperTools or JavaScript. If you're not properly
        // using $guarded or $fillable on your model, malicious inputs could get you into trouble.

        // However, if you know you have proper $guarded or $fillable on your model, and you want to manipulate 
        // the request directly to add or remove request parameters, you can also do that.
        // We have a config value you can set, either inside your operation in `config/backpack/crud.php` if
        // you want it to apply to all CRUDs, or inside a particular CrudController:
        // $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);
        // The above will make Backpack store all inputs EXCEPT for the ones it uses for various features.
        // So you can manipulate the request and add any request variable you'd like.
        // $this->crud->getRequest()->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->getRequest()->request->remove('password_confirmation');
        // $this->crud->getRequest()->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->getRequest()->request->remove('password_confirmation');

        $_request = $this->crud->getRequest();
        $maintenance_hour = $_request->maintenance;
        $maintenance_remark = $_request->maintenance_remark;
        $old_maintenance_hour = \App\Models\Project::find($_request->id)->maintenance;

        $response = $this->traitUpdate();


        // do something after save
        if (!empty($maintenance_hour) && (float) $old_maintenance_hour !== (float) $maintenance_hour) {
            $project_id = $this->crud->entry->id;
            \App\Models\MaintenanceHistory::create([
                'project_id' => $project_id,
                'maintenance_hour' => $maintenance_hour,
                'maintenance_remark' => $maintenance_remark,
                'is_email_send' => 0
            ]);
        }
        return $response;
    }


    /**
     * Send maintenance email
     * 
     * @return void
     */
    protected function sendMaintenanceEmail(MaintenanceHistory $maintenance_history)
    {
        $project = $maintenance_history->project;
        $user = $project->user;
        try {
            Mail::to($user->email)->send(new MaintenanceHistoryEmail($user, $project, $maintenance_history));
            $maintenance_history->is_email_send = 1;
            $maintenance_history->save();

            \Alert::add('success', 'Successfully sent email.')->flash();
            return redirect()->route('maintenance-history.show', ['id' => $maintenance_history->id]);
        } catch (\Throwable $th) {
            // dd($th);
            \Alert::add('error', 'Error sending email.')->flash();
            return redirect()->route('maintenance-history.show', ['id' => $maintenance_history->id]);
        }
    }
}
