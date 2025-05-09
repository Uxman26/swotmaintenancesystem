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
            $table->string('quote_number')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->text('summary')->nullable()->change();
            $table->string('reference')->nullable()->change();
            $table->string('currency')->nullable()->change();
            $table->string('project')->nullable()->change();
            $table->string('tax')->nullable()->change();
            $table->text('terms')->nullable()->change();
            $table->decimal('subtotal', 10, 2)->nullable()->change();
            $table->decimal('total', 10, 2)->nullable()->change();
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
            $table->string('quote_number')->nullable(false)->change();
            $table->string('title')->nullable(false)->change();
            $table->text('summary')->nullable(false)->change();
            $table->string('reference')->nullable(false)->change();
            $table->string('currency')->nullable(false)->change();
            $table->string('project')->nullable(false)->change();
            $table->string('tax')->nullable(false)->change();
            $table->text('terms')->nullable(false)->change();
            $table->decimal('subtotal', 10, 2)->nullable(false)->change();
            $table->decimal('total', 10, 2)->nullable(false)->change();
        });
    }
};
