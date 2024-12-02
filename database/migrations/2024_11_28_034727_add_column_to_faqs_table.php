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
        Schema::table('faqs', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('faq_categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategory_faq')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            Schema::dropIfExists('faqs');
        });
    }
};
