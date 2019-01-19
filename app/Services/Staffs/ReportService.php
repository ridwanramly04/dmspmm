<?php

namespace App\Services\Staffs;
use Auth;
use App\Models\Report;
use DB;

class ReportService
{
    // public function dashboard()
    // {

    // }
    public function reports()
    {
        // $reports = Report::where('assign_id', Auth::user()->id)->get();
        $reports = DB::table('reports')->where('reports.assign_id', Auth::user()->id)
                   ->join('clients', 'reports.client_id', '=' , 'clients.id')
                   ->select('reports.*', 'clients.company_name')
                   ->get();
        return response()->json([
            'status' => 200,
            'reports' => $reports
        ]);
    }

    public function updateMessage($data, $id)
    {
        $reports = Report::find($id)->update([
            'message' => $data->message
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Updated !' ,
        ]);
    }

    public function updateStatus($data, $id)
    {
        $reports = Report::find($id)->update([
            'status' => $data->status
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Updated !' ,
        ]);
    }

    public function report($id)
    {
        $report =  Report::find($id);

        return response()->json([
            'status' => 200,
            'report' => $report,
            'asset' => $report->asset,
            'liability' => $report->liability,
            'document' => $report->document
        ]);
    }
}