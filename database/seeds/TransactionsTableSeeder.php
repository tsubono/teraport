<?php

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            [
                'service_id' => null,
                'seller_user_id' => 2,
                'buyer_user_id' => 4,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],
            [
                'service_id' => null,
                'seller_user_id' => 3,
                'buyer_user_id' => 5,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', strtotime("2 day")),
                'deleted_at' => null,
            ],
            [
                'service_id' => null,
                'seller_user_id' => 2,
                'buyer_user_id' => 5,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],
            [
                'service_id' => null,
                'seller_user_id' => 3,
                'buyer_user_id' => 4,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],

            [
                'service_id' => 1,
                'seller_user_id' => 2,
                'buyer_user_id' => 4,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],
            [
                'service_id' => 5,
                'seller_user_id' => 3,
                'buyer_user_id' => 5,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime("2 day")),
                'deleted_at' => null,
            ],
            [
                'service_id' => 9,
                'seller_user_id' => 4,
                'buyer_user_id' => 2,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],
            [
                'service_id' => 14,
                'seller_user_id' => 5,
                'buyer_user_id' => 3,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],
        ]);
    }
}
