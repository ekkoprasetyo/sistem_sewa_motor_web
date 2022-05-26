<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterMotorRequest;
use App\Model\MasterMotorModel;
use DataTables;
use DB;
use Illuminate\Http\Request;
use App\Helpers\UserAuthorization;

class MasterMotorController extends Controller
{
    private $title;
    private $subtitle;

    public function __construct() {
        $this->title = "Master";
        $this->subtitle = "Motor";
    }

    public function index() {
        $title = $this->title;
        $subtitle = $this->subtitle;

        return view('master_motor.v_index', compact('title','subtitle'));
    }

    public function detail(Request $request){
        $master_motor = MasterMotorModel::find($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Detail Master Motor '.$request->txt_master_motor_brand.' - '.$request->txt_master_motor_series,
            'data' => view('master_motor.v_detail_js', compact('master_motor'))->render()]);
    }

    public function datatables(){
        $master_motor = MasterMotorModel::datatables();

        return DataTables::of($master_motor)
            ->addColumn('action', function($master_motor) {
                return view('master_motor.datatables.v_action', ['master_motor' => $master_motor]);
            })
            ->editColumn('c_master_motor_price', function($master_motor) {
                return 'IDR. '.number_format($master_motor->c_master_motor_price).',-';
            })
            ->editColumn('c_master_motor_update_by', function($master_motor) {
                return $master_motor->c_user_full_name;
            })
            ->editColumn('c_master_motor_status', function($master_motor) {
                switch ($master_motor->c_master_motor_status) {
                    case 1:
                        return '<span class="badge bg-success">Available</span>';
                    case 2:
                        return '<span class="badge bg-warning">Unavailable</span>';
                }
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->make(true);
    }

    public function add(){
        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Add MasterMotor',
            'data' => view('master_motor.v_add_js')->render()]);
    }

    public function store(MasterMotorRequest $request){
        DB::beginTransaction();

        try {
            $master_motor = new MasterMotorModel([
                'c_master_motor_brand' => $request->txt_master_motor_brand,
                'c_master_motor_series' => $request->txt_master_motor_series,
                'c_master_motor_number_plate' => $request->txt_master_motor_number_plate,
                'c_master_motor_price' => $request->txt_master_motor_price,
                'c_master_motor_description' => $request->txt_master_motor_description,
                'c_master_motor_status' => 1,
                'c_master_motor_update_by' => UserAuthorization::getUserID(),
                'c_master_motor_update_time' => date('Y-m-d H:i:s'),
                'c_master_motor_soft_delete' => 0,
            ]);
            $master_motor->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data '.$request->txt_master_motor_brand.' - '.$request->txt_master_motor_series.' has been added ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function edit(Request $request){
        $master_motor = MasterMotorModel::find($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Edit Master Motor '.$master_motor->c_master_motor_brand.' - '.$master_motor->c_master_motor_series,
            'data' => view('master_motor.v_edit_js', compact('master_motor'))->render()]);
    }

    public function update(MasterMotorsRequest $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $master_motor = MasterMotorModel::find($request->txt_master_motor_id);
            $master_motor->c_master_motor_brand = $request->txt_master_motor_brand;
            $master_motor->txt_master_motor_series = $request->txt_master_motor_series;
            $master_motor->txt_master_motor_number_plate = $request->txt_master_motor_number_plate;
            $master_motor->txt_master_motor_price = $request->txt_master_motor_price;
            $master_motor->txt_master_motor_description = $request->txt_master_motor_description;
            $master_motor->c_master_motor_update_by = UserAuthorization::getMasterMotorID();
            $master_motor->c_master_motor_update_time = date('Y-m-d H:i:s');
            $master_motor->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Master Motor '.$request->txt_master_motor_brand.' - '.$request->txt_master_motor_series.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request){
        $master_motor = MasterMotorModel::find($request->id);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Delete Master Motor '.$request->txt_master_motor_brand.' - '.$request->txt_master_motor_series,
            'data' => view('master_motor.v_delete_js', compact('master_motor',))->render()]);
    }

    public function destroy(Request $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $master_motor = MasterMotorModel::find($request->txt_master_motor_id);
            $master_motor->delete();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Master Motor '.$master_motor->c_master_motor_brand.' - '.$master_motor->c_master_motor_series.' has been deleted ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }
}
