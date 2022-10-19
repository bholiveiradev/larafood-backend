<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    private $roleRepository, $userRepository;

    public function __construct(Role $role, User $user)
    {
        $this->roleRepository = $role;
        $this->userRepository = $user;

        $this->middleware('can:roles_users');
    }

    public function roles($userId) {
        $user = $this->userRepository->with('roles')->findOrFail($userId);

        return view('admin.pages.users.roles.index', compact('user'));
    }

    public function available($user)
    {
        $user = $this->userRepository->findOrFail($user);

        $roles = $this->roleRepository->available($user->id)->get();

        return view('admin.pages.users.roles.available', compact('user', 'roles'));
    }

    public function attachRolesToUser(Request $request, $userId)
    {
        $user = $this->userRepository->findOrFail($userId);

        $user->roles()->attach($request->roles);

        return redirect()->route('admin.users.roles.index', $user->id);
    }

    public function detachRolesToUser($userId, $roleId)
    {
        $user = $this->userRepository->findOrFail($userId);

        $user->roles()->detach($roleId);

        return redirect()->route('admin.users.roles.index', $user->id);
    }
}
