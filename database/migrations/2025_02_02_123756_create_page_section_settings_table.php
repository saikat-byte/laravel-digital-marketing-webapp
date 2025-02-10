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
        Schema::create('page_section_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->constrained('page_sections')->onDelete('cascade');
            $table->string('key');
            $table->longText('value')->nullable(); // Changed to longText for larger content storage
            $table->enum('value_type', [
                'text',
                'number',
                'boolean',
                'json',
                'array',
                'file',
                'color',
                'date'
            ])->default('text');
            $table->json('meta')->nullable(); // Added for additional metadata
            $table->string('group')->nullable(); // Added for grouping settings
            $table->timestamps();
            // Added composite unique index
            $table->unique(['page_section_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_section_settings');
    }
};
