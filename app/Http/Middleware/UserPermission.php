<?php

namespace App\Http\Middleware;

use App\Model\PermissionModel;
use App\Model\RoleModel;
use App\Model\RolePermissionModel;
use App\Model\UsersModel;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Helpers\UserAuthorization;

class UserPermission
{
    public function handle($request, Closure $next)
    {
        $role_update_time = Session::get('user_role_update_time');
        $user_role = UsersModel::getRoleID();
        if ($user_role != UserAuthorization::getRoleID()) {
            Session::put('user_role_id', $user_role);
        }
        $role_user = RoleModel::find(UserAuthorization::getRoleID());
        Session::put('user_role',$role_user->c_role_display);
        if ($role_user->c_role_update_time != $role_update_time) {
            $user_permission = RolePermissionModel::getArrayPermission(UserAuthorization::getRoleID());
            $all_permissions = PermissionModel::getAllPermission();
            $all_user_permissions = PermissionModel::getAllPermission()
                ->whereIn('c_permission_id',$user_permission);

            //delete all user session
            foreach ($all_permissions as $permission) {
                Session::forget($permission->c_permission_name);
            }

            //add new session
            Session::put('user_role_update_time',$role_user->c_role_update_time);
            foreach ($all_user_permissions as $permission) {
                Session::put($permission->c_permission_name ,TRUE);
            }
        }

        if(!UserAuthorization::isAllowed(Route::currentRouteName()) && $request->ajax()){
            return response()->json(['status' => 'auth',
                'title' => 'Authorization Error',
                'message' => 'You are not authorized to perform this ..']);
        }
        if (!UserAuthorization::isAllowed(Route::currentRouteName())) {
            \Session::flash('auth_error_notification', 'You are not authorized to perform this ..');
            return redirect()->route('dashboard-main');
        }
        return $next($request);
    }
}
