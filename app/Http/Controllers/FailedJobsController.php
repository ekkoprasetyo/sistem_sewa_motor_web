<?php

namespace App\Http\Controllers;

use App\Model\FailedJobsModel;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Artisan;

class FailedJobsController extends Controller
{
    private $title;
    private $subtitle;

    public function __construct() {
        $this->title = "Admin";
        $this->subtitle = "Failed Jobs";
    }

    public function index(){
        $title = $this->title;
        $subtitle = $this->subtitle;

        return view('failed_jobs.v_index', compact('title','subtitle'));
    }

    public function datatables(){
        $failed_jobs = FailedJobsModel::datatables();

        return DataTables::of($failed_jobs)
            ->addColumn('action', function($failed_jobs) {
                return view('failed_jobs.datatables.v_action', ['failed_jobs' => $failed_jobs]);
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->make(true);
    }

    public function detail(Request $request){
        $failed_jobs = FailedJobsModel::where('uuid', $request->id)->first();

        return response()->json(['status' => 'success',
            'title' => 'Fetch Data Success',
            'message' => 'Detail Failed Jobs '.$failed_jobs->uuid,
            'data' => view('failed_jobs.v_detail_js', compact('failed_jobs'))->render()]);
    }

    public function retry(Request $request){
        $uuid = $request->txt_failed_jobs_uuid;
        $id_jobs = FailedJobsModel::select('*')->where('uuid',$uuid)->first();
        if ($id_jobs) {
            Artisan::call('queue:retry '.$id_jobs->uuid);
            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'Data '.$id_jobs->uuid.' added to job ..']);
        }
        else {
            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to add data to job ..']);
        }
    }

    public function retry_all(){
        $id_jobs = FailedJobsModel::select('uuid')->orderBy('failed_at', 'DESC')->get();

        if ($id_jobs) {
            foreach($id_jobs as $id) {
                Artisan::call('queue:retry '.$id->uuid);
            }

            return response()->json(['status' => 'success',
                'title' => 'Success',
                'message' => 'All Data added to job ..']);
        }
        else {
            return response()->json(['status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to add all data to job ..']);
        }
    }
}
