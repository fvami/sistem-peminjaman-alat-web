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
        $user = User::all();
        return UserResource::collection($user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $user->update($request->all());
        return new UserResource($user);
    }

    public function delete($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return response()->json('success delete!');
    }
}
