<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\CommentReplateController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    //profile routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']); 
    //friends Routes
    Route::post('/request/send', [FriendsController::class,'store']); 
    Route::get('/friends/accepted', [FriendsController::class,'index']);    
    Route::get('/friends/not_accepted/{id}', [FriendsController::class,'friend_not_accepted']);  
    //posts Routes
    Route::post('/post/create', [PostController::class,'store']);    
    Route::post('/post/update/{id}', [PostController::class,'update']);    
    Route::delete('/post/delete/{id}', [PostController::class,'delete']);
    //likes Routes    
    Route::get('/all/Likes/{id}', [LikesController::class,'show_likes']);    
    Route::post('/likes/add', [LikesController::class,'add_likes']);
    Route::delete('/like/delete/{id}', [LikesController::class,'delete_like']);
    //comment Routes
    Route::get('/Num/comment/post/{id}', [CommentController::class,'Show_Num_Comment']);    
    Route::get('/post/comment/{id}', [CommentController::class,'Show_Comment']);
    Route::post('/add/comment', [CommentController::class,'Add_Comments']);
    Route::delete('/delete/comment/{id}', [CommentController::class,'delete_comment']);
    //comment replate
    Route::get('/Num/comment/replate/{id}', [CommentReplateController::class,'Show_Number_Of_Comment']);    
    Route::get('/comment/replate', [CommentReplateController::class,'Show_Comment_Rep']);
    Route::post('/add/comment/replate', [CommentReplateController::class,'Add_Comment_Rep']);
    Route::Delete('/comment/replate/delete', [CommentReplateController::class,'delete_Comment_Rep']);
});

