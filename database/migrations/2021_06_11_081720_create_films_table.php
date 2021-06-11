<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('writer');
            $table->string('actors');
            $table->string('director');
            $table->string('title');
            $table->string('genre');
            $table->date('published_at');
            $table->unsignedInteger('year');
            $table->text('plot');
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('production')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
