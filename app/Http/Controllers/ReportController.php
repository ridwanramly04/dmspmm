<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Managers\ReportService;

class ReportController extends Controller
{
    protected $report;

    public function __construct()
    {
        $this->report = new ReportService;
    }

    public function add(Request $request)
    {
        return $this->report->add($request);
    }

    public function update(Request $request, $id)
    {
        return $this->report->update($request, $id);
    }

    public function show($id)
    {
        return $this->report->show($id);
    }
    public function lists()
    {
        return $this->report->lists();
    }
    public function destroy($id)
    {
        return $this->report->delete($id);
    }
}
