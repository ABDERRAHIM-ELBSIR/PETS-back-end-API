<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FriendsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\LikesController;
use App\Http\Controllers\Api\CommentReplateController;
use App\Http\Controllers\Api\MessagesController;
use App\Http\Controllers\Api\GroupsController;
use App\Http\Controllers\Api\Group_MembersController;
use App\Http\Controllers\Api\ShowNotificationController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\PostGroopController;

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
Route::post('/forgetpassword', [AuthController::class, 'forgotPassword']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    //profile routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']); 
    //friends Routes    
    Route::get('/friends/accepted', [FriendsController::class,'myfriend']); 
    Route::post('/request/send', [FriendsController::class,'store']); 
    Route::get('/friend/not_accepted', [FriendsController::class,'friend_not_accepted']);  
    Route::get('friend/accepte/{id}', [FriendsController::class,'update']);  
    Route::delete('/request/delete/{id}', [FriendsController::class,'delete']);  
    //posts Routes
    Route::post('/post/create', [PostController::class,'store']); 
    Route::get('/posts',[PostController::class,'get_posts_of_myFriend']);
    Route::post('/post/update/{id}', [PostController::class,'update']);    
    Route::delete('/post/delete/{id}', [PostController::class,'delete']);
    // posts group  Routes
    Route::post('group/post/create', [PostGroopController::class,'store']); 
    Route::get('/group/posts/{id}',[PostGroopController::class,'get_posts_of_group']);
    Route::post('/post/update/{id}', [PostGroopController::class,'update']);    
    Route::delete('/post/delete/{id}', [PostGroopController::class,'delete']);
    //likes Routes    
    Route::get('/all/Likes/{id}', [LikesController::class,'show_likes']);    
    Route::post('/likes/add', [LikesController::class,'add_likes']);
    Route::delete('/like/delete/{id}', [LikesController::class,'delete_like']);
    //comment Routes
    Route::get('/Num/comment/post/{id}', [CommentController::class,'Show_Num_Comment']);    
    Route::get('/post/comment/{id}', [CommentController::class,'Show_Comment']);
    Route::post('/add/comment', [CommentController::class,'Add_Comments']);
    Route::delete('/delete/comment/{id}', [CommentController::class,'delete_comment']);
    //comment replate routes
    Route::get('/Num/comment/replate/{id}', [CommentReplateController::class,'Show_Number_Of_Comment']);    
    Route::get('/comment/replate', [CommentReplateController::class,'Show_Comment_Rep']);
    Route::post('/add/comment/replate', [CommentReplateController::class,'Add_Comment_Rep']);
    Route::Delete('/comment/replate/delete', [CommentReplateController::class,'delete_Comment_Rep']);
    //messages routes   
    Route::get('/messages/{id}', [MessagesController::class,'Show_message']);
    Route::post('/create/message', [MessagesController::class,'store']);
    Route::Delete('/delete/message/{id}', [MessagesController::class,'delete_message']);
    //groupe routes
    Route::post('/create/group', [GroupsController::class,'create_group']);
    Route::get('/group', [GroupsController::class,'get_all_group']);
    Route::get('/group/{id}', [GroupsController::class,'get_spisifique_group']);
    Route::get('/user/group', [GroupsController::class,'get_group_for_user']);
    //groupe Members
    Route::get('/group/member/{id}', [Group_MembersController::class,'get_all_member']);
    Route::post('/join_to_group', [Group_MembersController::class,'join_to_group']);
    Route::Delete('/delete/member/{id}', [Group_MembersController::class,'delete_member']);
    //show notification 
    Route::get('/notification',[ShowNotificationController::class,'ShowNotification']);
    //search Routes
    Route::get('/search',[SearchController::class,'search']);

});



