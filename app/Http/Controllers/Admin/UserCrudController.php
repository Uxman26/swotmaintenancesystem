<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
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
        CRUD::column('email');
        CRUD::column('created_at')->searchLogic(false);
        CRUD::column('email_verified_at')->searchLogic(false);
        // CRUD::column('avatar')->type('image')->prefix('storage/')->searchLogic(false);
       // CRUD::addColumn([
      // //     'name' => 'role',
      //      'label' => 'Role',
      //      'type' => 'array',
           // 'value' => fn ($v) => $v->role->display_name,
       //     'searchLogic' => false
      //  ]);
        CRUD::column('is_welcome_email_send')->type('boolean')->searchLogic(false);

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

        $this->crud->addFilter([
            'name'  => 'role',
            'type'  => 'dropdown',
            'label' => 'Role'
        ], \App\Models\Role::pluck('display_name', 'id')->toArray()
        , function ($value) { // if the filter is active
            $this->crud->addClause('where', 'role_id', $value);
        });

        $this->crud->addFilter([
            'name'  => 'is_welcome_email_send',
            'type'  => 'dropdown',
            'label' => 'Is welcome email send?'
        ], [
            0 => "No",
            1 => "Yes"
        ]
        , function ($value) { // if the filter is active
            $this->crud->addClause('where', 'is_welcome_email_send', $value);
        });

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    protected function setupShowOperation()
    {
        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('created_at');
        CRUD::column('email_verified_at');
        // CRUD::addColumn([
        //     'name' => 'avatar',
        //     'type' => 'image',
        //     'prefix' => 'storage/',
        //     'width' => '200px',
        //     'height' => '200px',
        // ]);
        // CRUD::addColumn([
        //     // 1-n relationship
        //     'label'     => 'Role', // Table column heading
        //     'type'      => 'select',
        //     'name'      => 'role_id', // the column that contains the ID of that connected entity;
        //     'entity'    => 'role', // the method that defines the relationship in your Model
        //     'attribute' => 'display_name', // foreign key attribute that is shown to user
        //     'model'     => "App\Models\Role", // foreign key model
        // ]);
        // CRUD::addColumn([
        //     'name'  => 'additional_roles',
        //     'label' => 'Additional roles', // Table column heading
        //     'type'  => 'model_function',
        //     'function_name' => 'getAdditionalRoles', // the method in your Model
        // ],);
        CRUD::column('is_welcome_email_send')->type('boolean');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('password')->hint('Leave empty to keep the same');
        CRUD::addField([  // Select
            'label'     => "Role",
            'type'      => 'select',
            'name'      => 'role_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'role',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Role", // related model
            'attribute' => 'display_name', // foreign key attribute that is shown to user
        ]);

        // $user_id = $this->crud->getRequest()->id;
        // $user_roles = \App\Models\UserRole::where('user_id', $user_id)->pluck('role_id')->toArray();
        // CRUD::addField([   // Checklist
        //     'label'     => 'Additional roles',
        //     'type'      => 'checklist',
        //     'name'      => 'additional_roles',
        //     'fake'      => true,
        //     'entity'    => 'role',
        //     'attribute' => 'display_name',
        //     'model'     => "App\Models\Role",
        //     'pivot'     => true,
        //     'value'     => json_encode($user_roles),
        //     'wrapper' => [
        //         'class' => 'form-group col-sm-12 additional_roles_input',
        //     ], // extra HTML attributes and values your input might need
        // ]);

        // CRUD::addField([
        //     'name' => 'locale',
        //     'type' => 'select_from_array',
        //     'fake' => 'true',
        //     'options'     => [
        //         'al' => 'al',
        //         'am' => 'am',
        //         'ar' => 'ar',
        //         'bg' => 'bg',
        //         'cs' => 'cs',
        //         'de' => 'de',
        //         'en' => 'en',
        //         'es' => 'es',
        //         'fa' => 'fa',
        //         'fi' => 'fi',
        //         'fr' => 'fr',
        //         'gl' => 'gl',
        //         'id' => 'id',
        //         'it' => 'it',
        //         'ja' => 'ja',
        //         'ku' => 'ku',
        //         'nl' => 'nl',
        //         'pl' => 'pl',
        //         'pt' => 'pt',
        //         'pt_br' => 'pt_br',
        //         'ro' => 'ro',
        //         'ru' => 'ru',
        //         'sv' => 'sv',
        //         'tr' => 'tr',
        //         'uk' => 'uk',
        //         'vi' => 'vi',
        //         'zh_CN' => 'zh_CN',
        //         'zh_TW' => 'zh_TW',
        //     ],
        //     'allows_null' => false,
        //     'default'     => 'en',
        // ]);

        CRUD::addField([
            'name' => 'is_welcome_email_send',
            'label' => 'Is welcome email send?',
            'type' => 'select_from_array',
            'options' => [
                1 => 'Yes',
                0 => 'No'
            ],
            'allows_null' => false,
            'default'     => 0,
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

        // dd($this->crud->getRequest());

        // $_request = $this->crud->getRequest();

        // $locale = $_request->locale;
        // $_request->request->add(['settings' => json_encode(['locale' => $locale])]);

        // $user_roles = json_decode($_request->additional_roles);

        $response = $this->traitStore();

        // do something after save
        // $user_id = $this->crud->entry->id;
        // foreach ($user_roles as $role_id) {
        //     \App\Models\UserRole::create(
        //         [
        //             'user_id' => $user_id,
        //             'role_id' => $role_id
        //         ]
        //     );
        // }

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

        // dd($this->crud->getRequest());

        $_request = $this->crud->getRequest();

        // $locale = $_request->locale;
        // $_request->request->add(['settings' => json_encode(['locale' => $locale])]);

        // $user_roles = json_decode($_request->additional_roles);
        // $user_id = $_request->id;

        // \App\Models\UserRole::where('user_id', $user_id)->delete();

        // foreach ($user_roles as $role_id) {
        //     \App\Models\UserRole::create(
        //         [
        //             'user_id' => $user_id,
        //             'role_id' => $role_id
        //         ]
        //     );
        // }

        $password = $_request->password;
        if (empty($password)) {
            $_request->request->remove('password');
        }


        $response = $this->traitUpdate();
        // do something after save
        return $response;
    }
}
