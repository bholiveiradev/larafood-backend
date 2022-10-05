<?php

namespace App\Tenants\Observers;

use App\Tenants\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    /**
     * Handle the Category "creating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        $managerTenant = app(ManagerTenant::class);

        $model->company_id = $managerTenant->getCompanyId();
    }
}
