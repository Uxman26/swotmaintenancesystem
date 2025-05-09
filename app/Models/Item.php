<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quote;

class Item extends Model
{
    use CrudTrait;
    use HasFactory;
    
    
    protected $primaryKey = 'id';
    
    protected $fillable = ['quote_id','description', 'quantity', 'unit_amount', 'account_code','lineamount'];
    
    protected $table = 'items'; // Explicitly specify the table name
    
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
