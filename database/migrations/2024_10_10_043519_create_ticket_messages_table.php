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
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('user_id');
            $table->text('message');
            $table->timestamps();
        });

         // Add foreign key constraints if the referenced tables exist
         if (Schema::hasTable('tickets')) {
            Schema::table('ticket_messages', function (Blueprint $table) {
                $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('users')) {
            Schema::table('ticket_messages', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_messages');
    }
};