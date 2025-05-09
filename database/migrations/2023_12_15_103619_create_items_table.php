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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('quote_id');
            $table->string('description');
            $table->integer('quantity');
            $table->decimal('unit_amount', 10, 2);
            $table->string('account_code');
            $table->timestamps();
            
           
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
