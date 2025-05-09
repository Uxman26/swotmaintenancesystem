<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'projects';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    const STATUS_NEW = 1;
    const STATUS_QUOTATION = 2;
    const STATUS_DESIGN = 3;
    const STATUS_DEVELOPING_MOCK = 4;
    const STATUS_AMENDMENT_STAGE = 5;
    const STATUS_COMPLETION = 6;
    const STATUS_PENDING = 7;
    const STATUS_CANCEL = 8;

    const IS_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_EXPIRY_NOTICE_SEND_YES = 1;

    const IS_WEBSITE_SERVICES_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_WEBSITE_SERVICES_EXPIRY_NOTICE_SEND_YES = 1;

    const IS_HOSTING_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_HOSTING_EXPIRY_NOTICE_SEND_YES = 1;

    const IS_DOMAIN_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_DOMAIN_EXPIRY_NOTICE_SEND_YES = 1;

    const IS_SEO_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_SEO_EXPIRY_NOTICE_SEND_YES = 1;

    const IS_WEBSITE_MAINTENANCE_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_WEBSITE_MAINTENANCE_EXPIRY_NOTICE_SEND_YES = 1;

    const IS_FACEBOOK_SERVICE_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_FACEBOOK_SERVICE_EXPIRY_NOTICE_SEND_YES = 1;

    const IS_GOOGLE_ADS_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_GOOGLE_ADS_EXPIRY_NOTICE_SEND_YES = 1;

    const IS_OTHER_SERVICE_EXPIRY_NOTICE_SEND_NO = 0;
    const IS_OTHER_SERVICE_EXPIRY_NOTICE_SEND_YES = 1;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getProjectStatusName($id)
    {
        switch ($id) {
            case static::STATUS_NEW:
                return 'New';
                break;
            case static::STATUS_QUOTATION:
                return 'Quotation';
                break;
            case static::STATUS_DESIGN:
                return 'Design';
                break;
            case static::STATUS_DEVELOPING_MOCK:
                return 'Developing Mock';
                break;
            case static::STATUS_AMENDMENT_STAGE:
                return 'Amendment Stage';
                break;
            case static::STATUS_COMPLETION:
                return 'Completion';
                break;
            case static::STATUS_PENDING:
                return 'Pending';
                break;
            case static::STATUS_CANCEL:
                return 'Cancel';
                break;
            default:
                return '-';
                break;
        }
    }
    public static function getProjectCompletion($id)
    {
        switch ($id) {
            case static::STATUS_NEW:
                return 0;
                break;
            case static::STATUS_QUOTATION:
                return 10;
                break;
            case static::STATUS_DESIGN:
                return 30;
                break;
            case static::STATUS_DEVELOPING_MOCK:
                return 50;
                break;
            case static::STATUS_AMENDMENT_STAGE:
                return 70;
                break;
            case static::STATUS_COMPLETION:
                return 100;
                break;
            case static::STATUS_PENDING:
                return 50;
                break;
            case static::STATUS_CANCEL:
                return 0;
                break;
            default:
                return '-';
                break;
        }
    }

    public static function getProjectStatusLists($empty = false)
    {
        $arr = array();
        if ($arr === true) {
            $arr[] = 'Project Status';
        }
        $arr[static::STATUS_NEW] = 'New';
        $arr[static::STATUS_QUOTATION] = 'Quotation';
        $arr[static::STATUS_DESIGN] = 'Design';
        $arr[static::STATUS_DEVELOPING_MOCK] = 'Developing Mock';
        $arr[static::STATUS_AMENDMENT_STAGE] = 'Amendment Stage';
        $arr[static::STATUS_COMPLETION] = 'Completion';
        $arr[static::STATUS_PENDING] = 'Pending';
        $arr[static::STATUS_CANCEL] = 'Cancel';

        return $arr;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
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
