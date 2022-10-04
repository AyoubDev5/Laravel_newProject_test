<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// all listing
Route::get('/',[ListingController::class, 'allListing']);

//create listing
Route::get('/listings/create', [ListingController::class , 'createListing'])->middleware('auth');

//add listing
Route::post('/listings', [ListingController::class , 'addListing'])->middleware('auth');

//edit listing
Route::get('/listings/{listing}/edit', [ListingController::class , 'editListing'])->middleware('auth');

//update listing
Route::put('/listings/{listing}', [ListingController::class , 'updateListing'])->middleware('auth');

//delete listing
Route::delete('/listings/{listing}', [ListingController::class , 'deleteListing'])->middleware('auth');

//manage listing
Route::get('/listings/manage', [ListingController::class , 'manageListing'])->middleware('auth');

//listing by id
// Route::get('/listings/{id}', function ($id) {

//     $listing = Listings::find($id);

//     if($listing){
//         return view('listings',[
//             'header'=>"Latest Listing",
//             'listings'=>$listing,
//         ]);
//     }else{
//         abort(404);
//     }

// });

//or doing that is clean
Route::get('/listings/{listing}', [ListingController::class , 'listingById']);


//register
Route::get('/register', [UserController::class , 'userRegister'])->middleware('guest');

//new user register
Route::post('/users/register', [UserController::class , 'addUserRegister']);

//logout
Route::post('/logout', [UserController::class , 'userLogout'])->middleware('auth');

//login
Route::get('/login', [UserController::class , 'userLogin'])->name('login')->middleware('guest');

//new user login
Route::post('/users/login', [UserController::class , 'addUserLogin']);

/***  test ***/

// Route::get('/world', function () {
//     return response("<h1>Hello world</h1>");
// });

// Route::get('/hello/{id}', function ($id) {
//     return response("hello ".$id);
// })->where('id','[0-9]+');

// Route::get('/search', function(Request $req){
//     return $req;
// });
