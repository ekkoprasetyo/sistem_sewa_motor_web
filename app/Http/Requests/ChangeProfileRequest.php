<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class ChangeProfileRequest extends FormRequest
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
        $id = $this->get('txt_change_profile_id');

        switch(Route::currentRouteName()) {
            case 'change-profile.update-profile':
                return [
                    'txt_change_profile_email' => ['required','email',
                        Rule::unique('t_rent_user','c_user_email')->where(function ($query) use($id) {
                            return $query->where('c_user_id','!=', $id);
                        }),
                    ],
                ];
            case 'change-profile.update-password':
                return [
                    'txt_change_profile_old_password' => 'required',
                    'txt_change_profile_password' => 'required|confirmed|min:6',
                ];
            default:break;
        }
    }

    public function attributes() {
        return [
            'txt_change_profile_email' => 'Email',
            'txt_change_profile_old_password' => 'Password',
            'txt_change_profile_password' => 'Password',
        ];
    }
}
