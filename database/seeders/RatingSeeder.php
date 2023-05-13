<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingSeeder extends Seeder
{
    
    public function run(): void
    {
        for($i=2; $i<=11; $i++)
        {
            for ($j=1; $j<=10; $j++)
            {
                DB::table('ratings')->insert([
                    'user_id'               => $i,
                    'location_object_id'    => $j,
                    'score'                 => rand(1,5),
                    'comment'               => 'B Aja'
                ]);
            }
        }
    }
}
