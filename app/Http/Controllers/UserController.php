<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::orderBy('id', 'desc')->paginate(25),
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'user' => new User,
        ]);
    }

    public function store(UserSaveRequest $request)
    {
        if(! $user = User::create($request->validated()) ) {
            return back()->with('danger', 'Error saving user, try again please');
        }

        return redirect()->route('users.index')->with('success', "You saved the user <b>{$user->name}</b>");
    }

    public function show(User $user)
    {
        $previous = User::before($user->id)->first();
        $next = User::after($user->id)->first();

        return view('users.show', [
            'user' => $user,
            'routes' => [
                'previous' => $previous ? route('users.show', $previous) : false,
                'next' => $next ? route('users.show', $next) : false,
            ],
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserSaveRequest $request, User $user)
    {
        if(! $user->fill($request->validated())->save() ) {
            return back()->with('danger', 'Error updating user, try again please');
        }

        return redirect()->route('users.edit', $user)->with('success', "You updated the user <b>{$user->name}</b>");
    }

    public function destroy(User $user)
    {
        if(! $user->delete() ) {
            return back()->with('danger', 'Error deleting user, try again please');
        }

        return redirect()->route('users.index')->with('success', "You deleted the user {$user->name}");
    }
}
