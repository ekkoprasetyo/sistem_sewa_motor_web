<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class MotorRentRequest extends FormRequest
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
        switch(Route::currentRouteName()) {
            case 'motor-rent.store':
                return [
                    'txt_motor_rent_renter_name' => 'required',
                    'txt_motor_rent_renter_id' => 'required',
                    'txt_motor_rent_renter_phone' => 'required',
                    'txt_motor_rent_renter_address' => 'required',
                    'txt_motor_rent_motor' => 'required|numeric',
                    'txt_motor_rent_note' => 'required',
                ];
            case 'motor-rent.update':
                return [
                    'txt_motor_rent_renter_name' => 'required',
                    'txt_motor_rent_renter_id' => 'required',
                    'txt_motor_rent_renter_phone' => 'required',
                    'txt_motor_rent_renter_address' => 'required',
                    'txt_motor_rent_motor' => 'required',
                    'txt_motor_rent_end_rent_date' => 'required',
                    'txt_motor_rent_note' => 'required',
                    'txt_motor_rent_status' => 'required',
                ];
            default:break;
        }
    }

    public function attributes() {
        return [
            'txt_motor_rent_renter_name' => 'Renter Name',
            'txt_motor_rent_renter_id' => 'Renter ID',
            'txt_motor_rent_renter_phone' => 'Renter Phone',
            'txt_motor_rent_renter_address' => 'Renter Address',
            'txt_motor_rent_motor' => 'Motorcycle',
            'txt_motor_rent_start_rent_date' => 'Start Rent Date',
            'txt_motor_rent_end_rent_date' => 'End Rent Date',
            'txt_motor_rent_note' => 'Note',
            'txt_motor_rent_status' => 'Status',
        ];
    }
}
