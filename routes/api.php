<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Verb          Path                        Action  Route Name

// GET           /users                      index   users.index
// GET           /users/create               create  users.create
// POST          /users                      store   users.store
// GET           /users/{user_id}            show    users.show
// GET           /users/{user_id}/edit       edit    users.edit
// PUT|PATCH     /users/{user_id}            update  users.update
// DELETE        /users/{user_id}            destroy users.destroy


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('posts', PostController::class)->only([
   'destroy', 'show', 'store', 'update'
]);

Route::resource('products', ProductController::class)->only([
    'create', 'show', 'store', 'update', 'destroy'
])->middleware('auth');
