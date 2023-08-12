<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


//Post Route
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        Route::get('/', function () {
            return view('welcome');
        });
        
        Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('posts/index', [PostController::class,'index'])->name('posts.index');
Route::get('posts/create', [PostController::class,'create'])->name('posts.create');
Route::get('posts/trashed', [PostController::class,'trashed'])->name('posts.trashed');
Route::post('posts/update/{id}', [PostController::class,'update'])->name('posts.update');
Route::post('posts/store', [PostController::class,'store'])->name('posts.store');
Route::delete('posts/destroy/{id}', [PostController::class,'destroy'])->name('posts.destroy');
Route::delete('posts/hdelete/{id}', [PostController::class,'hdelete'])->name('posts.hdelete');
Route::get('posts/restorPost/{id}', [PostController::class,'restorePost'])->name('posts.restorePost');
Route::get('posts/edit/{id}', [PostController::class,'edit'])->name('posts.edit');
Route::get('posts/show/{slug}', [PostController::class,'show'])->name('posts.show');
});
//User Route
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
      Route::get('users/index', [UserController::class,'index'])->name('users.index');
      Route::get('users/create', [UserController::class,'create'])->name('users.create');
      Route::post('users/store', [UserController::class,'store'])->name('users.store');
      Route::delete('users/destroy/{id}', [UserController::class,'destroy'])->name('users.destroy');
  
    
    });

//send email
// Route::get('email-send',function(){

//     $data['email']='ali@org.com';
//     dispatch(new App\Jobs\SendEmailJob($data));
//     dd('email send successfuly');

// });