<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Model\PermissionModel;
use App\Model\RoleModel;
use App\Model\RolePermissionModel;
use DataTables;
use DB;
use Illuminate\Http\Request;
use App\Helpers\UserAuthorization;

class RoleController extends Controller
{
    private $title;
    private $subtitle;

    public function __construct() {
        $this->title = "Users Management";
        $this->subtitle = "Role";
    }

    public function index(){
        $title = $this->title;
        $subtitle = $this->subtitle;

        return view('role.v_index', compact('title','subtitle'));
    }

    public function datatables(){
        $role = RoleModel::datatables();

        return DataTables::of($role)
            ->addColumn('action', function($role) {
                return view('role.datatables.v_action', ['role' => $role]);
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->make(true);
    }

    public function detail(Request $request){
        $role = RoleModel::find($request->id);
        $permissions = PermissionModel::dropdown();
        $exs_permission = RolePermissionModel::getPermission($request->id);
        $array_permission = [];

        foreach ($exs_permission as $item) {
            $array_permission[] = $item->c_permission_id;
        }

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Detail Role '.$role->c_role_name,
            'data' => view('role.v_detail_js', compact('role','permissions','array_permission'))->render()]);
    }

    public function add(){
        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Add Role',
            'data' => view('role.v_add_js')->render()]);
    }

    public function store(RoleRequest $request){
        DB::beginTransaction();

        try {
            $role = new RoleModel([
                'c_role_name' => $request->txt_role_name,
                'c_role_display' => $request->txt_role_display,
                'c_role_description' => $request->txt_role_description,
                'c_role_update_by' => UserAuthorization::getUserID(),
                'c_role_update_time' => date('Y-m-d H:i:s'),
                'c_role_soft_delete' => 0,
            ]);
            $role->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data '.$request->c_role_display.' has been added ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function edit(Request $request){
        $role = RoleModel::find($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Edit Role '.$role->c_role_display,
            'data' => view('role.v_edit_js', compact('role'))->render()]);
    }

    public function update(RoleRequest $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $role = RoleModel::find($request->txt_role_id);
            $role->c_role_name = $request->txt_role_name;
            $role->c_role_display = $request->txt_role_display;
            $role->c_role_description = $request->txt_role_description;
            $role->c_role_update_by = UserAuthorization::getUserID();
            $role->c_role_update_time = date('Y-m-d H:i:s');
            $role->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Role '.$request->c_role_display.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function edit_permission(Request $request){
        $role = RoleModel::find($request->id);
        $permissions = PermissionModel::dropdown();
        $exs_permission = RolePermissionModel::getPermission($request->id);
        $array_permission = [];

        foreach ($exs_permission as $item) {
            $array_permission[] = $item->c_permission_id;
        }

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Edit Role Permission '.$role->c_role_display,
            'data' => view('role.v_edit_permission_js', compact('role','permissions','array_permission'))->render()]);
    }

    public function update_permission(RoleRequest $request){
        DB::beginTransaction();
        try {
            //Update to Database
            $role_data = RolePermissionModel::getPermission($request->txt_role_id);
            if (count($role_data) > 0) {
                // update data
                $role = RoleModel::findOrFail($request->txt_role_id);

                // delete data permission per role
                RolePermissionModel::where('c_role_id',$request->txt_role_id)->delete();

                // insert data permission per role
                foreach ($request->txt_role_permission as $permission) {
                    $role_permission = new RolePermissionModel([
                        'c_role_id' => $request->txt_role_id,
                        'c_permission_id' => $permission,
                    ]);
                    $role_permission->save();
                }
            } else {
                $role = RoleModel::findOrFail($request->txt_role_id);

                // insert data permission per role
                foreach ($request->txt_role_permission as $permission) {
                    $role_permission = new RolePermissionModel([
                        'c_role_id' => $request->txt_role_id,
                        'c_permission_id' => $permission,
                    ]);
                    $role_permission->save();

                }
            }
            $role->c_role_update_by = UserAuthorization::getUserID();
            $role->c_role_update_time = date('Y-m-d H:i:s');
            $role->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Role '.$role->c_role_display.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request){
        $role = RoleModel::find($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Delete Role '.$role->c_role_display,
            'data' => view('role.v_delete_js', compact('role'))->render()]);
    }

    public function destroy(Request $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $role = RoleModel::find($request->txt_role_id);
            $role->c_role_soft_delete = 1;
            $role->c_role_update_by = UserAuthorization::getUserID();
            $role->c_role_update_time = date('Y-m-d H:i:s');
            $role->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Role '.$role->c_role_display.' has been deleted ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }
}
