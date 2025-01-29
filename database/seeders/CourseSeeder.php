<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'name' => 'business analysis basic',
                'course_code' => 'BAB',
                'duration' => '8 weeks',
            ],
            [
                'name' => 'business analysis complete package',
                'course_code' => 'BACP',
                'duration' => '8 weeks',
            ],
            [
                'name' => 'business analysis job ready',
                'course_code' => 'BAJR',
                'duration' => '8 weeks',
            ],
            [
                'name' => 'scrum master certification',
                'course_code' => 'SMC',
                'duration' => '8 weeks',
            ],
            [
                'name' => 'scrum master and product owner certification',
                'course_code' => 'SMPC',
                'duration' => '8 weeks',
            ],
            [
                'name' => 'product owner certification',
                'course_code' => 'POC',
                'duration' => '8 weeks',
            ],






        ]);
    }
}
