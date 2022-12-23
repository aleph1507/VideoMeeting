<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort_if(Gate::denies('admin_area'), 403);
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index')->with('users', $users);
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_action', $user), 403);

        $categories = Category::orderBy('created_at', 'desc');
        $categories = request()->user()->is_admin ?
            $categories->pluck('title', 'id') :
            $categories->noAdmin()->pluck('title', 'id');

        return view('users.edit')
            ->with('user', $user)
            ->with('categories', $categories);
    }

    public function update(Request $request, User $user)
    {
        abort_if(Gate::denies('user_action', $user), 403);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8', 'confirmed'],
            'category_id' => ['sometimes', 'exists:categories,id'],
        ]);

        $user->update($request->except('password'));

        if (!is_null($password = $request->get('password'))) {
            $user->password = Hash::make($password);
            $user->save();
        }

        return redirect()->route('users.show', $user);
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_action', $user), 403);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }

    public function meeting(string $roomName)
    {
        $user = User::where('roomName', $roomName)->firstOrFail();
        $banner = Banner::forUser()->inRandomOrder()->first();
        return view('video')
            ->with('banner', $banner?->html)
            ->with('roomName', $user->roomName)
            ->with('displayName', $user->name);
    }
}
