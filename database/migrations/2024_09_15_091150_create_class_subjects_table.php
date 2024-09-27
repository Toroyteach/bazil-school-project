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
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->increments('id'); // auto-increment primary key
            $table->string('subject_name')->unique(); // e.g., Mathematics, Science
            $table->string('subject_code')->unique(); // e.g., MATH101, ENG102

            // Foreign key to 'st_classes' table, nullable
            $table->integer('class_id')->unsigned()->nullable(); 
            $table->foreign('class_id')->references('id')->on('st_classes')->onDelete('set null'); 
            
            // Foreign key to 'users' table (teacher), nullable
            $table->integer('teacher_id')->unsigned()->nullable(); 
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('set null'); 

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
