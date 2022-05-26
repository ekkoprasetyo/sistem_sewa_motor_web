<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_rent_role')->insert([
            'c_role_name' => 'administrator',
            'c_role_display' => 'Administrator',
            'c_role_description' => 'As Administrator',
            'c_role_update_by' => 1,
            'c_role_update_time' => date('Y-m-d H:i:s'),
            'c_role_soft_delete' => 0,
        ]);
    }
}
