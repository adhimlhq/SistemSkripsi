<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->string('kemajuan_I')->nullable(); // metode penelitian
            $table->string('ulasan_I')->nullable();
            $table->date('update_I')->nullable();
            $table->string('kemajuan_II')->nullable(); // tabulasi data
            $table->string('ulasan_II')->nullable();
            $table->date('update_II')->nullable();
            $table->string('kemajuan_III')->nullable(); // Anilisa Penelitian
            $table->string('ulasan_III')->nullable();
            $table->date('update_III')->nullable();
            $table->string('kemajuan_IV')->nullable(); // kesimpulan
            $table->string('ulasan_IV')->nullable();
            $table->date('update_IV')->nullable();
            $table->timestamps();

            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
