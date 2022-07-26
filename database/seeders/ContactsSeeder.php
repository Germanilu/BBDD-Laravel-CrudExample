<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'user_id'=> 2,
            'name' => 'Patricio',
            'phone_number' => '652327788',
            'email' => 'patricio@patricio.com',
            'birthday'=> '1993-10-23'
        ]);
    }
}
