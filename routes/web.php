<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserFeedbackController;

Route::redirect('/', 'loginPage');
Route::get('/loginPage',[AuthController::class,'loginPage'])->name('#loginPage');
Route::get('/registerPage',[AuthController::class,'registerPage'])->name('#registerPage');

Route::middleware(['auth','authState'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {

        if(Auth::user()->role == 'admin'){
            return redirect()->route('profile#profilePage');
        }else{
            Auth::logout();
            return back();
        }

    });

    // Profile
    Route::prefix('profile')->group(function () {
        //Profile Page
        Route::get('/profilePage',[ProfileController::class,'profilePage'])->name('profile#profilePage');
        //Update Profile
        Route::post('/updateProfile',[ProfileController::class,'updateProfile'])->name('profile#updateProfile');
        //Admin List Page
        Route::get('/adminListPage',[ProfileController::class,'adminListPage'])->name('profile#adminListPage');
        //Delete Admin && User
        Route::get('/deleteAdmin/{id}',[ProfileController::class,'deleteAdmin'])->name('profile#deleteAdmin');
        //User List Page
        Route::get('/userListPage',[ProfileController::class,'userListPage'])->name('profile#userListPage');
        //Change Password Page
        Route::get('/changePasswordPage',[ProfileController::class,'changePasswordPage'])->name('profile#changePasswordPage');
        //Change Password
        Route::post('/changePassword',[ProfileController::class,'changePassword'])->name('profile#changePassword');
        //Delete My Account
        Route::get('/deleteAccount',[ProfileController::class,'deleteAccount'])->name('profile#deleteAccount');
    });
    // Category
    Route::prefix('category')->group(function () {
        // Category Page
        Route::get('/categoryPage',[CategoryController::class,'categoryPage'])->name('category#categoryPage');
        //Create Category
        Route::post('/createCategory',[CategoryController::class,'createCategory'])->name('category#createCategory');
         //Update Category Page
         Route::get('/updateCategoryPage/{CategoryId}',[CategoryController::class,'updateCategoryPage'])->name('category#updateCategoryPage');
         //Update Category
         Route::post('/updateCategory',[CategoryController::class,'updateCategory'])->name('category#updateCategory');
        //Delete Category
        Route::get('/deleteCategory/{CategoryId}',[CategoryController::class,'deleteCategory'])->name('category#deleteCategory');
    });
    // Post
    Route::prefix('post')->group(function () {
        // Post List Page
        Route::get('/postListPage',[PostController::class,'postListPage'])->name('post#postListPage');
        // Post Create
        Route::post('/postCreate',[PostController::class,'postCreate'])->name('post#postCreate');
        // Post Update Page
        Route::get('/postUpdatePage/{postId}',[PostController::class,'postUpdatePage'])->name('post#postUpdatePage');
        // Update Page
        Route::post('/postUpdate',[PostController::class,'postUpdate'])->name('post#postUpdate');
        // Post Delete
        Route::get('/postDelete/{postId}',[PostController::class,'postDelete'])->name('post#postDelete');
        // Trend Post Page
        Route::get('/trendPostPage',[PostController::class,'trendPostPage'])->name('post#trendPostPage');
    });
    // Other
    Route::prefix('other')->group(function () {
        // User Feedback Page
        Route::get('/userFeedbackPage',[UserFeedbackController::class,'userFeedbackPage'])->name('other#userFeedbackPage');
        // Feedback Delete
        Route::get('/feedbackDelete/{id}',[UserFeedbackController::class,'feedbackDelete'])->name('other#feedbackDelete');
    });
});
