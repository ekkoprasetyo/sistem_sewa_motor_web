<?php

namespace App\Http\Controllers;

use App\Helpers\DateTimeHelper;
use App\Http\Requests\MotorRentRequest;
use App\Model\MasterMotorModel;
use App\Model\MotorRentModel;
use DataTables;
use DB;
use Illuminate\Http\Request;
use App\Helpers\UserAuthorization;
use Illuminate\Support\Carbon;

class MotorRentController extends Controller
{
    private $title;
    private $subtitle;

    public function __construct() {
        $this->title = "Motor";
        $this->subtitle = "Rent";
    }

    public function index() {
        $title = $this->title;
        $subtitle = $this->subtitle;

        return view('motor_rent.v_index', compact('title','subtitle'));
    }

    public function detail(Request $request){
        $motor_rent = MotorRentModel::find($request->id);
        $motor = MasterMotorModel::find($motor_rent->c_motor_rent_motor);
        $available_motors = MasterMotorModel::availableMotor($motor_rent->c_motor_rent_motor);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Detail Motor Rent '.$motor->c_master_motor_brand.' - '.$motor->c_master_motor_series,
            'data' => view('motor_rent.v_detail_js', compact('motor_rent', 'available_motors'))->render()]);
    }

    public function datatables(){
        $motor_rent = MotorRentModel::datatables();

        return DataTables::of($motor_rent)
            ->addColumn('action', function($motor_rent) {
                return view('motor_rent.datatables.v_action', ['motor_rent' => $motor_rent]);
            })
            ->editColumn('c_motor_rent_motor', function($motor_rent) {
                return $motor_rent->c_master_motor_brand.' - '.$motor_rent->c_master_motor_series.'( '.$motor_rent->c_master_motor_number_plate.' )';
            })
            ->editColumn('c_motor_rent_start_rent_date', function($motor_rent) {
                return DateTimeHelper::DayDateFormat($motor_rent->c_motor_rent_start_rent_date);
            })
            ->editColumn('c_motor_rent_end_rent_date', function($motor_rent) {
                return $motor_rent->c_motor_rent_end_rent_date ? DateTimeHelper::DayDateFormat($motor_rent->c_motor_rent_end_rent_date) : '<span class="badge bg-secondary">Unavailable</span>';
            })
            ->editColumn('c_motor_rent_total_price', function($motor_rent) {
                return $motor_rent->c_motor_rent_total_price ? 'IDR. '.number_format($motor_rent->c_motor_rent_total_price).',-': '<span class="badge bg-secondary">Unavailable</span>';
            })
            ->editColumn('c_motor_rent_duration', function($motor_rent) {
                return $motor_rent->c_motor_rent_duration ? number_format($motor_rent->c_motor_rent_duration).' day(s)': '<span class="badge bg-secondary">Unavailable</span>';
            })
            ->editColumn('c_motor_rent_update_by', function($motor_rent) {
                return $motor_rent->c_user_full_name;
            })
            ->editColumn('c_motor_rent_status', function($motor_rent) {
                switch ($motor_rent->c_motor_rent_status) {
                    case 1:
                        return '<span class="badge bg-warning">Rented</span>';
                    case 2:
                        return '<span class="badge bg-success">Done</span>';
                }
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->make(true);
    }

    public function add(){
        $available_motors = MasterMotorModel::availableMotor();

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Add Motor Rent',
            'data' => view('motor_rent.v_add_js', compact('available_motors'))->render()]);
    }

    public function store(MotorRentRequest $request){
        DB::beginTransaction();

        try {
            $motor_rent = new MotorRentModel([
                'c_motor_rent_renter_name' => $request->txt_motor_rent_renter_name,
                'c_motor_rent_renter_id' => $request->txt_motor_rent_renter_id,
                'c_motor_rent_renter_phone' => $request->txt_motor_rent_renter_phone,
                'c_motor_rent_renter_address' => $request->txt_motor_rent_renter_address,
                'c_motor_rent_motor' => $request->txt_motor_rent_motor,
                'c_motor_rent_start_rent_date' => date('Y-m-d'),
                'c_motor_rent_note' => $request->txt_motor_rent_note,
                'c_motor_rent_status' => 1,
                'c_motor_rent_update_by' => UserAuthorization::getUserID(),
                'c_motor_rent_update_time' => date('Y-m-d H:i:s'),
            ]);
            $motor_rent->save();
            DB::commit();

            $motor = MasterMotorModel::find($request->txt_motor_rent_motor);
            $motor->c_master_motor_status = 2;
            $motor->save();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data '.$motor->c_master_motor_brand.' - '.$motor->c_master_motor_series.' has been rented ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function edit(Request $request){
        $motor_rent = MotorRentModel::find($request->id);
        $motor = MasterMotorModel::find($motor_rent->c_motor_rent_motor);
        $available_motors = MasterMotorModel::availableMotor($motor_rent->c_motor_rent_motor);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Edit Motor Rent '.$motor->c_master_motor_brand.' - '.$motor->c_master_motor_series,
            'data' => view('motor_rent.v_edit_js', compact('motor_rent', 'available_motors'))->render()]);
    }

    public function update(MotorRentRequest $request){
        $motor_rent = MotorRentModel::find($request->txt_motor_rent_id);
        DB::beginTransaction();

        $end_rent_date = null;
        $difference = null;
        $total_price = null;

        try {
            if ($request->txt_motor_rent_status == 2) {
                $end_rent_date = date("Y-m-d", strtotime($request->txt_motor_rent_end_rent_date));

                $start_date = Carbon::parse($motor_rent->c_motor_rent_start_rent_date);
                $end_date = Carbon::parse($request->txt_motor_rent_end_rent_date);
                $difference = $start_date->diffInDays($end_date) + 1;

                $motor = MasterMotorModel::find($motor_rent->c_motor_rent_motor);
                $total_price = $difference * $motor->c_master_motor_price;

                $motor->c_master_motor_status = 1;
                $motor->save();
            }
            //Update to Database
            $motor_rent->c_motor_rent_renter_name = $request->txt_motor_rent_renter_name;
            $motor_rent->c_motor_rent_renter_id = $request->txt_motor_rent_renter_id;
            $motor_rent->c_motor_rent_renter_phone = $request->txt_motor_rent_renter_phone;
            $motor_rent->c_motor_rent_renter_address = $request->txt_motor_rent_renter_address;
            $motor_rent->c_motor_rent_motor = $request->txt_motor_rent_motor;
            $motor_rent->c_motor_rent_end_rent_date = $end_rent_date;
            $motor_rent->c_motor_rent_duration = $difference;
            $motor_rent->c_motor_rent_total_price = $total_price;
            $motor_rent->c_motor_rent_note = $request->txt_motor_rent_note;
            $motor_rent->c_motor_rent_status = $request->txt_motor_rent_status;
            $motor_rent->c_motor_rent_update_by = UserAuthorization::getUserID();
            $motor_rent->c_motor_rent_update_time = date('Y-m-d H:i:s');
            $motor_rent->save();
            DB::commit();

            $motor = MasterMotorModel::find($motor_rent->c_motor_rent_motor);

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Motor Rent '.$motor->txt_motor_rent_brand.' - '.$motor->txt_motor_rent_series.' has been updated ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request){
        $motor_rent = MotorRentModel::find($request->id);
        $motor = MasterMotorModel::find($motor_rent->c_motor_rent_motor);
        $available_motors = MasterMotorModel::availableMotor($motor_rent->c_motor_rent_motor);

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Delete Motor Rent '.$motor->c_master_motor_brand.' - '.$motor->c_master_motor_series,
            'data' => view('motor_rent.v_delete_js', compact('motor_rent', 'available_motors'))->render()]);
    }

    public function destroy(Request $request){
        DB::beginTransaction();

        try {
            //Update to Database
            $motor_rent = MotorRentModel::find($request->txt_motor_rent_id);
            $motor_rent->delete();

            $motor = MasterMotorModel::find($motor_rent->c_motor_rent_motor);
            $motor->c_master_motor_status = 1;
            $motor->save();
            DB::commit();

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data Motor Rent '.$motor->c_master_motor_brand.' - '.$motor->c_master_motor_series.' has been deleted ..']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()]);
        }
    }
}
