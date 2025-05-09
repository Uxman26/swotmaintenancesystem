<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('xerocontacts', function (Blueprint $table) {
            $table->boolean('contact_id')->default(false)->after('created_by_id');
            // You can modify the default value or use another data type based on your requirements
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('xerocontacts', function (Blueprint $table) {
            $table->dropColumn('contact_id');
        });
    }
};
