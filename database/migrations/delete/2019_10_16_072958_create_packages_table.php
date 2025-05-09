<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->decimal('price', 10, 0)->nullable();
            $table->integer('domain')->nullable();
            $table->integer('web_pages_design')->nullable();
            $table->integer('web_storage')->nullable();
            $table->integer('email_users')->nullable();
            $table->tinyInteger('mobile_responsive')->nullable();
            $table->tinyInteger('premium_wordpress_template')->nullable();
            $table->integer('revisions')->nullable();
            $table->integer('products_upload')->nullable();
            $table->integer('animated_banner')->nullable();
            $table->tinyInteger('jpeg_mock')->nullable();
            $table->tinyInteger('content_management_system')->nullable();
            $table->tinyInteger('ownership_and_access')->nullable();
            $table->tinyInteger('ssl_certificate')->nullable();
            $table->integer('stock_photos')->nullable();
            $table->integer('graphical_design')->nullable();
            $table->integer('trip_of_visits')->nullable();
            $table->integer('website_maintenance')->nullable();
            $table->integer('premium_paid_plugin')->nullable();
            $table->integer('web_maintenance_guideline')->nullable();
            $table->tinyInteger('technical_support')->nullable();
            $table->decimal('Renewal', 10, 0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
