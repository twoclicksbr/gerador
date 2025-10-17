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
        Schema::create('tc_person_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_credential')->constrained('tc_credential');
            $table->foreignId('id_person')->constrained('tc_person');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('remember_token')->default(false);
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
        Schema::dropIfExists('tc_person_user');
    }
};
