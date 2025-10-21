<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tc_person_plan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_credential')->constrained('tc_credential');
            $table->foreignId('id_person')->constrained('tc_person');
            $table->foreignId('id_plan')->constrained('tc_plan');

            $table->string('payment_cycle', 20)->nullable(); // mensal / anual
            $table->timestamp('dt_start')->nullable();
            $table->timestamp('dt_end')->nullable();
            $table->boolean('active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tc_person_plan');
    }
};
