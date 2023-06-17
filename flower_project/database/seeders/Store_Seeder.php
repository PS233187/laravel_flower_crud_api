<?php

namespace Database\Seeders;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Store_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $stores = [
            [
                'store_link' => 'www.sunflower.com',
                
            ],
            [
                'store_link' => 'www.flowerpower.com',
                
            ],
            [
                'store_link' => 'www.flowerfly.com',

            ],
            [
                'store_link' => 'www.plantforyou.com',
                
            ],
            [
                'store_link' => 'www.plants.com',
                
            ]

        ];
        Store::insert($stores);
    }
    
}