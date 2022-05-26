<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FailedJobsModel extends Model
{
    protected $table = "failed_jobs";
    protected $primaryKey = 'id';
    protected $fillable = [

    ];
    public $timestamps = false;

    public static function datatables(){
        return FailedJobsModel::orderby('failed_at', 'DESC')
            ->get();
    }
}
