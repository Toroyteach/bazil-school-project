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
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('dob'); // date of birth
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postal_code')->nullable();
            $table->string('parent_phone_1'); // primary parent phone number
            $table->string('parent_phone_2'); // secondary parent phone number
            $table->string('parent_email_1')->nullable();
            $table->string('parent_email_2')->nullable();
            $table->date('admission_date');
            $table->string('admission_number')->unique(); // unique student identifier

            $table->integer('class_id')->unsigned()->nullable(); 
            $table->foreign('class_id')->references('id')->on('st_classes')->onDelete('set null'); 

            $table->string('section')->nullable(); // if applicable, e.g., Section A, B
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('profile_photo')->nullable(); // URL or path to profile photo
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
