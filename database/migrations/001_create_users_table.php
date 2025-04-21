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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('profile_picture')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('joined_date');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('ticket_balance')->default(0);
            $table->boolean('profile_completion_awarded')->default(false);
            $table->date('last_login_at')->nullable();
            $table->date('last_login_award_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};
