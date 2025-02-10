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
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code')->nullable()->unique();  // Added for section code
            $table->string('type', 255);
            $table->text('description')->nullable();  // Added for section description
            $table->string('heading')->nullable();          // Section Heading
            $table->string('sub_heading')->nullable();      // Sub Heading
            $table->longText('paragraph')->nullable();      // Long Text Field
            $table->integer('order')->default(0);
            $table->boolean('status')->default(1);
            $table->json('validation_rules')->nullable(); // Added for section specific validation
            $table->json('config')->nullable();
            $table->string('image')->nullable();             // Image Upload
            $table->json('multi_image')->nullable();        // Multi Image Upload
            $table->string('video')->nullable();            // Video Upload
            $table->string('button_1_text')->nullable();    // First Button Text
            $table->string('button_1_link')->nullable();    // First Button Link
            $table->string('button_2_text')->nullable();    // Second Button Text
            $table->string('button_2_link')->nullable();    // Second Button Link
            $table->string('pdf')->nullable();              // PDF Upload
            $table->timestamps();
            $table->softDeletes();  // Added for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
