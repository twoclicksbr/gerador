<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tc_person', function (Blueprint $table) {
            $table->string('whatsapp', 20)->nullable()->after('birthdate');
            $table->string('cpf_cnpj', 20)->nullable()->after('whatsapp');
            $table->string('gender', 20)->nullable()->after('cpf_cnpj');
        });
    }

    public function down(): void
    {
        Schema::table('tc_person', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'cpf_cnpj', 'gender']);
        });
    }
};
