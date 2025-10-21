<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // Hapus kolom lama (string)
            $table->dropColumn('assigned_to');
        });

        Schema::table('leads', function (Blueprint $table) {
            // Tambahkan kolom baru dengan relasi ke users
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['assigned_to']);
            $table->dropColumn('assigned_to');
            $table->string('assigned_to')->nullable(); // rollback ke string
        });
    }
};

