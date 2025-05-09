<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('name', 255)->collation('utf8mb4_unicode_ci');
            $table->string('email', 255)->unique()->collation('utf8mb4_unicode_ci');
            $table->string('avatar', 255)->default('users/default.png')->collation('utf8mb4_unicode_ci');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->collation('utf8mb4_unicode_ci');
            $table->string('remember_token', 100)->nullable()->collation('utf8mb4_unicode_ci');
            $table->text('settings')->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('is_welcome_email_send')->default(0)->comment('0.No, 1.Yes');
            $table->timestamps();
            
            // Add foreign key constraint for 'role_id'
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
