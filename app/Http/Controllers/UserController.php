<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\User\UserProfiler;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('profile')
        ->filterByInputs( $request->all() )
        ->orderBy('id', $request->get('sort', 'desc'))
        ->paginate(25)
        ->appends( $request->query() );

        return view('users.index', [
            'users' => $users,
            'request' => $request,
        ]);
    }

    public function create(Request $request)
    {
        if(! $profile = UserProfiler::find($request->get('id'), $request->get('profile')) ) {
            abort(404);
        }

        return view('users.create', [
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

        return redirect()->route('users.index')->with('success', "You created the user <b>{$user->name}</b>");
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
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
