<?php

use App\Models\User;
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
        Schema::create('ls_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Добавляем поле user_id
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('to_user_id'); // Добавляем поле user_id
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->text('message')->nullable();
            $table->string('image');
            $table->timestamps();
            // ->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ls_messages');
    }
};
