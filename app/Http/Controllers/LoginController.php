<?php

namespace App\Http\Controllers;

use App\Helpers\UserAuthorization;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RecoverPasswordRequest;
use App\Model\PermissionModel;
use App\Model\RolePermissionModel;
use App\Model\UsersModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class LoginController extends Controller
{
    public function index() {
        if(Session::has('user_login'))
        {
            \Session::flash('success_notification', 'Welcome back ..');
            return redirect('home');
        }
        return view('login.v_index');
    }

    public function validate_login(LoginRequest $request){
        try {
            $email = $request->email;
            $decryptedPassword = $this->cryptoJsAesDecrypt('d45h804rd4rt5', $request->password);

            $userdata = UsersModel::loginCred($email);
            if($userdata) {
                if(Hash::check($decryptedPassword,$userdata->c_user_password)) {
                    if ($userdata->c_user_status == 0)
                    {
                        return response()->json(['status' => 'Error',
                            'code' => '02',
                            'message' => 'User Inactive',
                            'captcha' => captcha_img('inverse')
                        ]);
                    }
                    else {
                        DB::beginTransaction();
                        $userdata->c_user_last_login_date = date("Y-m-d H:i:s");
                        $userdata->c_user_last_login_ip = \Request::ip();
                        $userdata->save();
                        DB::commit();

                        $createDateEndTime = new \DateTime($userdata->c_user_last_login_date);
                        $date_last_login = $createDateEndTime->format('d F Y H:i:s');
                        $day = date('l', strtotime($userdata->c_user_last_login_date));
                        Session::put('user_id',$userdata->c_user_id);
                        Session::put('user_full_name',$userdata->c_user_full_name);
                        Session::put('user_email',$userdata->c_user_email);
                        Session::put('user_status',$userdata->c_user_status == 1 ? 'Active' : 'Inactive');
                        Session::put('user_role_id',$userdata->c_role_id);
                        Session::put('user_role',$userdata->c_role_display);
                        Session::put('user_role_update_time',$userdata->c_role_update_time);
                        Session::put('user_last_login_ip',$userdata->c_user_last_login_ip);
                        Session::put('user_last_login_date',$day.', '.$date_last_login);
                        Session::put('user_force_change_password',$userdata->c_user_force_change_password);
                        Session::put('user_login',TRUE);

                        $user_permission = RolePermissionModel::getArrayPermission($userdata->c_role_id);
                        $all_permissions = PermissionModel::getAllPermission()
                            ->whereIn('c_permission_id',$user_permission);

                        foreach ($all_permissions as $permission) {
                            Session::put($permission->c_permission_name ,TRUE);
                        }

                        $request->session()->regenerate();

                        return response()->json(['status' => 'Success',
                            'code' => '00',
                            'message' => 'Authentication Success',
                            'redirect' => route('home')
                        ]);
                    }
                }
                else {
                    return response()->json(['status' => 'Error',
                        'code' => '01',
                        'message' => 'Authentication Not Valid',
                        'captcha' => captcha_img('inverse')
                    ]);
                }
            }
            else {
                return response()->json(['status' => 'Error',
                    'code' => '01',
                    'message' => 'Authentication Not Valid',
                    'captcha' => captcha_img('inverse')
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json(['status' => 'Error',
                'code' => '99',
                'message' => 'Exception Occurred '.$exception->getMessage(),
                'captcha' => captcha_img('inverse')
            ], 500);
        }
    }

    private function cryptoJsAesDecrypt($passphrase, $jsonString){
        $jsondata = json_decode($jsonString, true);
        $salt = hex2bin($jsondata["s"]);
        $ct = base64_decode($jsondata["ct"]);
        $iv  = hex2bin($jsondata["iv"]);
        $concatedPassphrase = $passphrase.$salt;
        $md5 = array();
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++) {
            $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        return json_decode($data, true);
    }

    public function destroy() {
        \Session::flush();
        return redirect()->route('login');
    }

    public function recover_password() {
        $force_change_password = Session::get('user_force_change_password');
        if ($force_change_password == 0) {
            return view('home');
        } else {
            return view('layouts.v_recover_password');
        }
    }

    public function recover_password_validate(RecoverPasswordRequest $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $user = UsersModel::find(UserAuthorization::getUserID());
            $user->c_user_password = Hash::make($request->txt_recover_password);
            $user->c_user_force_change_password = 0;
            $user->c_user_update_by = UserAuthorization::getUserID();
            $user->c_user_update_time = date('Y-m-d H:i:s');
            $user->save();
            DB::commit();

            Session::put('user_force_change_password',$user->c_user_force_change_password);

            return response()->json(['status' => 'success',
                'title' => 'New Password Saved',
                'redirect' => route('home'),
                'message' => 'Redirect ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }
}



