<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\XeroController;
use App\Http\Controllers\Admin\InvoiceCrudController;
use App\Http\Controllers\Admin\QuoteCrudController;
use App\Http\Controllers\Admin\ReportsCrudController;

/*
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for your application. These
 | routes are loaded by the RouteServiceProvider within a group which
 | contains the "web" middleware group. Now create something great!
 |
 */

Route::get('/', function () {
    return redirect('login');
});
    
    Auth::routes();
    
    Route::middleware('auth')->group(function () {
        
        Route::get('/user_dashboard', [PagesController::class, 'dashboard'])->name('user.dashboard');
        
        Route::get('/project_details/{id}', [PagesController::class, 'project_details'])->name('site.project_details');
        
        Route::get('/projects', [PagesController::class, 'projects'])->name('user.projects');
        
        Route::get('/contact-us', [ContactController::class, 'index'])->name('pages.contact-us');
        
        Route::post('/contact-us', [ContactController::class, 'contact'])->name('pages.contact');
        

        Route::get('/allquote', [QuoteCRUDController::class, 'showquote'])->name('quote.showquote');
        
        Route::get('/allreports', [ReportsCRUDController::class, 'showreports'])->name('reports.showreports');
        
        Route::get('/allinvoice', [InvoiceCrudController::class, 'showinvoice'])->name('invoice.showinvoice');
        
        Route::get('/editinvoice/{id}', [InvoiceCrudController::class, 'editinvoice'])->name('invoice.editinvoice');
         
        
        
        Route::delete('/admin/quote/delete-item/{id}', [QuoteCRUDController::class, 'deleteItem'])->name('quote.delete-item');
        
           
           // routes/web.php
           
           Route::get('/xero/download-pdf/{token}/{invoicenumber}/{id}', [XeroController::class, 'downloadPdf'])->name('xero.getpdf');
           
           Route::get('/xero/get-report/{token}//{id}', [XeroController::class, 'getreport'])->name('xero.getreport');
           
           Route::get('/xero/download-quote-pdf/{token}/{quotenumber}/{id}', [XeroController::class, 'downloadQuotePdf'])->name('xero.getquotepdf');
                        
           Route::get('/admin/quote/deletequote/{id}', [QuoteCRUDController::class, 'deletequote'])->name('quote.deletequote');
           
           
         
           
           
            Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


    });
            Route::middleware(array_merge(
                (array) config('backpack.base.web_middleware', 'web')
            ))->group(function () {
                Route::get('xero/callback', [XeroController::class, 'handleCallback'])->name('xero.handleCallback');
                Route::get('xero/auth', [XeroController::class, 'authenticate'])->name('xero.authenticate');
        });
        
            