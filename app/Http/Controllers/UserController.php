<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController\Services\RouteShowProfileService;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\User\Kernel\ProfileContainer;
use App\Models\User\Services\RoleCatalogManager;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');    

        $this->middleware('abortUserHasSuperAdminRole')->only(['show', 'edit', 'update']);
    }

    public function index(Request $request)
    {
        $users = User::with('profile')
        ->filterByParameters( $request->all() )
        ->excludesSuperAdminRole()
        ->excludesAuth()
        ->orderBy('id', $request->get('sort', 'desc'))
        ->paginate(35)
        ->appends( $request->query() );

        return view('users.index', [
            'users' => $users,
            'profiles' => ProfileContainer::shorts(),
            'roles' => RoleCatalogManager::exceptSuperAdminRole(),
            'request' => $request,
        ]);
    }

    public function create(UserCreateRequest $request)
    {
        $profile = app($request->profile_type)->findOrFail($request->profile_id);

        return view('users.create', [
            'profile' => $profile,
            'request' => $request,
            'roles' => RoleCatalogManager::byProfile($profile),
            'url_back' => RouteShowProfileService::get($profile),
            'user' => new User,
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        if(! $user = User::create($request->validated()) ) {
            return back()->with('danger', 'Error saving user, try again please');
        }

        $user->assignRole( $request->role );

        $url = RouteShowProfileService::get($user->profile);

        return redirect($url)->with('success', "You created the user <b>{$user->name}</b>");
    }

    public function show(User $user)
    {        
        return view('users.show')->with('user', $user);
    }

    public function edit(User $user)
    {        
        return view('users.edit', [
            'roles' => RoleCatalogManager::byProfile($user->profile),
            'url_back' => RouteShowProfileService::get($user->profile),
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        if(! $user->fill($request->validated())->save() ) {
            return back()->with('danger', 'Error updating user, try again please');
        }

        $user->assignRole( $request->role );

        return redirect()->route('users.edit', $user)->with('success', "You updated the user <b>{$user->name}</b>");
    }

    public function destroy(User $user)
    {
        if(! $user->delete() ) {
            return back()->with('danger', 'Error deleting user, try again please');
        }

        $url = RouteShowProfileService::get($user->profile);

        return redirect($url)->with('success', "You deleted the user <b>{$user->name}</b>");
    }
}
