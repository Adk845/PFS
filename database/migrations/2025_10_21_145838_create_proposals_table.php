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
      Schema::create('proposals', function (Blueprint $table) {
    $table->id();

    // relasi ke leads (atau crm)
    $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');

    $table->string('title');
    $table->enum('status', [
        'draft',
        'submitted',
        'awaiting_po',
        'awarded',
        'decline',
        'lost'
    ])->default('draft');
    
    // relasi ke user (assigned to)
    $table->foreignId('assign_to')->nullable()->constrained('users')->onDelete('set null');

    $table->text('description')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
