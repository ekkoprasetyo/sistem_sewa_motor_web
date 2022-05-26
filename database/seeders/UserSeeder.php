<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        DB::table('t_rent_user')->insert([
            'c_user_full_name' => 'Eko Prasetyo',
            'c_user_email' => 'ekkoprasetyo@gmail.com',
            'c_user_password' => Hash::make('admin123'),
            'c_user_role' => 1,
            'c_user_status' => 1,
            'c_user_update_by' => 1,
            'c_user_update_time' => date('Y-m-d H:i:s'),
            'c_user_soft_delete' => 0,
        ]);
    }
}
