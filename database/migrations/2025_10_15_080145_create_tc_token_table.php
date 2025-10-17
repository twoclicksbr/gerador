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
        Schema::create('tc_token', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_credential')->constrained('tc_credential');
            $table->foreignId('id_person')->constrained('tc_person');

            // Token único gerado no login
            $table->string('token')->unique();

            // IP do dispositivo que realizou o login
            $table->string('ip_address')->nullable();

            // Informações do dispositivo (navegador, sistema, etc.)
            $table->string('device_info')->nullable();

            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_token');
    }
};
