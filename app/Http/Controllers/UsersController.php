<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Model\PositionModel;
use App\Model\RoleModel;
use App\Model\UnitModel;
use App\Model\UsersModel;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UserAuthorization;

class UsersController extends Controller
{
    private $title;
    private $subtitle;

    public function __construct() {
        $this->title = "Users Management";
        $this->subtitle = "Users";
    }

    public function index() {
        $title = $this->title;
        $subtitle = $this->subtitle;

        return view('user.v_index', compact('title','subtitle'));
    }

    public function detail(Request $request){
        $user = UsersModel::detailUser($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Detail User '.$user->c_user_full_name,
            'data' => view('user.v_detail_js', compact('user'))->render()]);
    }

    public function datatables(Request $request){
        $users = UsersModel::datatables();

        return DataTables::of($users)
            ->addColumn('action', function($users) {
                return view('user.datatables.v_action', ['users' => $users]);
            })
            ->editColumn('c_user_full_name', function($users) {
                return $users->c_user_full_name;
            })
            ->editColumn('c_user_status', function($users) {
                return $users->c_user_status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->make(true);
    }

    public function add(){
        $roles = RoleModel::dropdown();

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Add User',
            'data' => view('user.v_add_js', compact('roles',))->render()]);
    }

    public function store(UsersRequest $request){
        DB::beginTransaction();

        try {
            $user = new UsersModel([
                'c_user_full_name' => $request->txt_users_full_name,
                'c_user_email' => strtolower($request->txt_users_email),
                'c_user_password' => Hash::make($request->txt_users_password),
                'c_user_role' => $request->txt_users_role,
                'c_user_status' => $request->txt_users_status,
                'c_user_update_by' => UserAuthorization::getUserID(),
                'c_user_update_time' => date('Y-m-d H:i:s'),
                'c_user_soft_delete' => 0,
                'c_user_force_change_password' => 1,
            ]);
            $user->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data '.$request->txt_users_full_name.' has been added ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function edit(Request $request){
        $user = UsersModel::find($request->id);
        $roles = RoleModel::dropdown();

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Edit User '.$user->c_user_full_name,
            'data' => view('user.v_edit_js', compact('user','roles'))->render()]);
    }

    public function update(UsersRequest $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $users = UsersModel::find($request->txt_users_id);
            $users->c_user_full_name = $request->txt_users_full_name;
            $users->c_user_email = strtolower($request->txt_users_email);
            $users->c_user_role = $request->txt_users_role;
            if ($request->txt_users_status == 0) {
                $users->c_user_position = 0;
            }
            $users->c_user_status = $request->txt_users_status;
            $users->c_user_update_by = UserAuthorization::getUserID();
            $users->c_user_update_time = date('Y-m-d H:i:s');
            $users->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data User '.$request->txt_users_full_name.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function edit_password(Request $request){
        $user = UsersModel::find($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Change User Password '.$user->c_user_full_name,
            'data' => view('user.v_edit_password_js', compact('user'))->render()]);
    }

    public function update_password(UsersRequest $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $users = UsersModel::find($request->txt_users_id);
            $users->c_user_password = Hash::make($request->txt_users_password);
            $users->c_user_update_by = UserAuthorization::getUserID();
            $users->c_user_update_time = date('Y-m-d H:i:s');
            $users->c_user_force_change_password = 1;
            $users->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data User Password '.$users->c_user_full_name.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request){
        $user = UsersModel::detailUser($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Delete User '.$user->c_user_full_name,
            'data' => view('user.v_delete_js', compact('user',))->render()]);
    }

    public function destroy(Request $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $users = UsersModel::find($request->txt_users_id);
            $users->c_user_status = 0;
            $users->c_user_soft_delete = 1;
            $users->c_user_update_by = UserAuthorization::getUserID();
            $users->c_user_update_time = date('Y-m-d H:i:s');
            $users->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data User '.$users->c_user_full_name.' has been deleted ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }
}
