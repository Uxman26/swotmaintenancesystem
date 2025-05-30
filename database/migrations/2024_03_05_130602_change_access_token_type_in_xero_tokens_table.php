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
        Schema::table('xero_tokens', function (Blueprint $table) {
            $table->text('access_token')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('xero_tokens', function (Blueprint $table) {
            // If needed, you can revert the change in the 'down' method
            // Example: $table->string('access_token')->change();
        });
    }
};
