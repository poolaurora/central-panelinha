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
        Schema::create('account_id_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da subconta
            $table->text('account_id'); // ID da conta
            $table->integer('probability')->check(function ($column) {
                $column->between(0, 100);
            }); // Probabilidade de uso, deve estar entre 0 e 100
            $table->timestamps(); // Campos de timestamps (created_at e updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_id_tokens');
    }
};
