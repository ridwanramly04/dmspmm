<?php

namespace App\Services\Staffs;

class LiabilityService
{
    public function add($data, $id)
    {
        $report = \App\Models\Report::find($id);

        $create =  $report->liability()->create([
            'name' => $data->name,
            'price' => $data->price
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Liability Successfully Saved !' ,
            'liability' => $report->liabilty 
        ]);
    }

    public function update($data, $id)
    {
        $liabilty = \App\Models\liabilty::find($id)->update([
            'name' => $data->name,
            'price' => $data->price
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Updated !' ,
        ]);
    }
    public function lists($id)
    {
        $liabiltys = \App\Models\Liabilty::where('report_id', $report_id)->get();
        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Deleted !' ,
            'liabilty' => $liabilties
        ]);
    }
    public function delete($report_id, $id)
    {
        $liabiltys = \App\Models\Liabilty::where('report_id', $report_id)->get();
        $liabilty =  \App\Models\Liabilty::find($id)->delete();

        
        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Deleted !' ,
            'liabilty' => $liabilties
        ]);
        

    }
}