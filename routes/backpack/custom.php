<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::crud('user', 'UserCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('package', 'PackageCrudController');
    Route::crud('project', 'ProjectCrudController');
    Route::crud('maintenance-history', 'MaintenanceHistoryCrudController');
    Route::get('send_maintenance_email/{maintenance_history}', 'ProjectCrudController@sendMaintenanceEmail')->name('send_maintenance_email');
    Route::crud('quote', 'QuoteCrudController');
    Route::get('invoices/sync/{id}', 'InvoiceCrudController@syncInvoiceWithXero')->name('admin.invoices.sync');
    Route::get('invoices/sync-all', 'InvoiceCrudController@syncAllInvoices')->name('admin.invoices.sync_all');
    Route::crud('invoice', 'InvoiceCrudController');
    Route::crud('reports', 'ReportsCrudController');
    Route::crud('item', 'ItemCrudController');
    Route::get('contacts/{id}/custom-delete', 'ContactsCrudController@customDelete')
        ->name('contacts.custom-delete');
    Route::get('contacts/sync-from-app', 'ContactsCrudController@syncFromAppToXero')->name('contacts.sync_from_app');
    Route::get('contacts/sync-from-xero', 'ContactsCrudController@syncFromXeroToApp')->name('contacts.sync_from_xero');
    // Add the route for syncing a specific contact with Xero
    Route::get('contacts/sync-to-xero/{id}', 'ContactsCrudController@syncContactWithXero')->name('contacts.sync_to_xero');
    Route::get('contacts/sync', 'ContactsCrudController@syncContacts')->name('contacts.sync');
    Route::crud('contacts', 'ContactsCrudController');
    Route::crud('xeroitem', 'XeroitemCrudController');
    Route::crud('xerotoken', 'XerotokenCrudController');
});


