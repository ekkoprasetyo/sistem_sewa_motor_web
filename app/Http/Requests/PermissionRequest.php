<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            case 'permission.store':
                return [
                    'txt_permission_name' => 'required|min:2|unique:t_rent_permission,c_permission_name',
                    'txt_permission_display' => 'required|min:2',
                    'txt_permission_description' => 'required',
                ];
            case 'permission.update':
                return [
                    'txt_permission_name' => 'required|min:2|unique:t_rent_permission,c_permission_name,'.$this->get('txt_permission_id').',c_permission_id',
                    'txt_permission_display' => 'required|min:2',
                    'txt_permission_description' => 'required',
                ];
            default:break;
        }
    }

    public function attributes() {
        return [
            'txt_permission_name' => 'Name',
            'txt_permission_display' => 'Display',
            'txt_permission_description' => 'Description',
        ];
    }
}
