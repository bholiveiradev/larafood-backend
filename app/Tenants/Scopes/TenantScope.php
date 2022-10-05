<?php

namespace App\Tenants\Scopes;

use App\Tenants\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('company_id', app(ManagerTenant::class)->getCompanyId());
    }
}
