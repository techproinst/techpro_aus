<?php

namespace App\Http\Controllers;

use App\Mail\AdminReviewNotificationMail;
use App\Models\Student;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\ApplicationNotification;
use App\Models\Payment;
use App\Models\PaymentSchedule;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('courses')->get();

        return view('admin.students.view',compact('students'));

    
    }

    public function loadIndex()
    {
        $students =  Student::with('courses')->where('review_status', Student::STATUS_APPROVED)->get();

        return view('index', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ApplicationService $applicationService)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:students,email,NULL,id,deleted_at,NULL'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'password_confirmation' => ['required',],
        ]);

        
        $validated['password'] = Hash::make($request->input('password'));
        unset($validated['password_confirmation']);

        try {

            DB::beginTransaction();

            unset($validated['course_id']); 

             $std = Student::create($validated);

             if(is_array($request->course_id)) {

                $std->courses()->attach($request->course_id);

             } else {

                $std->courses()->attach([$request->course_id]);


             }

             $student = Student::with('courses')->find($std->id);

             $courses = $student->courses;

             

            // $courseNames = $courses->pluck('name')->toArray();
             
            // $student = $applicationService->getStudent($std->id);
        
            try {
  
                Mail::to($student->email)->send(new ApplicationNotification(firstname: $student->firstname, lastname: $student->lastname, email: $student->email,  courses:$courses,  id: $student->id, )); 



            } catch(Exception $err) {
                DB::rollBack();
                $emailException = $err->getMessage();

                Log::error($emailException);

                return redirect()->back()->with([
                    'flash_message' => 'critical error occurred  while processing email notification, try again later! or contact  support team',
                    'flash_type' => 'danger'
    
                ]);
            }
           
            DB::commit();


            return redirect()->route('application.message', ['student' => $student->id]);



        } catch(Exception $err) {

            DB::rollBack();
            
            Log::error($err->getMessage());

            return redirect()->back()->with([

                'flash_message' => 'Something went wrong while proccessing your registration. Please try again later  or contact support team',
                'flash_type' => 'danger'

            ]);

        }


    }


    public function loadMessage(Student $student)
    { 
        
        return view('application.message', compact('student'));

    }


    public function showDetails(Request $request, ApplicationService $applicationService) 
    {
          $student = Student::with('courses')->where('app_no', $request->app_no)->first();

          if(!$student) {

            return redirect()->back()->with([
                'flash_message' => 'Invalid application number',
                'flash_type' => 'danger'

            ]);

          }

          $payments = Payment::with('paymentSchedules')
                              ->where('student_id', $student->id)
                              ->where('status', Payment::Active)
                              ->get();

         if($payments->isEmpty()) {

            return view('pages.application.details', compact('student'));
         }



         $courseIds = $applicationService->getCourseIds($student);


         $paymentSchedules = $applicationService->getPaymentSchedule($courseIds);

        list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedules);

        $currency = $payments->first()->currency;

        $paid = $payments->sum('amount');

        $lastAmountDue = $payments->last()->amount_due;

        $balance = $lastAmountDue - $paid;

       // $balance = $amountDue - $paid;


         return view('pages.details', compact(
            'student',
            'payments',
            'amountDue',
            'balance',
            'currency',
        ));











    }

    public function outstanding(Student $student, ApplicationService $applicationService)
    { 

        $continent = $applicationService->getLocation();

        //dd($continent);
        
        return view('payments.upload', compact('student','continent'));

    }


    public function submitFeedbackForm(Request $request, ApplicationService $applicationService)
    {

       $student = Student::where('app_no', $request->app_no)->first();

            if(!$student) {

                    return redirect()->back()->with([
                        'flash_message' => 'Invalid application number',
                        'flash_type' => 'danger'

                    ]);

            }

            $request->validate([
                
                'comment' => ['required', 'string', 'max:20'],
                'passport' => 'required|mimes:jpg,jpeg,png,|max:1024',

            ]);

      
         
           
         $upload = null;
         
         if($request->hasFile('passport')) {

            $image = $request->File('passport');
            $rad =  mt_rand(1000, 9999);
    
            $imageName =  md5($image->getClientOriginalName()) . $rad . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('upload/'), $imageName);

            $upload =  $imageName;
    
        }

        try {

            DB::beginTransaction();

                        $country = $applicationService->getCountry();

                        $student->update([
                                'country' => $country,
                                'review_status' => Student::STATUS_PENDING,
                                'comment' => $request->comment,
                                'passport' => $upload ?? null,
                            ]);


                        try {

                            $admin = User::first();

                            Mail::to($admin->email)->send(new AdminReviewNotificationMail($admin->name));

                        } catch(Exception $emailException) {

                            DB::rollBack();

                            Log::error($emailException->getMessage());

                            return redirect()->back()->with([
                                'flash_message' => 'Critical error occured while trying to send notification, Please try again later or contact our support team',
                                'flash_type' => 'danger',
                    
                            ]);

                        }

            DB::commit();


            return redirect()->back()->with([
                        'flash_message' => 'Your review has been submitted succesfully',
                        'flash_type' => 'success',
        
                    ]);


        } catch(Exception $err) {

            DB::rollBack();

            Log::error($err->getMessage());

            return redirect()->back()->with([
                'flash_message' => 'Something went wrong while submitting your review, Please try again later',
                'flash_type' => 'danger',
    
            ]);
    

            

        }

         

       




    }

    public function getPendingReviews() 
    {
       $students = Student::with('courses')->where('review_status', Student::STATUS_PENDING)->get(); 

       return view('admin.reviews.pending', compact('students'));
    }

    public function getActiveReviews()
    {
        $students = Student::with('courses')->where('review_status', Student::STATUS_APPROVED)->get(); 

         return view('admin.reviews.active', compact('students'));
    }


    public function getDeclinedReviews() 
    {
         
        $students = Student::with('courses')->where('review_status', Student::STATUS_DECLINED)->get(); 

        return view('admin.reviews.declined', compact('students'));
    }


    public function approveReview(Student $student)
    {    
        if(!$student) {
            
            return redirect()->back()->with([
                'flash_message' => 'Review not found',
                'flash_type' => 'danger',

            ]);

        }

        try {

            $student->review_status = student::STATUS_APPROVED;
            $student->save();
    
            return redirect()->back()->with([
                'flash_message' => 'Review approved successfully',
                'flash_type' => 'success',
    
            ]);


        } catch(Exception $err) {

            Log::error($err->getMessage());

            return redirect()->back()->with([
                'flash_message' => 'An error occured while approving the review.',
                'flash_type' => 'danger',
    
            ]);



        }


       

    }


    public function declineReview(Student $student)
    {    
        if(!$student) {
            
            return redirect()->back()->with([
                'flash_message' => 'Review not found',
                'flash_type' => 'danger',

            ]);

        }

        try {

            $student->review_status = student::STATUS_DECLINED;
            $student->save();
    
            return redirect()->back()->with([
                'flash_message' => 'Review Declined successfully',
                'flash_type' => 'success',
    
            ]);


        } catch(Exception $err) {

            Log::error($err->getMessage());

            return redirect()->back()->with([
                'flash_message' => 'An error occured while declining the review.',
                'flash_type' => 'danger',
    
            ]);



        }


       

    }

    public function deleteReview(Student $student)
    {
         $student->update([
            'review_status' => Student::STATUS_DELETED,
            'comment' => null,
            'passport' => null,

         ]);


        return redirect()->back()->with([
            'flash_message' => 'Student review deleted successfully',
            'flash_type' => 'success',

        ]);

    }




    

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student,)
    {
          $request->validate([
              'id' => ['required', 'exists:students,id'],
              'firstname' => ['required', 'string', 'max:255'],
              'lastname' => ['required', 'string', 'max:255'],

        ]);

        try {

    

            $student->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,

            ]);

            return redirect()->back()->with([
                'flash_message' => 'Student record updated successfully',
                'flash_type' => 'success'


            ]);

        }catch(Exception $err) {

            log::error($err->getMessage());

            return redirect()->back()->with([
                'flash_message' => $err->getMessage(),
                'flash_type' => 'danger'


            ]);

        }



        
    }


    public function getNewCourseDetails(Request $request, ApplicationService $applicationService) 
    {
        $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        $student = Student::with('courses')->where('app_no', $request->app_no)->first();

        if(!$student) {

            return redirect()->back()->with([
                'flash_message' => 'Invalid Appliction Number!!',
                'flash_type' => 'danger',


            ]);

        }

          // Ensure the student is not already enrolled in the course
       // $alreadyEnrolled = $student->courses()->whereIn('courses.id', (array) $request->course_id)->exists();


        $alreadyEnrolled = $student->courses()->whereIn('courses.id', (array) $request->course_id)->exists();

        if($alreadyEnrolled) {

            return redirect()->back()->with([
                'flash_message' => 'You have already enrolled for this course, kindly select another course',
                'flash_type' => 'danger',
            ]);

        }

        $payments = Payment::with('paymentSchedules')
        ->where('student_id', $student->id)
        ->where('status', Payment::Active)
        ->get();

        if($payments->isEmpty()) {

            return redirect()->back()->with([
                'flash_message' => 'Unable to proceed with your enrollment. Payment not found for your previous enrolled courses',
                'flash_type' => 'danger',
            ]);
        }

         
        $courseIds = $applicationService->getCourseIds($student);

        $paymentSchedules = $applicationService->getPaymentSchedule($courseIds);

        list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedules);


        $paid = $payments->sum('amount');

        $balance = $amountDue - $paid;

        if((int) $balance !==  0) {

            return redirect()->back()->with([
                'flash_message' => 'Unable to proceed with your enrollment. Outstanding payment exists for the courses you are currently enrolled in',
                'flash_type' => 'danger',
            ]);
        }


        try {

            DB::beginTransaction();

             if(is_array($request->course_id)) {

                $student->courses()->attach($request->course_id);

             } else {

                $student->courses()->attach([$request->course_id]);


             }

             // $student = Student::with('courses')->find($std->id);

             $courses = $student->courses;

             $courseNames = $courses->pluck('name')->toArray();
             
            // $student = $applicationService->getStudent($std->id);
        
            try {
  
              Mail::to($student->email)->send(new ApplicationNotification(firstname: $student->firstname, lastname: $student->lastname, email: $student->email,  courses:$student->courses,  id: $student->id, )); 



            } catch(Exception $err) {
                DB::rollBack();
                $emailException = $err->getMessage();

                Log::error($emailException);

                return redirect()->back()->with([
                    'flash_message' => 'critical error occurred  while processing email notification, try again later! or contact  support team',
                    'flash_type' => 'danger'
    
                ]);
            }
           
            DB::commit();

            return redirect()->route('application.message', ['student' => $student->id]);
    

        } catch(Exception $err) {

            DB::rollBack();
            
            Log::error($err->getMessage());

            return redirect()->back()->with([

                'flash_message' => 'Something went wrong while proccessing your registration. Please try again later  or contact support team',
                'flash_type' => 'danger'

            ]);

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
         try{

             $student->delete();

             return redirect()->back()->with([

                'flash_message' => 'Student record deleted successfully',
                'flash_type' => 'success',

             ]);

         } catch(Exception $err) {

            Log::error($err->getMessage());

            return redirect()->back()->with([

                'flash_message' => 'Something went wrong while trying to delete student record',
                'flash_type' => 'danger',

             ]);


         }
    }


    
}
