<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;

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





Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products', [ProductsController::class, 'index'])
    ->name('product.index');

Route::get('/products/{product:slug}', [ProductsController::class, 'show'])
    ->name('product.show');
    
Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout');;


Route::resource('cart', CartController::class)->except('show');

Route::group([
    'as' =>'dashboard.',
    'middleware' => ['auth','auth.type:admin,super_admin'],
],function() {

    Route::get('/dashboard',[DashboardController::class,'index'])
    // ->middleware('auth') //verified
    ->name('dashboard');

    Route::get('categories/trash', [CategoriesController::class, 'trash'])
        ->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('categories/{category}/forc-delete', [CategoriesController::class, 'forcdelete'])
        ->name('categories.forcdelete');

    Route::resource('dashboard/categories', CategoriesController::class)->middleware('auth');

    Route::resource('dashboard/products', ProductController::class)->middleware('auth');

    Route::get('products/trash', [ProductController::class, 'trash'])
        ->name('products.trash');
    Route::put('products/{product}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');
    Route::delete('products/{product}/forc-delete', [ProductController::class, 'forcdelete'])
        ->name('products.forcdelete');

        Route::get('dashboard/profiles/edit',[ProfileController::class,'edit'])
            ->name('profiles.edit');

        Route::put('dashboard/profiles/update',[ProfileController::class,'update'])
            ->name('profiles.update');

});

// Route::get('/dashboard',[DashboardController::class,'index'])
//     ->middleware('auth','verified')
//     ->name('dashboard');

// Route::resource('dashboard/categories', CategoriesController::class)->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/dashboard.php';

require __DIR__.'/auth.php';
