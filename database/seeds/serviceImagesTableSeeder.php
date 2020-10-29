<?php

use Illuminate\Database\Seeder;

class ServiceImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_images')->insert([
            [
                'service_id' => 2,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'service_id' => 3,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 3,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'service_id' => 4,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 4,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 4,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 5,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 5,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 5,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 6,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 6,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'service_id' => 7,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 10,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 11,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 11,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 12,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 12,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 3,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 12,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 13,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 13,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 13,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'service_id' => 14,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 14,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 15,
                'image_path' => '/img/service'.rand(1 , 8).'.png',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
