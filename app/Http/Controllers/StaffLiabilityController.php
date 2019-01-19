<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Staffs\LiabilityService;

class StaffLiabilityController extends Controller
{
    protected $liability;

    public function __construct()
    {
        $this->liability = new LiabilityService;

    }

    public function add(Request $request, $id)
    {
        return $this->liability->add($request, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->liability->update($request, $id);
    }
    public function delete($report, $id)
    {
        return $this->liability->delete($report, $id);

    }
    public function lists($id)
    {
        return $this->liability->lists($id);

    }
}
