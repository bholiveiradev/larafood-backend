<?php

namespace App\Models\Traits;

trait UserACLTrait
{
    public function permissions()
    {
        $profiles = $this->company->profiles;
        $permissions = [];

        foreach($profiles as $profile) {
            foreach($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    public function hasPermission(string $permission)
    {
        return in_array($permission, $this->permissions());
    }
}
