<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('experience_details', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('status');
            $table->string('project_no');
            $table->string('project_name');
            $table->string('client_name');
            $table->string('durations');
            $table->string('amount');
            $table->date('date_project_start');
            $table->date('date_project_end');
            $table->string('locations');
            $table->string('kbli_number');
            $table->text('scope_of_work');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_details');
    }
};
