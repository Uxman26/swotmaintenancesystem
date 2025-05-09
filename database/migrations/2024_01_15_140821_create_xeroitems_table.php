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
        Schema::create('xeroitems', function (Blueprint $table) {
            $table->id();
            $table->string('item-id');
            $table->string('code');
            $table->string('item-name');
            $table->string('sales-description');
            $table->string('purchase-description');
            $table->string('cost-price');
            $table->string('purchase-account');
            $table->string('purchase-tax');
            $table->string('sell-price');
            $table->string('sales-account');
            $table->string('sales-tax');
            $table->string('created_by');
            $table->string('created_by_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xeroitems');
    }
};
