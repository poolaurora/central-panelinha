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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_number')->unique();
            $table->string('card_holderName');
            $table->integer('card_YY'); // Usar integer para o ano
            $table->integer('card_MM'); // Usar integer para o mês
            $table->string('card_cvv');
            $table->foreignId('card_empresa_id')->constrained('cards_empresa');
            $table->enum('card_status', ['active', 'inactive', 'secado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
