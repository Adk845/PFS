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
    Schema::create('customer_personas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('crm_id')->constrained('crm')->onDelete('cascade');
        $table->string('date_of_birth')->nullable();
        $table->string('gender')->nullable();
        $table->string('occupation')->nullable();
        $table->string('income_level')->nullable();
        $table->string('education_level')->nullable();
        $table->string('key_interest')->nullable();
        $table->string('pain_point')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_personas');
    }
};
