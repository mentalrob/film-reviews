<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWriterColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->text('writer')->change();
            $table->text('director')->change();
            $table->text('actors')->change();
            $table->text('genre')->change();
            $table->text('title')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->string('writer')->change();
            $table->string('writer')->change();
            $table->string('director')->change();
            $table->string('actors')->change();
            $table->string('genre')->change();
            $table->string('title')->change();
        });
    }
}
