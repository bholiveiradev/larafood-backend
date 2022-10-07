<?php

namespace App\Models\Traits;

trait UserACLTrait
{
    public function permissions()
    {
        $complanyPlan    = $this->company->plan;
        $userPermissions = [];

        foreach($complanyPlan->profiles as $profile) {
            foreach($profile->permissions as $permission) {
                array_push($userPermissions, $permission->name);
            }
        }

        return $userPermissions;
    }

    public function hasPermission(string $permission)
    {
        return in_array($permission, $this->permissions());
    }

    public function isAdmin()
    {
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant()
    {
        return !in_array($this->email, config('acl.admins'));
    }
}
