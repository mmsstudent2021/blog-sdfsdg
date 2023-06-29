<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ["html","css","js","web dev","hacking","backend"];

        $data = [];

        foreach($tags as $tag){
            $data[] = [
                "title" => $tag,
                "user_id" => rand(1,12),
                "created_at" => now(),
                "updated_at" => now()
            ];
        }

        Tag::insert($data);
    }
}
