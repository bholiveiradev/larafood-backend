<?php

use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('admin/plans', [PlanController::class, 'index'])->name('admin.plans.index');
Route::get('admin/plans/create', [PlanController::class, 'create'])->name('admin.plans.create');
Route::post('admin/plans', [PlanController::class, 'store'])->name('admin.plans.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();
