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
    Schema::create('leads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('crm_id')->constrained('crm')->onDelete('cascade');
        $table->string('source')->nullable(); // contoh: website, event, referral
        $table->enum('status', ['new', 'contacted', 'qualified', 'unqualified'])->default('new');
        $table->enum('category', ['universitas', 'smk', 'media partner','comunity', 'hotel', 'bank-finance', 'other institutions'])-nullable();

        $table->string('assigned_to')->nullable(); // sales person
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
