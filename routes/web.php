<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentScheduleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\PaymentSchedule;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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







Route::get('/', [StudentController::class, 'loadIndex'])->name('index');


Route::get('/details', function() {
    return view('pages.details_form');
})->name('page.details');

Route::get('/application/message/{student}', [StudentController::class, 'loadMessage'])->name('application.message');

Route::get('/quiz', function() {
    return view('pages.quiz');
})->name('quiz');

Route::get('/contact', function() {
    return view('pages.contact');
})->name('contact');


Route::get('/register-page', function() {
    return view('pages.register');
})->name('register.page');

Route::post('/details-form', [StudentController::class, 'showDetails'])->name('details.post');
Route::get('/outstanding-fees/{student}', [StudentController::class, 'outstanding' ])->name('outstanding.payment');

Route::get('/business-analysis', [CourseController::class, 'showBusinessAnalysis'])->name('show.businessAnalysis');
Route::get('/scrum-master', [CourseController::class, 'showScrumMaster'])->name('show.scrumMaster');

Route::get('/application/{course}', [CourseController::class, 'getApplicationForm'] )->name('application.form');
Route::post('/application/form', [StudentController::class, 'store'])->name('application.submit');

Route::get('/application/new/{course}', [CourseController::class, 'loadNewCourse'] )->name('application.newCourse');
Route::post('/application/new-course/form', [StudentController::class, 'getNewCourseDetails'])->name('newCourse.submit');
Route::get('/payment/new-course/{student}', [PaymentController::class, 'showNewCourse'])->name('payment.newCourse');

Route::get('/payment/{student}', [PaymentController::class, 'index'])->name('payment');
Route::get('/payment/upload/{student}', [PaymentController::class, 'showPaymentUpload'])->name('payment.show');
Route::post('/payment/store/', [PaymentController::class, 'store'])->name('payment.store');


Route::post('/feedback', [StudentController::class, 'submitFeedbackForm'])->name('submit.feedback');
Route::post('/consultancy', [UserController::class, 'submitConsultancyForm'])->name('consultancy');


Route::middleware(['auth', 'verified'])->prefix('admin')->group(function() {
    
    // Route::group(['middleware' => 'role:super-admin|admin'], function() {
        Route::group(['middleware' => 'isAdmin'], function() {
            
        Route::resource('roles', RoleController::class);
        Route::delete('roles/{roleId}/delete', [RoleController::class, 'destroy']); //->middleware('permission:delete role');

        Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);
    
        Route::resource('users', UserController::class);
        Route::delete('users/{userId}/delete', [UserController::class, 'destroy']);
    
        Route::resource('permissions', PermissionController::class);
        Route::delete('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);
    
        
        Route::get('/dashboard', [UserController::class, 'loadDashboard'])->name('dashboard');

        Route::get('/promo', [UserController::class, 'loadPromo'])->name('promo.view');
        Route::Post('/promo/create', [UserController::class, 'genPromoCode'])->name('promo.create');

      });
   

    Route::get('/students', [StudentController::class, 'index'])->name('students.view');
    Route::post('/students/{student}',[StudentController::class, 'update'])->name('student.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::delete('/students/review/{student}', [StudentController::class, 'deleteReview'])->name('student.review.delete');


    Route::get('/pending/payments', [PaymentController::class, 'getPendingPayments'])->name('payments.pending');
    Route::post('/approve/payment/{id}', [PaymentController::class, 'approve'])->name('payment.approve');
    Route::post('/decline/payment', [PaymentController::class, 'decline'])->name('payment.decline');

    Route::get('active/payments', [PaymentController::class, 'getActivePayments'])->name('payments.active');
    Route::get('declined/payments', [PaymentController::class, 'getDeclinedPayments'])->name('declined.payments');

    Route::get('pending/reviews', [StudentController::class, 'getPendingReviews'])->name('pending.reviews');
    Route::get('active/reviews', [StudentController::class, 'getActiveReviews'])->name('active.reviews');
    Route::get('declined/reviews', [StudentController::class, 'getDeclinedReviews'])->name('declined.reviews');

    Route::post('approve/reviews/{student}', [StudentController::class, 'approveReview'])->name('approve.reviews');
    Route::post('decline/reviews/{student}', [StudentController::class, 'declineReview'])->name('decline.reviews');

    Route::get('/payment-schedule', [PaymentScheduleController::class, 'index'])->name('show.schedules');
    Route::post('/payment-schedule/{schedule}', [PaymentScheduleController::class, 'update'])->name('schedule.update');



});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
