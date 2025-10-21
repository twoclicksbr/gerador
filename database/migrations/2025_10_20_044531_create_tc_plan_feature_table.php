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
        Schema::create('tc_plan_feature', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_credential')->constrained('tc_credential');
            $table->foreignId('id_plan')->constrained('tc_plan'); // Vínculo com o plano
            $table->string('name'); // Nome da característica (ex: Número de Projetos)
            $table->string('value')->nullable(); // Valor (ex: 10, 100MB, Semanal)
            $table->boolean('active')->default(1); // Indica se a característica está ativa
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_plan_feature');
    }
};
