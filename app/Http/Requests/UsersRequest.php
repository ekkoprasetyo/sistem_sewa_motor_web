<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
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
        $user_id = $this->get('txt_users_id');
        switch(Route::currentRouteName()) {
            case 'user.store':
                return [
                    'txt_users_full_name' => 'required',
                    'txt_users_email' => 'required|email|unique:t_rent_user,c_user_email',
                    'txt_users_password' => 'required|confirmed|min:6',
                    'txt_users_role' => 'required|numeric',
                    'txt_users_status' => 'required|numeric',
                ];
            case 'user.update':
                return [
                    'txt_users_full_name' => 'required',
                    'txt_users_email' => 'required|email|unique:t_rent_user,c_user_email,'.$this->get('txt_users_id').',c_user_id',
                    'txt_users_role' => 'required|numeric',
                    'txt_users_status' => 'required|numeric',
                ];
            case 'user.update-password':
                return [
                    'txt_users_password' => 'required|confirmed|min:6',
                ];
            default:break;
        }
    }

    public function attributes() {
        return [
            'txt_users_full_name' => 'Full Name',
            'txt_users_email' => 'Email',
            'txt_users_password' => 'Password',
            'txt_users_role' => 'Role',
            'txt_users_status' => 'Status',
        ];
    }
}
