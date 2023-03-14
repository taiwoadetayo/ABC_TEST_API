<?php
use Illuminate\Http\Request;
use App\Http\Controllers\NewsController;
/*
|--------------------------------------------------------------------------
| API Routes - Here is where you can register API routes for your application
|--------------------------------------------------------------------------
*/


// Stores
Route::get('/pullnews', [NewsController::class, 'pullNews']);
Route::get('/getfeeds', [NewsController::class, 'getFeeds']);
