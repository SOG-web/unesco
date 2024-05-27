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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->decimal('progress', 5, 2)->default(0.00);
            $table->boolean('completed')->default(false);
            $table->boolean('started')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
