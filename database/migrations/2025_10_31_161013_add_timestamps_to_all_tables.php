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
        Schema::table('products', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('product_brands', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('service_categories', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('project_categories', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_tables', function (Blueprint $table) {
            //
        });
    }
};
