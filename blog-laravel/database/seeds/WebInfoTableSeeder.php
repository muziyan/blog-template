<?php

use App\WebInfo;
use Illuminate\Database\Seeder;

class WebInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 7; $i > 0; $i--){
            $query = [
                "access" => 0,
                "created_at" => Date("Y-m-d",strtotime("-{$i} day"))
            ];

            WebInfo::create($query);
        }
    }
}
