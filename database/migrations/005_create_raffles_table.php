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
            $table->integer('entry_cost')->default(1);
            $table->integer('max_entries_per_user')->nullable();
            $table->integer('prize')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('status', 20)->virtualAs("
                CASE
                    WHEN start_date <= NOW() AND end_date >= NOW() THEN 'active'
                    WHEN start_date > NOW() THEN 'upcoming'
                    ELSE 'past'
                END
            ")->stored();

            // $table->index('status');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('raffles');
    }
};
