<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_seo_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_title')->nullable();           // Open Graph title
            $table->text('og_description')->nullable();       // Open Graph description
            $table->string('og_image')->nullable();           // Open Graph image
            $table->string('twitter_card')->nullable();       // Twitter card type
            $table->string('twitter_title')->nullable();      // Twitter title
            $table->text('twitter_description')->nullable();  // Twitter description
            $table->string('twitter_image')->nullable();      // Twitter image
            $table->string('canonical_url')->nullable();      // Canonical URL
            $table->json('structured_data')->nullable();      // JSON-LD structured data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_seo_settings');
    }
};
