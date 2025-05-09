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
            $table->string('contact_id')->nullable()->change();
            // Change the data type to integer (or any other desired type)
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reversing a data type change in Laravel is not straightforward,
        // as it depends on the specific database system you are using.
        // If you need to rollback, you might consider creating another migration
        // to change it back to the original type.
    }
};

