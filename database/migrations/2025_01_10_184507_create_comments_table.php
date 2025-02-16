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
            // Post এর সাথে সম্পর্ক (foreign key)
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            // Comment লেখার জন্য User এর সাথে সম্পর্ক (foreign key)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // যদি reply হিসেবে কোনো comment থাকে, তাহলে parent_comment_id (nullable)
            $table->foreignId('parent_comment_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->text('content');
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
