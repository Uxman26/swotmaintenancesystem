<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name', 250)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('person_in_charge_name', 255)->nullable();
            $table->string('domain_name', 255)->nullable();
            $table->string('company_name', 255)->nullable();
            $table->decimal('one_time_fee', 10, 2)->nullable();
            $table->decimal('renewal_fee', 10, 2)->nullable();
            $table->unsignedBigInteger('package_id');
            $table->string('server_url', 255)->nullable();
            $table->string('server_username', 100)->nullable();
            $table->string('server_password', 255)->nullable();
            $table->string('wordpress_url', 255)->nullable();
            $table->string('wordpress_username', 100)->nullable();
            $table->string('wordpress_password', 255)->nullable();
            $table->text('remark')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->decimal('maintenance', 10, 2)->nullable();
            $table->timestamps();

            // Add foreign key constraint for 'package_id'
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            // Add foreign key constraint for 'user_id'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
