<?php

namespace App\Models\Traits;

use App\Models\Company;

trait UserACLTrait
{
    public function permissions(): array
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = [];

        foreach($permissionsRole as $permissionRole) {
            if (in_array($permissionRole, $permissionsPlan))
                array_push($permissions, $permissionRole);
        }

        return $permissions;
    }

    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();

        $permissionsRole = [];

        foreach ($roles as $role) {
            foreach($role->permissions as $permission) {
                array_push($permissionsRole, $permission->name);
            }
        }

        return $permissionsRole;
    }

    public function permissionsPlan(): array
    {
        $company = Company::with('plan.profiles.permissions')
                            ->where('id', $this->company_id)
                            ->first();

        $plan = $company->plan;

        $permissionsPlan = [];

        foreach($plan->profiles as $profile) {
            foreach($profile->permissions as $permission) {
                array_push($permissionsPlan, $permission->name);
            }
        }

        return $permissionsPlan;
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }
}
