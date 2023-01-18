<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GetAuthController;
use App\Http\Controllers\Api\GetPostController;
use App\Http\Controllers\Api\GetProfileController;
use App\Http\Controllers\Api\GetCategoryController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login & Register with token
Route::post('/userLogin',[GetAuthController::class,'userLogin']);
Route::post('/userRegister',[GetAuthController::class,'userRegister']);

// Profile update
Route::get('/getAllUser',[GetProfileController::class,'getAllUser']);
Route::post('/getMyProfileData',[GetProfileController::class,'getMyProfileData']);
Route::post('/profileUpdate',[GetProfileController::class,'profileUpdate']);
Route::post('/changePassword',[GetProfileController::class,'changePassword']);

// Post
Route::get('/getAllPost',[GetPostController::class,'getAllPost']);
Route::post('/searchPost',[GetPostController::class,'searchPost']);
Route::post('/postDetails',[GetPostController::class,'postDetails']);
Route::post('/postViewCounts',[GetPostController::class,'postViewCounts']);
Route::post('/postComment',[GetPostController::class,'postComment']);
Route::post('/loadComments',[GetPostController::class,'loadComments']);
Route::post('/commentDelete',[GetPostController::class,'commentDelete']);

// Category
Route::get('/getAllCategory',[GetCategoryController::class,'getAllCategory']);
Route::post('/searchPostByCategory',[GetCategoryController::class,'searchPostByCategory']);

// Contact
Route::post('/createContactMessage',[ContactController::class,'createContactMessage']);
