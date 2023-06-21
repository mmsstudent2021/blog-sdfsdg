<?php

namespace Database\Seeders;

use App\Models\Township;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $townships = ['Bahan', 'Sanchaung', 'Tamwe', 'Thamine', 'Hlaing'];
        $arr = [];
        foreach($townships as $township){
            $arr[] = [
                "name" => $township
            ];
        }
        Township::insert($arr);
    }
}
