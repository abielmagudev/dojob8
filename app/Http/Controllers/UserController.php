<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\User\Services\MemberRoleCatalogManager;
use App\Models\User\UserProfiler;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');    
    }

    public function index(Request $request)
    {
        $users = User::with('profile')
        ->filterByParameters( $request->all() )
        ->where('id', '!=', auth()->id())
        ->orderBy('id', $request->get('sort', 'desc'))
        ->paginate(35)
        ->appends( $request->query() );

        return view('users.index', [
            'users' => $users,
            'profiles' => UserProfiler::classnicknames(),
            'request' => $request,
        ]);
    }

    public function create(UserCreateRequest $request)
    {
        $profile = app($request->profile_type)->findOrFail($request->profile_id);
        
        return view('users.create', [
            'member_roles' => MemberRoleCatalogManager::restrictedByUserRole( auth()->user() ),
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

        if( $request->filled('member_role') ) {
            $user->assignRole( $request->member_role );
        } else {
            $user->assignRole( $request->profile_role );
        }


        return redirect()->route('users.index')->with('success', "You created the user <b>{$user->name}</b>");
    }

    public function show(User $user)
    {
        if( $user->id == auth()->id() ) {
            return redirect()->route('users.index');
        }
        
        return view('users.show')->with('user', $user);
    }

    public function edit(User $user)
    {
        if( $user->id == auth()->id() ) {
            return redirect()->route('users.index');
        }
        
        return view('users.edit', [
            'member_roles' => MemberRoleCatalogManager::restrictedByUserRole( auth()->user() ),
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        if(! $user->fill($request->validated())->save() ) {
            return back()->with('danger', 'Error updating user, try again please');
        }

        if( $request->filled('member_role') ) {
            $user->assignRole( $request->member_role );
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
