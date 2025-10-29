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
            $table->foreignId('last_updated_by')->nullable()->constrained('users')->nullOnDelete();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('last_updated_by')->nullable()->constrained('users')->nullOnDelete();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('last_updated_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
