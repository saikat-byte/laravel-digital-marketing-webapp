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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // relation with post
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            // relation with user to write comment
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // reply comment parent_comment_id (nullable)
            $table->foreignId('parent_comment_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->text('content');
            $table->integer('rating')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
