<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('index');


Route::get('/details', function() {
    return view('pages.details_form');
})->name('page.details');

Route::post('/details-form', [StudentController::class, 'showDetails'])->name('details.post');
Route::get('/outstanding-fees/{student}', [StudentController::class, 'outstanding' ])->name('outstanding.payment');

Route::get('/business-analysis', [CourseController::class, 'showBusinessAnalysis'])->name('show.businessAnalysis');
Route::get('/scrum-master', [CourseController::class, 'showScrumMaster'])->name('show.scrumMaster');

Route::get('application/{course}', [CourseController::class, 'getApplicationForm'] )->name('application.form');
Route::post('application/form', [StudentController::class, 'store'])->name('application.submit');

Route::get('payment/{student}', [PaymentController::class, 'index'])->name('payment');
Route::get('payment/upload/{student}', [PaymentController::class, 'showPaymentUpload'])->name('payment.show');
Route::post('payment/store/', [PaymentController::class, 'store'])->name('payment.store');


Route::middleware(['auth', 'verified'])->prefix('admin')->group(function() {

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/students', [StudentController::class, 'index'])->name('students.view');
    Route::post('/students/{student}',[StudentController::class, 'update'])->name('student.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('student.destroy');


    Route::get('/pending/payments', [PaymentController::class, 'getPendingPayments'])->name('payments.pending');
    Route::post('/approve/payment/{id}', [PaymentController::class, 'approve'])->name('payment.approve');
    Route::post('/decline/payment', [PaymentController::class, 'decline'])->name('payment.decline');

    Route::get('active/payments', [PaymentController::class, 'getActivePayments'])->name('payments.active');
    Route::get('declined/payments', [PaymentController::class, 'getDeclinedPayments'])->name('declined.payments');

    Route::get('pending/reviews', [ReviewController::class, 'getPendingReviews'])->name('pending.reviews');
    Route::get('active/reviews', [ReviewController::class, 'getActiveReviews'])->name('active.reviews');
    Route::get('declined/reviews', [ReviewController::class, 'getDeclinedReviews'])->name('declined.reviews');

    Route::post('approve/reviews/{studentReview}', [ReviewController::class, 'approveReview'])->name('approve.reviews');
    Route::post('decline/reviews/{studentReview}', [ReviewController::class, 'declineReview'])->name('decline.reviews');

    Route::get('/courses', [CourseController::class, 'index'])->name('show.courses');



});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
