<?php

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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->unique();
            $table->string('duration');
            $table->string('thumbnail')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('type');
            $table->string('video_url')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('link')->nullable();
            $table->string('slug')->unique();
            $table->text('description');
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
        });

        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('course_student');
    }
};
