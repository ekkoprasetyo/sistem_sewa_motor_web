<?php

namespace App\Model;

use App\Helpers\UserAuthorization;
use Illuminate\Database\Eloquent\Model;

class MasterMotorModel extends Model
{
    protected $table = "t_rent_master_motor";
    protected $primaryKey = 'c_master_motor_id';
    protected $fillable = [
        'c_master_motor_brand',
        'c_master_motor_series',
        'c_master_motor_number_plate',
        'c_master_motor_price',
        'c_master_motor_description',
        'c_master_motor_status',
        'c_master_motor_update_by',
        'c_master_motor_update_time',
        'c_master_motor_soft_delete',
    ];
    public $timestamps = false;

    public static function datatables(){
        return MasterMotorModel::select(
            't_rent_master_motor.c_master_motor_id',
            't_rent_master_motor.c_master_motor_brand',
            't_rent_master_motor.c_master_motor_series',
            't_rent_master_motor.c_master_motor_number_plate',
            't_rent_master_motor.c_master_motor_price',
            't_rent_master_motor.c_master_motor_description',
            't_rent_master_motor.c_master_motor_status',
            't_rent_user.c_user_full_name',
            't_rent_master_motor.c_master_motor_update_time',
        )
            ->leftJoin('t_rent_user', 't_rent_master_motor.c_master_motor_update_by', '=', 't_rent_user.c_user_id' )
            ->where('c_master_motor_soft_delete', 0)
            ->orderBy('c_master_motor_brand', 'ASC')
            ->orderBy('c_master_motor_series', 'ASC')
            ->get();
    }

    public static function availableMotor($master_motor_id = null) {
        return MasterMotorModel::select('*')
            ->where('c_master_motor_status', 1)
            ->when($master_motor_id, function ($query) use ($master_motor_id) {
                return $query->orWhere('c_master_motor_id', $master_motor_id);
            })
            ->get();
    }
}
