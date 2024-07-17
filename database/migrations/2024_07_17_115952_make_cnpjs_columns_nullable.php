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
        Schema::table('cnpjs', function (Blueprint $table) {
            $table->string('cnpj')->nullable()->change();
            $table->string('razao_social')->nullable()->change();
            $table->string('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cnpjs', function (Blueprint $table) {
            $table->string('cnpj')->nullable(false)->change();
            $table->string('razao_social')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
        });
    }
};
