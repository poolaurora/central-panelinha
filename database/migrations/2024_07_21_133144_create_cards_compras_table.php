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
        Schema::create('cards_compras', function (Blueprint $table) {
            $table->id();
            $table->decimal('compra_value', 10, 2);
            $table->timestamp('compra_time');
            $table->string('compra_fatura'); // Nova coluna
            $table->foreignId('card_id')->constrained('cards');
            $table->enum('compra_status', ['pendente', 'paga']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards_compras');
    }
};
