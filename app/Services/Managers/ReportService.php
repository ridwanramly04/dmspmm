<?php
namespace App\Services\Managers;
use Auth;
use App\Models\Report;

class ReportService 
{
    public function add($data) 
    {
        $user = Report::create([
            'user_id' => Auth::user()->id,
            'title' => $data->name,
            'assign_id' => $data->staff,
            'dateline' => $data->dateline,
            'client_id' => $data->client_id
        ]);
        
        $reports = \App\Models\Report::all();

        return response()->json([
            'status' => 200,
            'message' => 'Report added',
            'reports' => $reports
        ]);
    }

    public function update($data, $id)
    {
        $report = Report::find($id)->update([
            'name' => $data->name,
            'assign_id' => $data->staff,
            'dateline' => $data->dateline
        ]);
        
        $reports = \App\Models\Report::all();

        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Updated !' ,
            'reports' => $reports
        ]);
    }

    public function show($id)
    {
        $report = Report::find($id);

        return response()->json([
            'status' => 200,
            'report' => $report
        ]);
    }

    public function lists()
    {
        $reports = Report::all();

        return response()->json([
            'status' => 200,
            'reports' => $reports
        ]);
    }
    
    public function delete($id)
    {
        $reports = \App\Models\Report::all();

        $report = Report::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Deleted !' ,
            'reports' => $reports
        ]);
    }
}