<?php

namespace App\Tenants;

use App\Models\Company;

class ManagerTenant
{
    public function getCompanyId()
    {
        $company = $this->getCompany();

        return $company->id;
    }

    public function getCompany(): Company
    {
        return auth()->user()->company;
    }

    public function isAdmin(): bool
    {
        return in_array(auth()->user()->email, config('tenant.admins'));
    }
}
