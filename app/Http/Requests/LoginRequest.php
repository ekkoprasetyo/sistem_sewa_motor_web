<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class LoginRequest extends FormRequest
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
            case 'login.validate':
                return [
                    'email' => 'required',
                    'password' => 'required',
                    'captcha' => 'required|captcha',
                ];
            default:break;
        }
    }

    public function messages()
    {
        return [
            'captcha' => 'Incorrect Captcha',
        ];
    }

    public function attributes() {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'captcha' => 'Captcha',
        ];
    }
}
