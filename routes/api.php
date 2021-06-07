<?php

use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register',[AuthorController::class,'register']);
Route::post('login',[AuthorController::class,'login']);
Route::group(['middleware'=>['auth:api']],function (){
   Route::get('profile',[AuthorController::class,'profile']);
   Route::get('logout',[AuthorController::class,'logout']);
   //books
    Route::post('book',[BookController::class,'create']);
    Route::get('book',[BookController::class,'index']);
    Route::get('book/{book}',[BookController::class,'show']);
    Route::patch('book/{book}',[BookController::class,'update']);
    Route::delete('book/{book}',[BookController::class,'delete']);
    Route::get("author-books", [BookController::class, "authorBook"]);

});
