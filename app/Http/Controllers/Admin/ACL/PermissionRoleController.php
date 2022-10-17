<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    private $roleRepository, $permissionRepository;

    public function __construct(Role $role, Permission $permission)
    {
        $this->roleRepository       = $role;
        $this->permissionRepository = $permission;

        $this->middleware('can:permissions_roles');
    }

    public function permissions($roleId)
    {
        $role = $this->roleRepository->with('permissions')->findOrFail($roleId);

        return view('admin.pages.roles.permissions.index', compact('role'));
    }

    public function available($roleId)
    {
        $role = $this->roleRepository->findOrFail($roleId);

        $permissions = $this->permissionRepository->available($role->id)->get();

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions'));
    }

    public function search(Request $request, $roleId)
    {
        $role = $this->roleRepository->findOrFail($roleId);

        $permissions = $this->permissionRepository
                            ->available($role->id, $request->text)
                            ->get();

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions'));
    }

    public function attachPermissionsToRole(Request $request, $roleId)
    {
        $role = $this->roleRepository->findOrFail($roleId);

        $role->permissions()->attach($request->permissions);

        return redirect()->route('admin.roles.permissions.index', $role->id);
    }

    public function detachPermissionsToRole($roleId, $permissionId)
    {
        $role = $this->roleRepository->findOrFail($roleId);

        $role->permissions()->detach($permissionId);

        return redirect()->route('admin.roles.permissions.index', $role->id);
    }
}
