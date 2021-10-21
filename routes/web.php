<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product/all', [ProductController::class, 'all']);
Route::post('/product/all', [ProductController::class, 'filter']);

//Route::get('/manufacturers', '');
//Route::get('/product/:id', function() {
//    return view('product');
//});
