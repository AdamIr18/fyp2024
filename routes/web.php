<?php

use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserChartController;
use App\Http\Controllers\BookChartController;
use App\Http\Controllers\VehicleChartController;

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

Route::get('/', function () {
    //Mail::to('ai3123585@gmail.com')
        //->send(new HelloMail());
    return view('welcome'); 
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php'; 

Route::get('/admin/dashboard', function () {
    return view('adminDashboard');
})->middleware(['auth:admin', 'verified'])->name('adminDashboard'); 

require __DIR__.'/adminauth.php';

Route::get('index-renter', [RegisteredUserController::class, 'index'])->name('index-renter');

Route::get('view-renter/{id}', [RegisteredUserController::class, 'view'])->name('view-renter'); 

//route for reserve
Route::get('index-reserve', [ReserveController::class, 'index'])->name('index-reserve');
Route::get('create-reserve', [ReserveController::class, 'createform'])->name('createform-reserve');
Route::post('submit-create-reserve', [ReserveController::class, 'create'])->name('submit-create-reserve');
Route::get('updateform-reserve/{id}', [ReserveController::class, 'updateform'])->name('updateform-reserve');
Route::post('update-reserve/{id}', [ReserveController::class, 'update'])->name('update-reserve');
Route::get('delete-reserve/{id}', [ReserveController::class, 'delete'])->name('delete-reserve');

//route for vehicle
Route::get('index-vehicle', [VehicleController::class, 'index'])->name('index-vehicle'); 
Route::get('create-vehicle', [VehicleController::class, 'createform'])->name('createform-vehicle');
Route::post('submit-create-vehicle', [VehicleController::class, 'create'])->name('submit-create-vehicle');
Route::get('updateform-vehicle/{id}', [VehicleController::class, 'updateform'])->name('updateform-vehicle');
Route::post('update-vehicle/{id}', [VehicleController::class, 'update'])->name('update-vehicle');
Route::get('delete-vehicle/{id}', [VehicleController::class, 'delete'])->name('delete-vehicle');
Route::get('view-vehicle/{id}', [VehicleController::class, 'view'])->name('view-vehicle');  
Route::get('updateformAv-vehicle/{id}', [VehicleController::class, 'updateformAv'])->name('updateformAv-vehicle'); //baru
Route::post('updateAv-vehicle/{id}', [VehicleController::class, 'updateAv'])->name('updateAv-vehicle'); //baru

//route for book
Route::get('updateform2-vehicle/{id}', [BookController::class, 'updateform2'])->name('updateform2-vehicle'); 
Route::post('submit-create-aftervehicle', [BookController::class, 'aftercreate'])->name('submit-create-aftervehicle'); 
Route::get('index2', [BookController::class, 'index2'])->name('index2');
Route::get('index3', [BookController::class, 'index3'])->name('index3'); 
Route::get('delete-book/{id}', [BookController::class, 'delete'])->name('delete-book');
Route::get('index4', [BookController::class, 'index4'])->name('index4'); //baru
// Route::get('view-vehicle2/{id}', [VehicleController::class, 'view2'])->name('view-vehicle2');

// for booking status 
Route::group(['controller' => App\Http\Controllers\BookController::class], function () {
    Route::get('/books/{bookID}', 'show')->name('books.show');
    Route::put('/books/{bookID}', 'updateBookStatus')->name('books.updateStatus');
});
 
// for vehicle renter status
Route::group(['controller' => App\Http\Controllers\Auth\RegisteredUserController::class], function () {
    Route::get('/users/{id}', 'show')->name('users.show');
    Route::put('/users/{id}', 'updateRenterStatus')->name('users.updateStatus');
});

// for upload deposit
Route::get('/download/{file}',[BookController::class,'download']);
Route::get('/view/{bookID}',[BookController::class,'view']); 

// for data visualization
Route::get('userChart', [UserChartController::class, 'userChart'])->name('userChart');  
Route::get('bookChart', [BookChartController::class, 'bookChart'])->name('bookChart'); 
Route::get('vehicleChart', [VehicleChartController::class, 'vehicleChart'])->name('vehicleChart'); 