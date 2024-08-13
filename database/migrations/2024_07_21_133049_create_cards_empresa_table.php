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
        Schema::create('cards_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('empresa_razao', 255);
            $table->string('empresa_cnpj', 20)->unique();
            $table->enum('empresa_status', ['active', 'inactive', 'secada'], 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards_empresa');
    }
};
