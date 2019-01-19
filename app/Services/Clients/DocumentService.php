<?php

namespace App\Services\Clients;

class DocumentService 
{
    public function upload($data, $report_id)
    {
        $report = \App\Models\Report::find($report_id);

        foreach ($data->documents as $document) {
            # code...
            $name = md5(rand(92811, 287827191)).'.'.$document->getclientoriginalextension();

            $store = $document->storeAs('public/reports/'.$report_id.'/document', $name);

            $update =  $report->document()->create([
                'name' => '/reports/'.$report_id.'/document/'.$name
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Uploaded',
            'document' => $report->document
        ]);
    }

    public function delete($id)
    {
        $document = \App\Models\Document::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Document deleted',
        ]);
    }
}