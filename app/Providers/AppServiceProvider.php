<?php

namespace App\Providers;

use App\Models\{
    Category,
    Company,
    Plan,
    Product
};
use App\Observers\{
    CategoryObserver,
    CompanyObserver,
    PlanObserver,
    ProductObserver
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Company::observe(CompanyObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
