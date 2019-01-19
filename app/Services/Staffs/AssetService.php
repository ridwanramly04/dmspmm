<?php

namespace App\Services\Staffs;

class AssetService 
{
    public function add($data, $id)
    {
        $report = \App\Models\Report::find($id);

        $create =  $report->asset()->create([
            'name' => $data->name,
            'price' => $data->price
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Asset Successfully Saved !' ,
            'assets' => $report->asset 
        ]);
    }

    public function update($data, $id)
    {
        $asset = \App\Models\Asset::find($id)->update([
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
        $assets = \App\Models\Asset::where('report_id', $id)->get();
        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Deleted !' ,
            'assets' => $assets
        ]);
    }
    public function delete($report_id, $id)
    {
        $assets = \App\Models\Asset::where('report_id', $report_id)->get();

        $asset =  \App\Models\Asset::find($id)->delete();

        
        return response()->json([
            'status' => 200,
            'message' => 'Report Successfully Deleted !' ,
            'assets' => $assets
        ]);
        

    }
}