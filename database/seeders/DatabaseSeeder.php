<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(4)->create();
        Notice::factory(10)->create();
        Activity::factory(10)->create();
        // Course::factory(10)->create();
        // Assessment::factory(10)->create();
    }
}
