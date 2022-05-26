<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = "t_rent_role";
    protected $primaryKey = 'c_role_id';
    protected $fillable = [
        'c_role_name',
        'c_role_display',
        'c_role_description',
        'c_role_update_by',
        'c_role_update_time',
        'c_role_soft_delete',
    ];
    public $timestamps = false;

    public static function datatables(){
        return RoleModel::where('c_role_soft_delete', 0)
            ->orderby('c_role_name', 'ASC')
            ->get();
    }

    public static function dropdown(){
        return RoleModel::select('c_role_id',
            'c_role_name',
            'c_role_display')
            ->orderby('c_role_name', 'ASC')
            ->get();
    }

}
