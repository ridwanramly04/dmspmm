<?php

namespace App\Services\Managers;
use App\User;

class StaffService {

    public function add($data)
    {
        $role = \App\Models\Role::where('level', 'staff')->first();

        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'role_id' => 2
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Staff Succesfully Added!' 
        ]);


    }

    public function update($data, $id)
    {
        $user = User::find($id)->update([
            'role_id' => $data->role_id,
            'name' => $data->name,
            'email'=> $data->email
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Profile Successfully Updated!'
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json([
            'status' => 200,
            'message' => $user
        ]);
    }

    public function lists()
    {
        $users = User::where('role_id', 2)->get();

        return response()->json([
            'status' => 200,
            'message' => $users
        ]);
    }
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully Deleted!'
        ]);
    }
}