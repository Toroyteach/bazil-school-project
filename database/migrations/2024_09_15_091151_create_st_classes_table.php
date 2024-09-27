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
        Schema::create('st_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_name'); // e.g., Grade 1, Grade 2
            $table->string('section')->nullable(); // Section if applicable (e.g., A, B)
            $table->integer('class_teacher_id')->unsigned()->nullable(); // foreign key to class teacher
            $table->foreign('class_teacher_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('st_classes');
    }
};
