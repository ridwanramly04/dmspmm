<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Staffs\AssetService;

class StaffAssetController extends Controller
{
    protected $asset;

    public function __construct()
    {
        $this->asset = new AssetService;

    }

    public function add(Request $request, $id)
    {
        return $this->asset->add($request, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->asset->update($request, $id);
    }
    public function delete($report, $id)
    {
        return $this->asset->delete($report, $id);

    }
    public function lists($id)
    {
        return $this->asset->lists($id);

    }
}
