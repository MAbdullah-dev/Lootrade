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
        Schema::create('raffle_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('raffle_id')->constrained('raffles')->onDelete('cascade');
            $table->foreignId('user_ticket_id')->constrained('user_tickets')->onDelete('cascade');
            $table->string('ticket_number', 100);
            $table->timestamps();

            $table->unique(['raffle_id', 'ticket_number'], 'uk_raffle_ticket');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
