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
        Schema::create('common_sections', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('name');
            // Slug is required and must be unique. Generate it in the application code.
            $table->string('slug')->unique();
            // Optional section code for internal reference (unique if provided)
            $table->string('code')->nullable()->unique();

            // Section Type and Description
            $table->string('type', 255);
            $table->text('description')->nullable();

            // Content Fields
            $table->string('heading')->nullable();       // Main heading for the section
            $table->string('sub_heading')->nullable();   // Sub-heading for the section
            $table->longText('paragraph')->nullable();   // Detailed text or paragraph

            // Display Order and Status
            $table->integer('order')->default(0);
            $table->boolean('status')->default(1);

            // Additional Configuration / Validation (Stored as JSON)
            $table->json('validation_rules')->nullable();
            $table->json('config')->nullable();          // For storing custom configuration (e.g., card texts, button texts, etc.)

            // Media Uploads
            $table->string('image')->nullable();         // Single image upload
            $table->json('multi_image')->nullable();     // Multiple images stored as JSON array
            $table->string('video')->nullable();         // Video file path
            $table->string('pdf')->nullable();           // PDF file path

            // Button Data
            $table->string('button_1_text')->nullable();
            $table->string('button_1_link')->nullable();
            $table->string('button_2_text')->nullable();
            $table->string('button_2_link')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_sections');
    }
};
