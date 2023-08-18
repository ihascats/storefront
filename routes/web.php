<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('products', [ProductController::class, 'index'])->name('products');

Route::resource('products', ProductController::class)->only([
    'create', 'store', 'update', 'destroy'
])->middleware(['auth', 'admin']);

Route::get('products/{id}', [ProductController::class, 'show']);


Route::resource('orders', OrderController::class)->only([
    'create', 'show', 'store', 'update', 'destroy'
])->middleware(['auth', 'admin']);

Route::resource('carts', CartController::class)->only([
    'store', 'update', 'destroy'
])->middleware(['auth']);

Route::get('carts/{id}', [CartController::class, 'show'])->middleware(['auth', 'checkOwnership'])->name('carts');

Route::get('wishlists/{id}', [WishlistController::class, 'show'])->middleware(['auth', 'checkOwnership'])->name('wishlists');

Route::post('wishlists', [WishlistController::class, 'store'])->name('wishlists.store')->middleware('auth');

Route::delete('wishlists/{wishlistItemId}', [WishlistController::class, 'destroy'])->name('wishlists.destroy')->middleware('auth');

require __DIR__.'/auth.php';
