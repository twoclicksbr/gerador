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
        Schema::create('tc_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_credential')->constrained('tc_credential');
            $table->string('name'); // Nome do plano (ex: Básico, Premium)
            $table->decimal('price_monthly', 10, 2)->default(0); // Valor mensal
            $table->decimal('price_yearly', 10, 2)->default(0);  // Valor anual
            $table->boolean('active')->default(1); // Se o plano está disponível
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_plan');
    }
};
