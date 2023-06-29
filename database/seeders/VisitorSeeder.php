<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $endDate = Carbon::now();
        $startDate = Carbon::now()->subWeek();

        $period = CarbonPeriod::create($startDate,$endDate);

        $visitors = [];

        foreach($period as $day){

            $d = $day->addHours(rand(0,18));

            for($i=0;$i<rand(1,30);$i++){
                $visitors[] = [
                    "article_id" => rand(1,10),
                    "user_id" => rand(1,12),
                    "created_at" => $d,
                    "updated_at" => $d
                ];
            }

        }



        Visitor::insert($visitors);
    }
}
