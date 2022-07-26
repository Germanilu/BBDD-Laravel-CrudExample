<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'Marc',
            'email' => 'marc@marc.com',
            'password' => 'princess',
        ],[
            'name' => 'Luciano',
            'email' => 'luciano@luciano.com',
            'password' => 'princessGold',
        ]]);
    }
}
