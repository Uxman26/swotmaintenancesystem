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
            $table->string('access_token')->nullable();
            $table->timestamp('access_token_expire_at')->nullable();
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
            $table->dropColumn('access_token');
            $table->dropColumn('access_token_expire_at');
        });
    }
};
