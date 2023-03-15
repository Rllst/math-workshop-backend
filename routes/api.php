<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PostController;
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

//Secured
Route::middleware('auth:api')->group(function(){
    //Auth
    Route::post('/refresh',[UserAuthController::class, 'refresh']);
    //Admin
    Route::post('/admins', [AdminController::class, 'create']);
    Route::get('/admins', [AdminController::class, 'readAll']);
    Route::get('/admins/{id}', [AdminController::class, 'read']);
    Route::patch('/admins/{id}', [AdminController::class, 'update']);
    Route::delete('/admins/{id}', [AdminController::class, 'delete']);
    //Archive
    Route::post('/archive',[ArchiveController::class,'create']);
    Route::post('/archive/file/{id}',[ArchiveController::class,'createFile']);
    Route::patch('/archive/{id}',[ArchiveController::class,'update']);
    Route::delete('/archive/{id}',[ArchiveController::class,'delete']);
    Route::delete('/archive/file/{id}',[ArchiveController::class,'deleteFile']);
    //Calendar
    Route::post('/events', [CalendarController::class, 'create']);
    Route::patch('/events/{id}', [CalendarController::class, 'update']);
    Route::delete('/events/{id}', [CalendarController::class, 'delete']);
    //Category
    Route::post('/categories',[CategoryController::class, 'create']);
    Route::patch('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}',[CategoryController::class, 'delete']);
    //Comment
    Route::post('/comments/approve/{id}',[CommentController::class, 'approve']);
    Route::get('/comments',[CommentController::class, 'readUnapproved']);
    Route::get('/comments/{id}', [CommentController::class, 'read']);
    Route::delete('/comments/{id}',[CommentController::class, 'delete']);
    //Gallery
    Route::post('/gallery',[GalleryController::class, 'create']);
    Route::post('/gallery/{id}', [GalleryController::class, 'createImage']);
    Route::patch('/gallery/{id}', [GalleryController::class, 'update']);
    Route::delete('/gallery/{id}',[GalleryController::class, 'delete']);
    Route::delete('/gallery/image/{id}', [GalleryController::class, 'deleteImage']);
    //Post
    Route::post('/post', [PostController::class, 'create']);
    Route::get('/posts',[PostController::class, 'readAll']);
    Route::post('/post/image/{id}', [PostController::class, 'updateImage']);
    Route::patch('/post/{id}', [PostController::class, 'update']);
    Route::delete('/post/{id}',[PostController::class, 'delete']);
    //Quote
    Route::post('/quotes', [QuoteController::class, 'create']);
    Route::get('/quotes', [QuoteController::class, 'readAll']);
    Route::get('/quotes/{id}', [QuoteController::class, 'read']);
    Route::patch('/quotes/{id}', [QuoteController::class, 'update']);
    Route::delete('/quotes/{id}', [QuoteController::class, 'delete']);
    //Team
    Route::post('/team', [TeamController::class, 'create']);
    Route::get('/team/{id}', [TeamController::class, 'read']);
    Route::patch('/team/{id}', [TeamController::class, 'update']);
    Route::post('/team/image/{id}', [TeamController::class, 'updateImage']);
    Route::delete('/team/{id}', [TeamController::class, 'delete']);
});
//Public

//Auth
Route::post('/login', [UserAuthController::class, 'login']);
Route::get('/create', [UserAuthController::class, 'test']);
//Archive
Route::get('/archive',[ArchiveController::class,'readAll']);
Route::get('/archive/{id}',[ArchiveController::class,'read']);
Route::get('/archive/file/{id}',[ArchiveController::class,'readFile']);
//Calendar
Route::get('/events/{id}', [CalendarController::class, 'read']);
Route::get('/events', [CalendarController::class, 'readAll']);
//Category
Route::get('/categories',[CategoryController::class, 'readAll']);
Route::get('/categories/{id}',[CategoryController::class, 'read']);
//Comment
Route::post('/comments/{id}',[CommentController::class, 'create']);
//Gallery
Route::get('/gallery/image/{id}', [GalleryController::class, 'readImage']);
Route::get('/gallery', [GalleryController::class, 'readAll']);
Route::get('/gallery/{id}',[GalleryController::class, 'read']);
Route::get('/gallery/random/img', [GalleryController::class, 'readRandomImage']);
//Post
Route::get('/posts/{page}',[PostController::class,'readPage']);
Route::get('/post/{id}', [PostController::class, 'read']);
Route::get('/post/image/{id}',[PostController::class,'readImage']);
//Quote
Route::get('/quote', [QuoteController::class, 'readRand']);
//Team
Route::get('/team', [TeamController::class, 'readAll']);
Route::get('/team/image/{id}', [TeamController::class, 'readImage']);



