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
        Schema::create('conversation_trees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('conversation_trees')->nullOnDelete();
            $table->string('question');
            $table->text('answer')->nullable();
            $table->string('button_text');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_trees');
    }
};