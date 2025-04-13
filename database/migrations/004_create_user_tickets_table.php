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
        Schema::create('user_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('ticket_number', 20)->unique();
            $table->enum('status', ['available', 'assigned'])->default('available');
            $table->enum('acquisition_type', ['earned', 'purchased']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_tickets');
    }
};