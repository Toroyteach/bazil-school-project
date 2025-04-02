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
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->integer('class_id')->unsigned(); // foreign key to classes
            $table->foreign('class_id')->references('id')->on('st_classes')->onDelete('cascade');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_subjects');
    }
};
