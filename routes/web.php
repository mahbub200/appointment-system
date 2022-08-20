<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\NotificationController;


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
// Home Page Routes



Route::group(['middleware' => ['auth', 'patient']], function () {

    
    Route::post('/book/appointment', [App\Http\Controllers\SslCommerzPaymentController::class, 'index'])->name('book.appointment');
    Route::get('/my-booking', [App\Http\Controllers\FrontendController::class, 'myBookings'])->name('my.booking');
    // Profile Routes
 
    Route::get('/user-profile', [App\Http\Controllers\ProfileController::class,'index'])->name('index');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile',  [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');

    // Route::post('/profile-pic', 'ProfileController@profilePic')->name('profile.pic');
    Route::post('/profile-pic', [App\Http\Controllers\ProfileController::class, 'profilePic'])->name('profile.pic');

    Route::get('/my-prescription', [App\Http\Controllers\FrontendController::class, 'myPrescription'])->name('my.prescription');
    });


Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);

Route::get('/home', 'HomeController@index');
Route::get('/phone', [NotificationController::class, 'phone'])->name('phone');
Route::get('/phone-validation', [NotificationController::class, 'phoneValidation'])->name('phone-validation');
Route::post('send-sms-notification', [NotificationController::class, 'sendSmsNotification'])->name('sendSmsNotification');
Route::post('/phone-update', [NotificationController::class, 'phoneUpdate'])->name('phoneUpdate');

// Route::get('/dashboard', 'DashBoardController@index');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

Route::get('doctor',[DoctorController::class, 'index']);
// Route::get('/new-appointment/{doctorId}/{date}', 'FrontEndController@show')->name('create.appointment');
Route::get('/new-appointment/{doctorId}/{date}', [App\Http\Controllers\FrontendController::class, 'show'])->name('create.appointment');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function () {
    
    Route::resource('/doctor', DoctorController::class); 
    //Route::get('/patients','PatientlistController@index')->name('patient');
    
    Route::get('/patients',[App\Http\Controllers\PatientlistController::class, 'index'])->name('patient');

    Route::get('/patients/all',[App\Http\Controllers\PatientlistController::class, 'allTimeAppointment'])->name('all.appointments');
    Route::get('/status/update/{id}',[App\Http\Controllers\PatientlistController::class, 'toggleStatus'])->name('update.status');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Doctor Routes
Route::group(['middleware' => ['auth', 'doctor']], function () {

    Route::resource('appointment', AppointmentController::class);
   

    Route::post('/appointment/check',[App\Http\Controllers\AppointmentController::class,'check'])->name('appointment.check');
    Route::post('/appointment/update',[App\Http\Controllers\AppointmentController::class,'updateTime'])->name('update');
    Route::get('patient-today', [App\Http\Controllers\PrescriptionController::class,'index'])->name('patients.today');

    Route::post('/prescription', [App\Http\Controllers\PrescriptionController::class,'store'])->name('prescription');

    Route::get('/prescription/{userId}/{date}', [App\Http\Controllers\PrescriptionController::class,'show'])->name('prescription.show');

    Route::get('/prescribed-patients', [App\Http\Controllers\PrescriptionController::class,'patientsFromPrescription'])->name('prescribed.patients');

});

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

