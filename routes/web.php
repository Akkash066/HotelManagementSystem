<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'hotels'], function () {

    //hotels
    Route::get('/rooms/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'rooms'])->name('hotel.rooms');

    Route::get('/rooms-details/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'roomDetails'])->name('hotel.rooms.details');

    Route::post('/rooms-booking/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'roomBooking'])->name('hotel.rooms.booking');

    //payment
    Route::get('/pay', [App\Http\Controllers\Hotels\HotelsController::class, 'payWithPaypal'])->name('hotel.pay');
    // Route::get('hotels/pay', [App\Http\Controllers\Hotels\HotelsController::class, 'payWithPaypal'])->name('hotel.pay')->middleware('check.for.price');


    Route::get('/success', [App\Http\Controllers\Hotels\HotelsController::class, 'success'])->name('hotel.success');
});


// Route::get('hotels/success', [App\Http\Controllers\Hotels\HotelsController::class, 'success'])->name('hotel.success')->middleware('check.for.price');

// Users 
Route::get('users/my-bookings', [App\Http\Controllers\Users\UsersController::class, 'myBookings'])->name('users.bookings')->middleware('auth:web');






// admin panel

Route::get('admin/login', [App\Http\Controllers\Admins\AdminController::class, 'viewLogin'])->name('view.login');
// Route::get('admin/login', [App\Http\Controllers\Admins\AdminController::class, 'viewLogin'])->name('view.login')->middleware('check.for.login');
Route::post('admin/login', [App\Http\Controllers\Admins\AdminController::class, 'checkLogin'])->name('check.login');




Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/index', [App\Http\Controllers\Admins\AdminController::class, 'index'])->name('admins.dashboard');

    //admins list
    Route::get('/all-admins', [App\Http\Controllers\Admins\AdminController::class, 'alladmins'])->name('admins.all');
    //creating new admins
    Route::get('/create-admins', [App\Http\Controllers\Admins\AdminController::class, 'createadmins'])->name('admins.create');
    //Store new Admins data
    Route::post('/create-admins', [App\Http\Controllers\Admins\AdminController::class, 'storeAdmins'])->name('admins.store');

    //hotels
    Route::get('/all-hotels', [App\Http\Controllers\Admins\AdminController::class, 'allHotels'])->name('hotels.all');
    
    Route::get('/create-hotels', [App\Http\Controllers\Admins\AdminController::class, 'createHotels'])->name('hotels.create');
    // store hotel data
    Route::post('/create-hotels', [App\Http\Controllers\Admins\AdminController::class, 'storeHotels'])->name('hotels.store');
    
    //update and edit hotels
    Route::get('/edit-hotels/{id}', [App\Http\Controllers\Admins\AdminController::class, 'editHotels'])->name('hotels.edit');
    
    //update existing details
    Route::post('/update-hotels/{id}', [App\Http\Controllers\Admins\AdminController::class, 'updateHotels'])->name('hotels.update');
    
    //delete hotels with images
    Route::get('/delete-hotels/{id}', [App\Http\Controllers\Admins\AdminController::class, 'deleteHotels'])->name('hotels.delete');


    //room details show
    Route::get('/all-rooms', [App\Http\Controllers\Admins\AdminController::class, 'allRooms'])->name('rooms.all');
    
    //creating room
    Route::get('/create-rooms', [App\Http\Controllers\Admins\AdminController::class, 'createRooms'])->name('rooms.create');
    //store data in database
    Route::post('/create-rooms', [App\Http\Controllers\Admins\AdminController::class, 'storeRooms'])->name('rooms.store');


    //delete room 
    Route::get('/delete-rooms/{id}', [App\Http\Controllers\Admins\AdminController::class, 'deleteRooms'])->name('rooms.delete');


    //bookings
    Route::get('/all-bookings', [App\Http\Controllers\Admins\AdminController::class, 'allBookings'])->name('bookings.all');
    
    //Status
    Route::get('/edit-status/{id}', [App\Http\Controllers\Admins\AdminController::class, 'editStatus'])->name('bookings.edit.status');


    //Update status 
    Route::post('/update-status/{id}', [App\Http\Controllers\Admins\AdminController::class, 'updateStatus'])->name('bookings.update.status');

    //delete bookings 
    Route::get('/delete-bookings/{id}', [App\Http\Controllers\Admins\AdminController::class, 'deleteBookings'])->name('bookings.delete');

});
