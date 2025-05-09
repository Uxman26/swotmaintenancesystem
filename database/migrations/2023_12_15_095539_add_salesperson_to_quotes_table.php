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
        Schema::table('quotes', function (Blueprint $table) {
            // Add new columns
            $table->string('salespersonID')->nullable();
            $table->string('salespersonName')->nullable();
            
            // Add foreign key constraint if needed
            // $table->foreign('salespersonID')->references('id')->on('salespersons');
            
            // Update the existing schema if needed
            // $table->string('existing_column')->nullable()->change();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            // Remove the added columns
            $table->dropColumn(['salespersonID', 'salespersonName']);
            
            // If foreign key constraint is added, you may want to drop it here
            // $table->dropForeign(['salespersonID']);
        });
    }
};
