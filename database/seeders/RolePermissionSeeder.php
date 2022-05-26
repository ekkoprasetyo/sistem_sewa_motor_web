<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = DB::table('t_rent_permission')->get();

        foreach ($permissions as $perm) {
            DB::table('t_rent_role_permission')->insert([
                'c_role_id' => 1,
                'c_permission_id' => $perm->c_permission_id,
            ]);
        }
    }
}
