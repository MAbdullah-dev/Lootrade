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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_package_id')->constrained()->onDelete('cascade');
            $table->integer('package_quantity');
            $table->integer('total_tickets');
            $table->integer('total_price');
            $table->string('stripe_transaction_id');
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
