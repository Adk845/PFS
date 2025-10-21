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
       Schema::create('proposal_files', function (Blueprint $table) {
    $table->id();
    $table->foreignId('proposal_id')->constrained('proposals')->onDelete('cascade');
    $table->string('file_name'); // nama file aslinya
    $table->string('file_path'); // path di storage
    $table->string('uploaded_by')->nullable(); // opsional: siapa yang upload
    $table->text('notes')->nullable(); // opsional: catatan, revisi keberapa, dll
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_files');
    }
};
