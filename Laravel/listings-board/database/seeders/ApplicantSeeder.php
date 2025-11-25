<?php

namespace Database\Seeders;

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

    }
}
