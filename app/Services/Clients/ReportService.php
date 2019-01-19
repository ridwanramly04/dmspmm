<?php

namespace  App\Services\Clients;
use Auth;

class ReportService 
{
    public function reports()
    {
        $reports = Auth::user()->client()->report;

        return response()->json([
            'status' => 200,
            'reports'=> $reports
        ]);
    }
}