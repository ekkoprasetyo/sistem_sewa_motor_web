<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'c_permission_name' => 'user',
                'c_permission_display' => 'Index User',
                'c_permission_description' => 'Access to Index User',
            ],
            [
                'c_permission_name' => 'user.datatables',
                'c_permission_display' => 'Datatables User',
                'c_permission_description' => 'Access to Datatables User',
            ],
            [
                'c_permission_name' => 'user.add',
                'c_permission_display' => 'Add User',
                'c_permission_description' => 'Access to Add User',
            ],
            [
                'c_permission_name' => 'user.edit',
                'c_permission_display' => 'Edit User',
                'c_permission_description' => 'Access to Edit User',
            ],
            [
                'c_permission_name' => 'user.update',
                'c_permission_display' => 'Update User',
                'c_permission_description' => 'Access to Update User',
            ],
            [
                'c_permission_name' => 'user.store',
                'c_permission_display' => 'Store User',
                'c_permission_description' => 'Access to Store User',
            ],
            [
                'c_permission_name' => 'user.detail',
                'c_permission_display' => 'Detail User',
                'c_permission_description' => 'Access to Detail User',
            ],
            [
                'c_permission_name' => 'user.edit-password',
                'c_permission_display' => 'Edit Password User',
                'c_permission_description' => 'Access to Edit Password User',
            ],
            [
                'c_permission_name' => 'user.update-password',
                'c_permission_display' => 'Update Password User',
                'c_permission_description' => 'Access to Update Password User',
            ],
            [
                'c_permission_name' => 'user.delete',
                'c_permission_display' => 'Delete User',
                'c_permission_description' => 'Access to Delete User',
            ],
            [
                'c_permission_name' => 'user.destroy',
                'c_permission_display' => 'Destroy User',
                'c_permission_description' => 'Access to Destroy User',
            ],
            [
                'c_permission_name' => 'role',
                'c_permission_display' => 'Index Role',
                'c_permission_description' => 'Access to Index Role',
            ],
            [
                'c_permission_name' => 'role.datatables',
                'c_permission_display' => 'Datatables Role',
                'c_permission_description' => 'Access to Datatables Role',
            ],
            [
                'c_permission_name' => 'role.add',
                'c_permission_display' => 'Add Role',
                'c_permission_description' => 'Access to Add Role',
            ],
            [
                'c_permission_name' => 'role.store',
                'c_permission_display' => 'Store Role',
                'c_permission_description' => 'Access to Store Role',
            ],
            [
                'c_permission_name' => 'role.edit',
                'c_permission_display' => 'Edit Role',
                'c_permission_description' => 'Access to Edit Role',
            ],
            [
                'c_permission_name' => 'role.update',
                'c_permission_display' => 'Update Role',
                'c_permission_description' => 'Access to Update Role',
            ],
            [
                'c_permission_name' => 'role.delete',
                'c_permission_display' => 'Delete Role',
                'c_permission_description' => 'Access to Delete Role',
            ],
            [
                'c_permission_name' => 'role.destroy',
                'c_permission_display' => 'Destroy Role',
                'c_permission_description' => 'Access to Destroy Role',
            ],
            [
                'c_permission_name' => 'role.edit-permission',
                'c_permission_display' => 'Edit Permission Role',
                'c_permission_description' => 'Access to Edit Permission Role',
            ],
            [
                'c_permission_name' => 'role.update-permission',
                'c_permission_display' => 'Update Permission Role',
                'c_permission_description' => 'Access to Update Permission Role',
            ],
            [
                'c_permission_name' => 'role.detail',
                'c_permission_display' => 'Detail Role',
                'c_permission_description' => 'Access to Detail Role',
            ],
            [
                'c_permission_name' => 'permission',
                'c_permission_display' => 'Index Permission',
                'c_permission_description' => 'Access to Index Permission',
            ],
            [
                'c_permission_name' => 'permission.datatables',
                'c_permission_display' => 'Datatables Permission',
                'c_permission_description' => 'Access to Datatables Permission',
            ],
            [
                'c_permission_name' => 'permission.add',
                'c_permission_display' => 'Add Permission',
                'c_permission_description' => 'Access to Add Permission',
            ],
            [
                'c_permission_name' => 'permission.store',
                'c_permission_display' => 'Store Permission',
                'c_permission_description' => 'Access to Store Permission',
            ],
            [
                'c_permission_name' => 'permission.edit',
                'c_permission_display' => 'Edit Permission',
                'c_permission_description' => 'Access to Edit Permission',
            ],
            [
                'c_permission_name' => 'permission.update',
                'c_permission_display' => 'Update Permission',
                'c_permission_description' => 'Access to Update Permission',
            ],
            [
                'c_permission_name' => 'permission.delete',
                'c_permission_display' => 'Delete Permission',
                'c_permission_description' => 'Access to Delete Permission',
            ],
            [
                'c_permission_name' => 'permission.destroy',
                'c_permission_display' => 'Destroy Permission',
                'c_permission_description' => 'Access to Destroy Permission',
            ],
            [
                'c_permission_name' => 'master-motor',
                'c_permission_display' => 'Index Master Motor',
                'c_permission_description' => 'Access to Index Master Motor',
            ],
            [
                'c_permission_name' => 'master-motor.datatables',
                'c_permission_display' => 'Datatables Master Motor',
                'c_permission_description' => 'Access to Datatables Master Motor',
            ],
            [
                'c_permission_name' => 'master-motor.add',
                'c_permission_display' => 'Add Master Motor',
                'c_permission_description' => 'Access to Add Master Motor',
            ],
            [
                'c_permission_name' => 'master-motor.store',
                'c_permission_display' => 'Store Master Motor',
                'c_permission_description' => 'Access to Store Master Motor',
            ],
            [
                'c_permission_name' => 'master-motor.edit',
                'c_permission_display' => 'Edit Master Motor',
                'c_permission_description' => 'Access to Edit Master Motor',
            ],
            [
                'c_permission_name' => 'master-motor.update',
                'c_permission_display' => 'Update Master Motor',
                'c_permission_description' => 'Access to Update Master Motor',
            ],
            [
                'c_permission_name' => 'master-motor.detail',
                'c_permission_display' => 'Detail Master Motor',
                'c_permission_description' => 'Access to Detail Master Motor',
            ],
            [
                'c_permission_name' => 'master-motor.delete',
                'c_permission_display' => 'Delete Master Motor',
                'c_permission_description' => 'Access to Delete Master Motor',
            ],
            [
                'c_permission_name' => 'master-motor.destroy',
                'c_permission_display' => 'Destroy Master Motor',
                'c_permission_description' => 'Access to Destroy Master Motor',
            ],
            [
                'c_permission_name' => 'motor-rent',
                'c_permission_display' => 'Index Motor Rent',
                'c_permission_description' => 'Access to Index Motor Rent',
            ],
            [
                'c_permission_name' => 'motor-rent.datatables',
                'c_permission_display' => 'Datatables Motor Rent',
                'c_permission_description' => 'Access to Datatables Motor Rent',
            ],
            [
                'c_permission_name' => 'motor-rent.add',
                'c_permission_display' => 'Add Motor Rent',
                'c_permission_description' => 'Access to Add Motor Rent',
            ],
            [
                'c_permission_name' => 'motor-rent.store',
                'c_permission_display' => 'Store Motor Rent',
                'c_permission_description' => 'Access to Store Motor Rent',
            ],
            [
                'c_permission_name' => 'motor-rent.edit',
                'c_permission_display' => 'Edit Motor Rent',
                'c_permission_description' => 'Access to Edit Motor Rent',
            ],
            [
                'c_permission_name' => 'motor-rent.update',
                'c_permission_display' => 'Update Motor Rent',
                'c_permission_description' => 'Access to Update Motor Rent',
            ],
            [
                'c_permission_name' => 'motor-rent.detail',
                'c_permission_display' => 'Detail Motor Rent',
                'c_permission_description' => 'Access to Detail Motor Rent',
            ],
            [
                'c_permission_name' => 'motor-rent.delete',
                'c_permission_display' => 'Delete Motor Rent',
                'c_permission_description' => 'Access to Delete Motor Rent',
            ],
            [
                'c_permission_name' => 'motor-rent.destroy',
                'c_permission_display' => 'Destroy Motor Rent',
                'c_permission_description' => 'Access to Destroy Motor Rent',
            ],
        ];

        foreach ($permissions as $perm) {
            DB::table('t_rent_permission')->insert([
                'c_permission_name' => $perm['c_permission_name'],
                'c_permission_display' => $perm['c_permission_display'],
                'c_permission_description' => $perm['c_permission_description'],
                'c_permission_update_by' => 1,
                'c_permission_update_time' => date('Y-m-d H:i:s'),
                'c_permission_soft_delete' => 0,
            ]);
        }
    }
}
