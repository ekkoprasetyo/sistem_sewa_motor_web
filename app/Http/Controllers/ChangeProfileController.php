<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeProfileRequest;
use App\Http\Requests\UsersRequest;
use App\Model\PositionModel;
use App\Model\RoleModel;
use App\Model\UsersModel;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UserAuthorization;

class ChangeProfileController extends Controller
{

    public function index(Request $request){
        $user = UsersModel::detailUser($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Edit Profile User '.$user->c_user_fullname,
            'data' => view('change_profile.v_change_profile_js', compact('user'))->render()]);
    }

    public function update_profile(ChangeProfileRequest $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $users = UsersModel::find($request->txt_change_profile_id);
            $users->c_user_email = strtolower($request->txt_change_profile_email);
            $users->c_user_update_by = UserAuthorization::getUserID();
            $users->c_user_update_time = date('Y-m-d H:i:s');
            $users->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Change Profile User '.$users->c_user_fullname.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function password(Request $request){
        $user = UsersModel::detailUser($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Edit Profile Password User '.$user->c_user_fullname,
            'data' => view('change_profile.v_change_profile_password_js', compact('user'))->render()]);
    }

    public function update_password(ChangeProfileRequest $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $users = UsersModel::find($request->txt_change_profile_id);
            if (!Hash::check($request->txt_change_profile_old_password,$users->c_user_password)) {
                return response()->json(['status' => 'error',
                    'title' => 'Error',
                    'message' => 'Old Password doesnt match on system ..']);
            }
            $users->c_user_password = Hash::make($request->txt_change_profile_password);
            $users->c_user_update_by = UserAuthorization::getUserID();
            $users->c_user_update_time = date('Y-m-d H:i:s');
            $users->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Profile User Password '.$users->c_user_fullname.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }
}
