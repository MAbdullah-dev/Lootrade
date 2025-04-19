<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_counter', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('next_ticket')->default(1);
        });

        DB::table('ticket_counter')->insert(['id' => 1, 'next_ticket' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_counters');
    }
};
