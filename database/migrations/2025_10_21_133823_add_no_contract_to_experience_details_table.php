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
    Schema::table('experience_details', function (Blueprint $table) {
        $table->string('no_contract')->nullable()->after('project_no');
    });
}

public function down()
{
    Schema::table('experience_details', function (Blueprint $table) {
        $table->dropColumn('no_contract');
    });
}

};
