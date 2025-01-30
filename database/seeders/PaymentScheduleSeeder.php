<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_schedules')->insert([
            ['course_id' => 1,
              'amount' => json_encode([
                'Africa'=> 120000.00,
                'Other' => 1200,
              ]) ,
              'purpose' => 'sch_fee',
              'description' => 'payment for business analysic basic course',
            ],
            ['course_id' => 2,
              'amount' => json_encode([
                'Africa'=> 350000.00,
                'Other' => 2500,
              ]) ,
              'purpose' => 'sch_fee',
              'description' => 'payment for business analysis complete package course',
            ], 
            ['course_id' => 3,
              'amount' => json_encode([
                'Africa'=> 250000.00,
                'Other' => 1600,
              ]) ,
              'purpose' => 'sch_fee',
              'description' => 'payment for business analysis job ready course',
            ], 
            ['course_id' => 4,
              'amount' => json_encode([
                'Africa'=> 120000.00,
                'Other' => 1200,
              ]) ,
              'purpose' => 'sch_fee',
              'description' => 'payment for scrum master certification',
            ],
            ['course_id' => 5,
              'amount' => json_encode([
                'Africa'=> 350000.00,
                'Other' => 2500,
              ]) ,
              'purpose' => 'sch_fee',
              'description' => 'payment for scrum master and product owner certification course',
            ],
            ['course_id' => 6,
              'amount' => json_encode([
                'Africa'=> 250000.00,
                'Other' => 1600,
              ]) ,
              'purpose' => 'sch_fee',
              'description' => 'payment for product owner certification',
            ],   

        ]);
    }
}
