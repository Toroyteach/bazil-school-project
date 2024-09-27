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
        Schema::create('school_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->unsigned(); // foreign key to students
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->decimal('amount_due', 10, 2); // total amount due for the student
            $table->decimal('amount_paid', 10, 2)->default(0); // amount already paid
            $table->decimal('balance', 10, 2); // remaining balance
            $table->enum('status', ['Paid', 'Partial', 'Unpaid'])->default('Unpaid'); // payment status
            $table->date('due_date'); // due date for payment
            $table->integer('payment_method_id')->unsigned()->nullable(); // foreign key to payment methods
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
            $table->text('remarks')->nullable(); // any additional remarks or comments
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_fees');
    }
};
