<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Services\Clients\DocumentService;
class DashboardController extends Controller
{
    protected $document;

    public function __construct()
    {
        $this->document = new DocumentService;
    }
    public function manager()
    {
        if (Auth::user()->role->level == 'manager') {
            # code...
            $roles = \App\Models\Role::all();
            $reports = \App\Models\Report::all();
            $staffs = \App\User::where('role_id', 2)->get();
            $clients = DB::table('users')->where('role_id', 3)->join('clients', 'users.id', '=', 'clients.user_id')->select('users.*', 'clients.company_name', 'clients.phone')->get();
            $cdd = \App\Models\Client::all();
            return view('dashboard.manager', compact('roles', 'reports', 'staffs', 'clients', 'cdd'));

        }else{
            return redirect('/');
        }
    }
    public function staff()
    {
        if (Auth::user()->role->level == 'staff') {
            # code...
            return view('dashboard.staff');

        }else{
            return redirect('/');
        }
    }
    public function client()
    {
        if (Auth::user()->role->level == 'client') {
            # code...
            $reports = Auth::user()->client;
            return view('dashboard.client', compact('reports'));

        }else{
            return redirect('/');
        }
    }
    public function upload(Request $request, $id)
    {
        $this->document->upload($request, $id);

        return redirect('/client?menu=full&id='.$id);
    }
}
