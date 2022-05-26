<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class MasterMotorRequest extends FormRequest
{
    /**
     * Determine if the master_motor is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $master_motor_id = $this->get('txt_master_motor_id');
        switch(Route::currentRouteName()) {
            case 'master-motor.store':
                return [
                    'txt_master_motor_brand' => 'required',
                    'txt_master_motor_series' => 'required',
                    'txt_master_motor_number_plate' => 'required|unique:t_rent_master_motor,c_master_motor_number_plate',
                    'txt_master_motor_price' => 'required|numeric',
                    'txt_master_motor_description' => 'required',
                ];
            case 'master-motor.update':
                return [
                    'txt_master_motor_brand' => 'required',
                    'txt_master_motor_series' => 'required',
                    'txt_master_motor_number_plate' => 'required|unique:t_rent_master_motor,c_master_motor_number_plate,'.$this->get('txt_master_motor_id').',c_master_motor_id',
                    'txt_master_motor_price' => 'required|numeric',
                    'txt_master_motor_description' => 'required',
                ];
            default:break;
        }
    }

    public function attributes() {
        return [
            'txt_master_motor_brand' => 'Brand',
            'txt_master_motor_series' => 'Series',
            'txt_master_motor_number_plate' => 'Number Plate',
            'txt_master_motor_price' => 'Price',
            'txt_master_motor_description' => 'Description',
        ];
    }
}
