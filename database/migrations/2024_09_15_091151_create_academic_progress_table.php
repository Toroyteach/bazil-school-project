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
        Schema::create('academic_progress', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('student_id')->unsigned(); // foreign key to students
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            
            $table->integer('subject_id')->unsigned(); // foreign key to subjects
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->enum('progress_type', ['Exam', 'Project', 'Assignment', 'Class Participation', 'Other']); // type of academic progress
            $table->text('description')->nullable(); // description of the progress
            $table->string('grade')->nullable(); // grade for the progress (nullable)
            $table->enum('status', ['Completed', 'Pending', 'In-Progress'])->default('Pending'); // status of the progress
            $table->string('term'); // e.g., Term 1, Term 2
            $table->string('academic_year'); // e.g., 2023-2024
            $table->date('date_recorded'); // date when the progress was recorded
            $table->text('teacher_comments')->nullable(); // comments from the teacher
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_progress');
    }
};
