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
        Schema::create('xero_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); // Assuming you have a user_id associated with the token
            $table->string('refresh_token');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('xero_tokens');
    }
};
