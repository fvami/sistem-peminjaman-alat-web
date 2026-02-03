<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class AccountController extends Controller
{
    public function index()
    {
        $user = User::all();
        $role = Role::all();
        return view('admin.pages.account.index', compact('user', 'role'));
    }

    public function user()
    {
        $users = User::with('role')->get();
        return response()->json(['data' => $users]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $user->update($data);

        return new UserResource($user->load('role')); 
    }

    public function delete($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return response()->json('success delete!');
    }
}
