<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;

class TenantService
{
    private array $data = [];
    private Plan $plan;

    private function createCompany()
    {
        return $this->plan->companies()->create([
            'cnpj'    => $this->data['cnpj'],
            'name'    => $this->data['company'],
            'email'   => $this->data['email'],
            'subscription'  => now(),
            'expires_at'    => now()->addDays(7),
        ]);
    }

    private function createUser(Company $company)
    {
        return $company->users()->create([
            'name'     => $this->data['name'],
            'email'    => $this->data['email'],
            'password' => Hash::make($this->data['password']),
        ]);
    }

    public function storeCompanyUser(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $company = $this->createCompany();

        return $this->createUser($company);
    }
}
