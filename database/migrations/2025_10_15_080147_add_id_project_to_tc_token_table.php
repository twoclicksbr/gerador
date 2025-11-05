<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tc_token', function (Blueprint $table) {
            $table->unsignedBigInteger('id_project')
                ->nullable()
                ->after('id_credential');
        });
    }

    public function down(): void
    {
        Schema::table('tc_token', function (Blueprint $table) {
            $table->dropColumn('id_project');
        });
    }
};
