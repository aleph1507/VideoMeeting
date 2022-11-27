<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index')->with('users', $users);
    }

    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}
