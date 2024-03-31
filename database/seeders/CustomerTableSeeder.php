<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customer')->delete();
        
        \DB::table('customer')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_name' => 'Douglas J.',
                'last_name' => 'Amador',
                'full_address' => '13 Boughton Rd WHYGATE NE48 3EQ',
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:14:41',
                'updated_at' => '2024-03-30 23:14:41',
            ),
            1 => 
            array (
                'id' => 2,
                'first_name' => 'George F.',
                'last_name' => 'Douglas',
                'full_address' => '21 North Road NETHERLEY AB3 6YW',
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:15:15',
                'updated_at' => '2024-03-30 23:15:15',
            ),
            2 => 
            array (
                'id' => 3,
                'first_name' => 'Demetrius A.',
                'last_name' => 'Long',
                'full_address' => '51 South Street MONYASH DE45 1TL',
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:15:52',
                'updated_at' => '2024-03-30 23:15:52',
            ),
            3 => 
            array (
                'id' => 4,
                'first_name' => 'Mae T.',
                'last_name' => 'Diaz',
                'full_address' => '72 Asfordby Rd ALDERWASLEY DE56 6UZ',
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:16:24',
                'updated_at' => '2024-03-30 23:18:13',
            ),
            4 => 
            array (
                'id' => 5,
                'first_name' => 'Najibah Juhaynah',
                'last_name' => 'Ganem',
                'full_address' => 'Harevænget 27 1804 Frederiksberg C',
                'deleted_at' => NULL,
                'created_at' => '2024-03-30 23:17:47',
                'updated_at' => '2024-03-30 23:17:47',
            ),
        ));
        
        
    }
}