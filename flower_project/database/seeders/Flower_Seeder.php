<?php

namespace Database\Seeders;
use App\Models\Flower;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Flower_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $flowers= [
            [
                'flower_name' => 'Rose',
                'flower_type' => 'native',
                'store_id' => 1
                
            ],
            [
                'flower_name' => 'Rose',
                'flower_type' => 'native',
                'store_id' => 2
            ],
            [
                'flower_name' => 'Rose',
                'flower_type' => 'native',
                'store_id' => 3
            ],
            [
                'flower_name' => 'Rose',
                'flower_type' => 'native',
                'store_id' => 4
            ],
            [
                'flower_name' => 'Rose',
                'flower_type' => 'native',
                'store_id' => 5
            ]

        ];
        Flower::insert($flowers);
    }
    
}