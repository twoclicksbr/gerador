<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tc_address', function (Blueprint $table) {
            $table->id();

            // 🔹 Chaves estrangeiras
            $table->foreignId('id_credential')->constrained('tc_credential');
            $table->foreignId('id_person')->constrained('tc_person');
            $table->foreignId('id_type_address')->constrained('tc_type_address');

            // 🔹 Campos de endereço
            $table->boolean('main')->default(false);
            $table->string('cep', 9)->nullable();
            $table->string('street')->nullable();
            $table->string('number', 20)->nullable();
            $table->string('complement')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();

            // 🔹 Controle padrão
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tc_address');
    }
};
