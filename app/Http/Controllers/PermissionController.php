<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Model\PermissionModel;
use DataTables;
use DB;
use Illuminate\Http\Request;
use App\Helpers\UserAuthorization;

class PermissionController extends Controller
{
    private $title;
    private $subtitle;

    public function __construct() {
        $this->title = "Users Management";
        $this->subtitle = "Permission";
    }

    public function index(){
        $title = $this->title;
        $subtitle = $this->subtitle;

        return view('permission.v_index', compact('title','subtitle'));
    }

    public function datatables(){
        $permission = PermissionModel::datatables();

        return DataTables::of($permission)
            ->addColumn('action', function($permission) {
                return view('permission.datatables.v_action', ['permission' => $permission]);
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->make(true);
    }

    public function add(){
        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Add Permission',
            'data' => view('permission.v_add_js')->render()]);
    }

    public function store(PermissionRequest $request){
        DB::beginTransaction();

        try {
            $permission = new PermissionModel([
                'c_permission_name' => $request->txt_permission_name,
                'c_permission_display' => $request->txt_permission_display,
                'c_permission_description' => $request->txt_permission_description,
                'c_permission_update_by' => UserAuthorization::getUserID(),
                'c_permission_update_time' => date('Y-m-d H:i:s'),
                'c_permission_soft_delete' => 0,
            ]);
            $permission->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data '.$request->txt_permission_name.' has been added ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function edit(Request $request){
        $permission = PermissionModel::find($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Edit Permission '.$permission->c_permission_name,
            'data' => view('permission.v_edit_js', compact('permission'))->render()]);
    }

    public function update(PermissionRequest $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $permission = PermissionModel::find($request->txt_permission_id);
            $permission->c_permission_name = $request->txt_permission_name;
            $permission->c_permission_display = $request->txt_permission_display;
            $permission->c_permission_description = $request->txt_permission_description;
            $permission->c_permission_update_by = UserAuthorization::getUserID();
            $permission->c_permission_update_time = date('Y-m-d H:i:s');
            $permission->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Permission '.$request->txt_permission_name.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request){
        $permission = PermissionModel::find($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Delete Permission '.$permission->c_permission_name,
            'data' => view('permission.v_delete_js', compact('permission'))->render()]);
    }

    public function destroy(Request $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $permission = PermissionModel::find($request->txt_permission_id);
            $permission->c_permission_soft_delete = 1;
            $permission->c_permission_update_by = UserAuthorization::getUserID();
            $permission->c_permission_update_time = date('Y-m-d H:i:s');
            $permission->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Permission '.$permission->c_permission_name.' has been deleted ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }
}
