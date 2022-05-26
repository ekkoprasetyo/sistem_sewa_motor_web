<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    protected $table = "t_rent_permission";
    protected $primaryKey = 'c_permission_id';
    protected $fillable = [
        'c_permission_name',
        'c_permission_display',
        'c_permission_description',
        'c_permission_update_by',
        'c_permission_update_time',
        'c_permission_soft_delete',
    ];
    public $timestamps = false;

    public static function datatables(){
        return PermissionModel::where('c_permission_soft_delete', 0)
            ->orderby('c_permission_name', 'ASC')
            ->get();
    }

    public static function dropdown(){
        return PermissionModel::select('c_permission_id',
            'c_permission_name',
            'c_permission_display')
            ->orderby('c_permission_name', 'ASC')
            ->get();
    }

    public static function getID($permission_name){
        return PermissionModel::select('c_permission_id')
            ->where('c_permission_name', $permission_name)
            ->first();
    }

    public static function getAllPermission(){
        return PermissionModel::select('c_permission_id','c_permission_name','c_permission_description')
            ->get();
    }

}
