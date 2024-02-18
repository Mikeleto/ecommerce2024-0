<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professions', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->string('education_level')->nullable();
            $table->integer('salary')->nullable();
            $table->string('sector')->nullable();
            $table->integer('experience_required')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professions', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('education_level');
            $table->dropColumn('salary');
            $table->dropColumn('sector');
            $table->dropColumn('experience_required');
        });
    }
}