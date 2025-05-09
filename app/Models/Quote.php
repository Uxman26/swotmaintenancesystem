<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Quote extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

   protected $table = 'quotes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
   protected $guarded = ['id'];
   
   protected $fillable = [
       'customer',
       'issue_date',
       'expiry_date',
       'quote_number',
       'title',
       'summary',
       'reference',
       'currency',
       'project',
       'tax',
       'terms',
       'subtotal',
       'total',
       // Add other fields...
   ];
   
   
   public function items()
   {
       return $this->hasMany(Item::class);
   }
   
   
   public function getDeleteQuoteButton()
   {
       $id = $this->id ?? null;
       
       if (!$id || !$this->id) {
        
           return 'N/A';
       }
       
       $deleteUrl = route('quote.deletequote', [
           'id' => $id,
           'type' => 'text',
       ]);
       
       return '<a href="' . $deleteUrl . '" class="" style="margin-left:5px;margin-right:5px;"><i class="las la-trash"></i> Delete </a>';
   }
  
   
   public function getDownloadButton()
   {
       $quoteId = $this->quote_id ?? null; // Make sure this is the correct GUID, not the Quote Number
       
       if (!$quoteId) {
           return 'N/A'; // No valid quote ID (GUID), return 'N/A'
       }
       
       // Get Xero access tokens from session
       $xeroTokens = session('xero_tokens');
       
       // If tokens are not available, redirect to Xero authentication
       if (empty($xeroTokens)) {
           return redirect()->route('xero.authenticate');
       }
       
       // Create download URL and pass the correct QuoteId (GUID) and QuoteNumber
       $downloadUrl = route('xero.getquotepdf', [
           'token' => $xeroTokens['access_token'],
           'quotenumber' => $this->quote_number, // Still using quote number for file naming
           'id' => $quoteId, // Pass the correct GUID (QuoteId)
           'type' => 'text',
       ]);
       
       // Generate the download button HTML
       return '<a href="' . $downloadUrl . '" class="" style="margin-left:5px;margin-right:5px;"><i class="las la-file-download"></i> Download </a>';
   }
   
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
