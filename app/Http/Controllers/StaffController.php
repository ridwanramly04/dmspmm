<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Managers\StaffService;
class StaffController extends Controller
{
    protected $staff;

    public function __construct()
    {
        $this->staff = new StaffService;
    }

    public function add(Request $request)
    {
        return $this->staff->add($request);
    }

    public function update(Request $request, $id)
    {
        return $this->staff->update($request, $id);
    }

    public function show($id)
    {
        return $this->staff->show($id);
    }
    public function lists()
    {
        return $this->staff->lists();
    }
    public function destroy($id)
    {
        return $this->staff->destroy($id);
    }

}
