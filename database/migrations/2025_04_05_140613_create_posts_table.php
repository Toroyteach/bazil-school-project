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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('type', ['event', 'blog', 'story'])->default('blog');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_active')->default(false);
            $table->integer('author_id')->unsigned(); // foreign key to students
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->json('meta')->nullable(); // For video link, etc.
            $table->timestamps();
        });

        Schema::create('post_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned(); // foreign key to students
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->integer('user_id')->unsigned(); // foreign key to students
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');

        Schema::dropIfExists('post_user');
    }
};
