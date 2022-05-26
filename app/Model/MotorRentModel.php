<?php

namespace App\Model;

use App\Helpers\UserAuthorization;
use Illuminate\Database\Eloquent\Model;

class MotorRentModel extends Model
{
    protected $table = "t_rent_motor_rent";
    protected $primaryKey = 'c_motor_rent_id';
    protected $fillable = [
        'c_motor_rent_renter_name',
        'c_motor_rent_renter_id',
        'c_motor_rent_renter_phone',
        'c_motor_rent_renter_address',
        'c_motor_rent_motor',
        'c_motor_rent_start_rent_date',
        'c_motor_rent_end_rent_date',
        'c_motor_rent_duration',
        'c_motor_rent_total_price',
        'c_motor_rent_note',
        'c_motor_rent_status',
        'c_motor_rent_update_by',
        'c_motor_rent_update_time',
    ];
    public $timestamps = false;

    public static function datatables(){
        return MotorRentModel::select('*')
            ->leftJoin('t_rent_user', 't_rent_motor_rent.c_motor_rent_update_by', '=', 't_rent_user.c_user_id' )
            ->leftJoin('t_rent_master_motor', 't_rent_motor_rent.c_motor_rent_motor', '=', 't_rent_master_motor.c_master_motor_id' )
            ->orderBy('c_motor_rent_start_rent_date', 'ASC')
            ->get();
    }
}
