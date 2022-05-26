<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class RoleRequest extends FormRequest
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
            case 'role.store':
                return [
                    'txt_role_name' => 'required|min:2|unique:t_rent_role,c_role_name',
                    'txt_role_display' => 'required|min:2',
                    'txt_role_description' => 'required',
                ];
            case 'role.update':
                return [
                    'txt_role_name' => 'required|min:2|unique:t_rent_role,c_role_name,'.$this->get('txt_role_id').',c_role_id',
                    'txt_role_display' => 'required|min:2',
                    'txt_role_description' => 'required',
                ];
            case 'role.update-permission':
                return [
                    'txt_role_permission' => 'required',
                ];
            default:break;
        }
    }

    public function attributes() {
        return [
            'txt_role_name' => 'Name',
            'txt_role_display' => 'Display',
            'txt_role_description' => 'Description',
            'txt_role_permission' => 'Permission',
        ];
    }
}
