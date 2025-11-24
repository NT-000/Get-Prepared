<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobApplicants = include database_path('seeders/data/applicants.php');

        DB::table("applicants")->insert($jobApplicants);

//        $testUser = User::where('email', 'test@test.com')->firstOrFail();
//        $randomApplicationIds = Applicant::pluck('id')->random(3);
//        $testUser->applicants()->attach($randomApplicationIds);
    }
}
