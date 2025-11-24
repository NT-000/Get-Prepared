<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;


class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testUser = User::where('email', 'test@test.com')->firstOrFail();
        $randomJobIds = Job::pluck('id')->random(3);

        $testUser->bookmarkedJobs()->attach($randomJobIds);
    }
}
