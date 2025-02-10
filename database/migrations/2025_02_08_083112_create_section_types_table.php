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
        Schema::create('section_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Section Type Name (e.g., Hero, Feature)
            $table->string('code')->unique(); // Unique Code (e.g., hero, feature)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_types');
    }
};
