<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WalletTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wallet')->delete();
        
        \DB::table('wallet')->insert(array (
            0 => 
            array (
                'id' => 1,
                'balance' => '61.00',
                'customer_id' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:14:41',
                'updated_at' => '2024-03-30 23:19:35',
            ),
            1 => 
            array (
                'id' => 2,
                'balance' => '50.00',
                'customer_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:15:15',
                'updated_at' => '2024-03-30 23:18:41',
            ),
            2 => 
            array (
                'id' => 3,
                'balance' => '35.00',
                'customer_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:15:53',
                'updated_at' => '2024-03-30 23:18:53',
            ),
            3 => 
            array (
                'id' => 4,
                'balance' => '72.00',
                'customer_id' => 4,
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:16:24',
                'updated_at' => '2024-03-30 23:19:11',
            ),
            4 => 
            array (
                'id' => 5,
                'balance' => '43.00',
                'customer_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:17:47',
                'updated_at' => '2024-03-30 23:19:22',
            ),
        ));
        
        
    }
}