<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\ApplicationNotification;
use App\Models\Payment;
use App\Models\PaymentSchedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('course')->get();

        return view('admin.students.view',compact('students'));

    
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
            'email' => ['required', 'string', 'email', 'unique:students'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'password_confirmation' => ['required',],
        ]);

        
        $validated['password'] = Hash::make($request->input('password'));
        unset($validated['password_confirmation']);

        try {

            DB::beginTransaction();

             $std = Student::create($validated);

             $student = $applicationService->getStudent($std->id);

            try {

               Mail::to($student->email)->send(new ApplicationNotification($student->firstname, $student->lastname, $student->email, $student->course->name,  $student->id, $student->course->id)); 


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

            return view('application.message', compact('student'));


        } catch(Exception $err) {

            DB::rollBack();
            
            Log::error($err->getMessage());

            return redirect()->back()->with([

                'flash_message' => 'Something went wrong while proccessing your registration. Please try again later  or contact support team',
                'flash_type' => 'danger'

            ]);

        }





    }


    public function showDetails(Request $request) 
    {
          $student = Student::with('course')->where('app_no', $request->app_no)->first();

          if(!$student) {

            return redirect()->back()->with([
                'flash_message' => 'Invalid application number',
                'flash_type' => 'danger'

            ]);

          }

          $payments = Payment::with('paymentSchedule')
                              ->where('student_id', $student->id)
                              ->where('status', Payment::Active)
                              ->get();

         if($payments->isEmpty()) {

            return view('pages.application.details', compact('student'));
         }

        $scheduleId = $student->course_id;

        $schedule = PaymentSchedule::where('course_id', $scheduleId)->first();

        $amountDue = json_decode($schedule->amount);

    

        $currency = $payments->first()->currency;

        $amountScheduled =  $currency === 'usd' ? $amountDue->Other : $amountDue->Africa;

        $paid = $payments->sum('amount');

        $balance = $amountScheduled - $paid;

    

            /*
                    $currency = [];

                    $amountDue = json_decode($schedule->amount);

                    $paid = 0;

                    foreach ($payments as $index => $payment) {

                        $currency[] = $payment->currency;  
                        $paid += $payment->amount;

                    }

                    $amountScheduled = $currency[0] === 'usd' ? $amountDue->other : $amountDue->africa;

                    $balance = $amountScheduled - $paid;


                    return $balance;
            */
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
