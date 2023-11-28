<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Intermediary;
use App\Models\Member;
use App\Models\User;
use App\Models\User\UserProfiler;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::with('profile')->orderBy('id', 'desc')->paginate(25),
        ]);
    }

    public function create(Request $request)
    {
        if(! $profile = UserProfiler::instanceProfileByRequest($request) ) {
            abort(404);
        }

        return view('users.create', [
            'alias' => UserProfiler::getAliasNameRequest($request),
            'profile' => $profile,
            'request' => $request,
            'user' => new User,
        ]);
    }

    public function store(UserStoreRequest $request)
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
            ]
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'profile' => $user->profile,
            'alias' => $user->profile_alias,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
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

        return redirect()->route('users.index')->with('success', "You deleted the user <b>{$user->name}</b>");
    }
}
