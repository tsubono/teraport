<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            [
                'transaction_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],
            [
                'transaction_id' => 2,
                'created_at' => date('Y-m-d H:i:s', strtotime("2 day")),
                'deleted_at' => null,
            ],
            [
                'transaction_id' => 3,
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],
            [
                'transaction_id' => 4,
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],

            [
                'transaction_id' => 5,
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],
            [
                'transaction_id' => 6,
                'created_at' => date('Y-m-d H:i:s', strtotime("2 day")),
                'deleted_at' => null,
            ],
            [
                'transaction_id' => 7,
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],
            [
                'transaction_id' => 8,
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],
        ]);
    }
}
