<?php

namespace App\Model;

use App\Helpers\UserAuthorization;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = "t_rent_user";
    protected $primaryKey = 'c_user_id';
    protected $hidden = ['c_user_password'];
    protected $fillable = [
        'c_user_nip',
        'c_user_full_name',
        'c_user_email',
        'c_user_password',
        'c_user_position',
        'c_user_role',
        'c_user_status',
        'c_user_update_by',
        'c_user_update_time',
        'c_user_soft_delete',
        'c_user_force_change_password',
    ];
    public $timestamps = false;

    public static function loginCred($email){
        return UsersModel::where('c_user_email', $email)
            ->leftJoin('t_rent_role', 't_rent_user.c_user_role', '=', 't_rent_role.c_role_id' )
            ->first();
    }


    public static function datatables(){
        return UsersModel::select(
            't_rent_user.c_user_id',
            't_rent_user.c_user_full_name',
            't_rent_user.c_user_email',
            't_rent_user.c_user_status',
            't_rent_role.c_role_display',
        )
            ->leftJoin('t_rent_role', 't_rent_user.c_user_role', '=', 't_rent_role.c_role_id' )
            ->where('c_user_soft_delete', 0)
            ->orderBy('c_user_full_name', 'ASC')
            ->get();
    }

    public static function getRoleID(){
        $user = UsersModel::find(UserAuthorization::getUserID());

        return $user->c_user_role;
    }

    public static function detailUser($id){
        return UsersModel::where('c_user_id', $id)
            ->leftJoin('t_rent_role', 't_rent_user.c_user_role', '=', 't_rent_role.c_role_id' )
            ->first();
    }

}
