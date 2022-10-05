<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\{
    Permission,
    Profile
};
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    private $profileRepository, $permissionRepository;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profileRepository    = $profile;
        $this->permissionRepository = $permission;
    }

    public function permissions($profileId)
    {
        $profile = $this->profileRepository->with('permissions')->findOrFail($profileId);

        return view('admin.pages.profiles.permissions.index', compact('profile'));
    }

    public function available($profileId)
    {
        $profile = $this->profileRepository->findOrFail($profileId);

        $permissions = $this->permissionRepository->available($profile->id)->get();

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));
    }

    public function search(Request $request, $profileId)
    {
        $profile = $this->profileRepository->findOrFail($profileId);

        $permissions = $this->permissionRepository
                            ->available($profile->id, $request->text)
                            ->get();

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));
    }

    public function attachPermissionsToProfile(Request $request, $profileId)
    {
        $profile = $this->profileRepository->findOrFail($profileId);

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('admin.profiles.permissions.index', $profile->id);
    }

    public function detachPermissionsToProfile($profileId, $permissionId)
    {
        $profile = $this->profileRepository->findOrFail($profileId);

        $profile->permissions()->detach($permissionId);

        return redirect()->route('admin.profiles.permissions.index', $profile->id);
    }
}
