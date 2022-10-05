<?php

use App\Http\Controllers\Admin\{
    ACL\PermissionController,
    ACL\ProfileController,
    ACL\PermissionProfileController,
    CategoryController,
    DashboardController,
    PlanController,
    PlanDetailController,
    ProductCategoryController,
    ProductController,
    TableController,
    UserController
};
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use Illuminate\Support\Facades\{
    Auth,
    Route
};
use App\Http\Controllers\Site\SiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')
        ->name('admin.')
        ->middleware('auth')
        ->group(function() {

            // Rotas Categorias
            Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
            Route::resource('tables', TableController::class);

            // Produtos X Categorias
            Route::any('products/{product}/categories/search', [ProductCategoryController::class, 'search'])->name('products.categories.search');
            Route::get('products/{product}/categories', [ProductCategoryController::class, 'categories'])->name('products.categories.index');
            Route::get('products/{product}/categories/available', [ProductCategoryController::class, 'available'])->name('products.categories.available');
            Route::post('products/{product}/categories', [ProductCategoryController::class, 'attachCategoriesToProduct'])->name('products.categories.attach');
            Route::delete('products/{product}/categories/{category}', [ProductCategoryController::class, 'detachCategoriesToProduct'])->name('products.categories.detach');

            // Rotas Categorias
            Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
            Route::resource('products', ProductController::class);

            // Rotas Categorias
            Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
            Route::resource('categories', CategoryController::class);

            // Rotas Usuários
            Route::any('users/search', [UserController::class, 'search'])->name('users.search');
            Route::resource('users', UserController::class);

            // Planos X Perfis
            Route::any('plans/{url}/profiles/search', [PlanProfileController::class, 'search'])->name('plans.profiles.search');
            Route::get('plans/{url}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles.index');
            Route::get('plans/{url}/profiles/available', [PlanProfileController::class, 'available'])->name('plans.profiles.available');
            Route::post('plans/{url}/profiles', [PlanProfileController::class, 'attachProfilesToPlan'])->name('plans.profiles.attach');
            Route::delete('plans/{url}/profiles/{profile}', [PlanProfileController::class, 'detachProfilesToPlan'])->name('plans.profiles.detach');

            // Perfis X Permissões
            Route::any('profiles/{profile}/permissions/search', [PermissionProfileController::class, 'search'])->name('profiles.permissions.search');
            Route::get('profiles/{profile}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions.index');
            Route::get('profiles/{profile}/permissions/available', [PermissionProfileController::class, 'available'])->name('profiles.permissions.available');
            Route::post('profiles/{profile}/permissions', [PermissionProfileController::class, 'attachPermissionsToProfile'])->name('profiles.permissions.attach');
            Route::delete('profiles/{profile}/permissions/{permission}', [PermissionProfileController::class, 'detachPermissionsToProfile'])->name('profiles.permissions.detach');

            // Rotas Permissões
            Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
            Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
            Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
            Route::get('permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
            Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
            Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
            Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

            // Rotas Perfis
            Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
            Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
            Route::get('profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
            Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
            Route::get('profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
            Route::post('profiles', [ProfileController::class, 'store'])->name('profiles.store');
            Route::put('profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
            Route::delete('profiles/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

            // Rotas Planos Detalhes
            Route::get('plans/{url}/details', [PlanDetailController::class, 'index'])->name('plans.details.index');
            Route::get('plans/{url}/details/create', [PlanDetailController::class, 'create'])->name('plans.details.create');
            Route::get('plans/{url}/details/{id}', [PlanDetailController::class, 'edit'])->name('plans.details.edit');
            Route::post('plans/{url}/details', [PlanDetailController::class, 'store'])->name('plans.details.store');
            Route::put('plans/{url}/details/{id}', [PlanDetailController::class, 'update'])->name('plans.details.update');
            Route::delete('plans/{url}/details/{id}', [PlanDetailController::class, 'destroy'])->name('plans.details.destroy');

            // Rotas Planos
            Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
            Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
            Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
            Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
            Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
            Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
            Route::put('plans/{url}', [PlanController::class, 'update'])->name('plans.update');
            Route::delete('plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');

            // Dashboard
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        });

// Site
Route::get('/plan/{url}/register', [SiteController::class, 'planRegister'])->name('site.plan.register');
Route::get('/', [SiteController::class, 'index'])->name('site.home.index');

Auth::routes();
