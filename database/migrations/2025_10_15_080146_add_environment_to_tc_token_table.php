<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tc_token', function (Blueprint $table) {
            // Adiciona o campo de ambiente logo após 'token'
            $table->enum('environment', ['production', 'sandbox'])
                ->default('production')
                ->after('id_credential');
        });
    }

    public function down(): void
    {
        Schema::table('tc_token', function (Blueprint $table) {
            $table->dropColumn('environment');
        });
    }
};
