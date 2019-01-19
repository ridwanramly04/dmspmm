<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Staffs\ReportService;

class StaffReportController extends Controller
{
    protected $report;

    public function __construct()
    {
        $this->report = new ReportService;
    }

    public function reports()
    {
        return $this->report->reports();
    }
    public function updateMessage(Request $request, $id)
    {
        return $this->report->updateMessage($request, $id);
    }
    public function updateStatus(Request $request, $id)
    {
        return $this->report->updateStatus($request, $id);
    }
    public function show($id){
        return $this->report->report($id);
    }
}
