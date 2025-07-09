<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raffles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->integer('max_entries_per_user')->nullable();
            $table->json('prize')->nullable();
            $table->integer('slots')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            // Removed generated column here
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('raffles');
    }
};
