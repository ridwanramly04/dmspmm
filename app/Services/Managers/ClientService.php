<?php

namespace App\Services\Managers;
use App\User;
use App\Models\Client;
use DB;

class ClientService {

    public function add($data)
    {
        // $role = \App\Models\Role::where('level', 'client')->first();
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'role_id' => 3
        ]);

        $client = $user->client()->create([
            'company_name' => $data->company_name,
            'phone' => $data->phone
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Client Succesfully Added!' 
        ]);
    }

    public function update($data, $id)
    {
        $user = User::find($id);

        $update =  $user->update([
            'name' => $data->name,
            'email' => $data->email,
        ]);

        $client = $user->client()->update([
            'company_name' => $data->company_name,
            'phone' => $data->phone
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Client Successfully Updated !' 
        ]);
    }

    public function show($id)
    {
        $user = DB::table('users')->where('users.id', $id)->join('clients', 'users.id', '=', 'clients.user_id')->select('users.*', 'clients.company_name', 'clients.phone')->first();

        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }

    public function lists()
    {
        $users = DB::table('users')->where('role_id', 3)->join('clients', 'users.id', '=', 'clients.user_id')->select('users.*', 'clients.company_name', 'clients.phone')->get();

        return response()->json([
            'status' => 200,
            'message' => $users
        ]);
    }
}