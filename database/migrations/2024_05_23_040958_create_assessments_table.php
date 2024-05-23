<?php

use App\Models\Assessment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('status')->default('active');
            $table->string('type');
            $table->boolean('show_result')->default(true);
            $table->integer('no_of_questions');
            $table->integer('mark_per_questions')->nullable();
            $table->json('questions');
        });

        Schema::create('assessment_student', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Assessment::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->json('answers')->nullable();
            $table->integer('total_mark')->nullable();
            $table->string('status')->default('pending');
            $table->dateTime('completed_at')->nullable();
            $table->boolean('submitted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
        Schema::dropIfExists('assessment_student');
    }
};
