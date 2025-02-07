<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotification;
use App\Mail\PaymentApprovalMail;
use App\Mail\PaymentDeclinedMail;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use App\Services\ApplicationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*
    public function index(Student $student, ApplicationService $applicationService)
    {
      //  dd($student);

        try {

           // $std = $applicationService->getStudent($student->id);

            // Get all courses the student has registered for
            $courseIds = $applicationService->getCourseIds($student);

            // Fetch all payments with related paymentSchedules for the student
                $payments = Payment::with('paymentSchedules')
                ->where('student_id', $student->id)
                ->get();

           // Sum all paid amounts
            $totalPaid = $payments->sum('amount');

            // Get the last `amount_due` value
            $lastAmountDue = $payments->last()?->amount_due ?? 0; // Use null-safe operator

            // Extract unique course IDs from paymentSchedules
            $paidCourses = $payments->pluck('paymentSchedules.*.course_id')
                                    ->flatten()
                                    ->unique()
                                    ->toArray();

                                
            // Remove already paid courses from course list
            $newCourseIds = array_diff($courseIds, $paidCourses);

          //  dd($lastAmountDue);

            // Get only the payment schedules for unpaid courses
            $paymentSchedules = $applicationService->getPaymentSchedule($newCourseIds);
             
             // Calculate the amount due for only the new courses
            list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedules);

          

            return view('payments.view',compact('student', 'amountDue', 'continent'));


        }catch(Exception $err) {


            Log::error($err->getMessage());

            return redirect()->back()->with([
                'flash_message' => 'We could not determine  the payment amount for your location.Please contact support',
                'flash_type' => 'danger'

            ]);



        }






    }
     */
    public function index(Student $student, ApplicationService $applicationService)
    {
             try {
            // Get all courses the student has registered for
            $courseIds = $applicationService->getCourseIds($student);

            // Fetch all payments with related paymentSchedules for the student
            $payments = Payment::with('paymentSchedules')
                ->where('student_id', $student->id)
                ->get();

            // Handle new students with no payments
            if ($payments->isEmpty()) {
                $totalPaid = 0;
                $lastAmountDue = 0;
                $paidCourses = [];
            } else {
                // Sum all paid amounts
                $totalPaid = $payments->sum('amount');

                // Get the last `amount_due` value
                $lastAmountDue = $payments->last()?->amount_due ?? 0;

                // Extract unique course IDs from paymentSchedules
                $paidCourses = $payments->pluck('paymentSchedules.*.course_id')
                                        ->flatten()
                                        ->unique()
                                        ->toArray();
            }

          
          

            // Remove already paid courses from course list
            $newCourseIds = array_diff($courseIds, $paidCourses);

            // Get only the payment schedules for unpaid courses
            $paymentSchedules = $applicationService->getPaymentSchedule($newCourseIds);

            // If no new courses to pay for, set amount due to 0
            if (empty($newCourseIds)) {
                $amountDue = 0;
                $continent = null;
            } else {
                // Calculate the amount due for only the new courses
                list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedules);
            }

            return view('payments.view', compact('student', 'amountDue', 'continent'));

            } catch (Exception $err) {
                Log::error($err->getMessage());

                return redirect()->back()->with([
                    'flash_message' => 'We could not determine the payment amount for your location. Please contact support.',
                    'flash_type' => 'danger'
                ]);
            }
    }


    
    public function showPaymentUpload(Student $student, ApplicationService $applicationService,)
    {
        try {


            $student = $applicationService->getStudent($student->id);
            
            $continent = $applicationService->getLocation();
                                                        
            return view('payments.upload',compact('student', 'continent'));

            
        } catch(Exception $err) {

            Log::error($err->getMessage());

            return redirect()->back()->with([
                'flash_message' => 'Something went wrong while processing your payments. Kindly contact supports.',
                'flash_type' => 'danger'

            ]);

        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    

     public function showNewCourse(Student $student, ApplicationService $applicationService)
     {
            // Get all courses the student has registered for
            $courseIds = $applicationService->getCourseIds($student);

            // Get all courses the student has already completed payment for
            $paidCourses = Payment::with('paymentSchedules')
                ->where('student_id', $student->id)
                ->where('amount', '>=', DB::raw('amount_due'))
                ->get()
                ->pluck('paymentSchedules.*.course_id')
                ->flatten()
                ->unique()
                ->toArray();

            // Remove already paid courses from course list
            $newCourseIds = array_diff($courseIds, $paidCourses);

            // Get only the payment schedules for unpaid courses
            $paymentSchedules = $applicationService->getPaymentSchedule($newCourseIds);

            // Calculate the amount due for only the new courses
            list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedules);

            $std =  $student;


            return view('payments.view', compact('std','amountDue', 'continent'));
     }



    public function store(Request $request, ApplicationService $applicationService)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'payment_receipt' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:1024',
        ]);

        try {
            DB::beginTransaction();

            $student = $applicationService->getStudent($request->student_id);

            // Get all courses the student has registered for
            $courseIds = $applicationService->getCourseIds($student);

            // Get all courses the student has already completed payment for
            $paidCourses = Payment::with('paymentSchedules')
                ->where('student_id', $request->student_id)
                ->where('is_completed', 1)
                ->get()
                ->pluck('paymentSchedules.*.course_id')
                ->flatten()
                ->unique()
                ->toArray();

            // Remove already paid courses from course list
            $newCourseIds = array_diff($courseIds, $paidCourses);


            // Get only the payment schedules for unpaid courses
            $paymentSchedules = $applicationService->getPaymentSchedule($newCourseIds);

            // Calculate the amount due for only the new courses
            list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedules);

            $existingPayment = Payment::where('student_id', $request->student_id)->first();

            $validated['student_id'] = $request->student_id;
            $validated['amount_due'] = $amountDue;
            $validated['transaction_reference'] = Payment::trxRef();
            $validated['invoice'] = $existingPayment ? $existingPayment->invoice : Payment::inv();
            $validated['purpose'] = $paymentSchedules->first()->purpose;
            $validated['currency'] = $continent === 'Other' ? 'usd' : 'naira';

            if ($request->hasFile('payment_receipt')) {
                $receipt = $request->file('payment_receipt');
                $rad = mt_rand(1000, 9999);
                $receiptName = md5($receipt->getClientOriginalName()) . $rad . '.' . $receipt->getClientOriginalExtension();
                $receipt->move(public_path('upload/'), $receiptName);
                $validated['payment_receipt'] = $receiptName;
            }

            $payment = Payment::create($validated);
            $payment->paymentSchedules()->attach($paymentSchedules->pluck('id')->toArray());

            try {
                $admin = User::first();
                Mail::to($admin->email)->send(new AdminNotification($admin->name));
            } catch (Exception $err) {
                DB::rollBack();
                Log::error($err->getMessage());
                return redirect()->back()->with([
                    'flash_message' => 'Critical error occurred while sending email notification.',
                    'flash_type' => 'danger',
                ]);
            }

            DB::commit();
            return view('payments.success');

        } catch (Exception $err) {
            DB::rollBack();
            Log::error("Error processing payment for student ID {$request->student_id}: " . $err->getMessage());

            return redirect()->back()->with([
                'flash_message' => 'Critical error occurred while processing payment upload. Try again later.',
                'flash_type' => 'danger',
            ]);
        }
    }


    public function getPendingPayments()
    {
        $payments = Payment::with('student')->where('status', Payment::Pending)->get();

        return view('admin.payments.pending', compact('payments'));
    }


    public function approve(Request $request, $id, ApplicationService $applicationService) 
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_reference' => ['required', 'string'],
        ]);
    
        try {   
            DB::beginTransaction();
    
            $payment = Payment::with('student')->find($id);
    
            if (!$payment || !$payment->student) {
                return redirect()->back()->with([ 
                    'flash_message' => 'Student or payment record not found',
                    'flash_type' => 'danger'
                ]);
            }
    
            $student = $payment->student;
            $courses = $student->courses;
    
            // Assign an application number if not set
            if (!$student->app_no) {
                $year = date('Y');
                $student->app_no = Student::genAppNo($year);
                $student->save();
            }
    
            // Fetch all payments for this student
            $payments = Payment::with('paymentSchedules')
                                ->where('student_id', $student->id)
                                ->get();
    
            // Get registered courses and payment schedules
            $courseIds = $courses->pluck('id')->toArray();
            $paymentSchedules = $applicationService->getPaymentSchedule($courseIds);
    
            // Get total amount due across all courses
            list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedules);
    
            // Get total amount the student has paid so far
            $totalPaid = $payments->sum('amount') + $request->amount; // ✅ Include new payment
    
            // ✅ Check if payment is completed
            $isCompleted = $totalPaid >= $amountDue;
    
            if ($isCompleted) {
                Payment::where('student_id', $student->id)->update(['is_completed' => 1]); // ✅ Updates all records
            }
    
            // Update payment record
            $payment->update([
                'amount' => $request->amount,
                'payment_reference' => $request->payment_reference,
                'status' => Payment::Active,
            ]);
    
            // ✅ Send email notification only after successful update
            try {
                Mail::to($student->email)->send(new PaymentApprovalMail(
                    $student->firstname,
                    $student->lastname,
                    $student->email,
                    $courses,
                    $student->app_no,
                    $payment->payment_reference,
                    $payment->amount,
                    $payment->currency
                ));
            } catch (Exception $emailException) {
                DB::rollBack();
                Log::error($emailException->getMessage());
    
                return redirect()->back()->with([
                    'flash_message' => 'Error occurred while sending email notification, please try again later or contact support.',
                    'flash_type' => 'danger'
                ]);
            }
    
            DB::commit();
    
            return redirect()->back()->with([
                'flash_message' => 'Payment record updated successfully',
                'flash_type' => 'success'
            ]);
    
        } catch (Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());
    
            return redirect()->back()->with([ 
                'flash_message' => 'An error occurred while updating payment record.',
                'flash_type' => 'danger'
            ]);
        }
    }
    
    


    
    public function decline(Request $request ,)
    {
          $request->validate([
            'id' => ['required', 'exists:payments,id'],
            'comments' => ['required', 'string', 'max:255']

          ]);

       try {

        $payment =  Payment::with('student.course')->find($request->id);

        DB::beginTransaction();

        $payment->update(['status' =>  Payment::Declined]);

        $student = $payment->student;
        $course = $student->course;

                try {

                   Mail::to($student->email)->send(new PaymentDeclinedMail(
                        $student->firstname,
                        $student->lastname,
                        $student->email,
                        $course->name,
                        $request->comments,
                    ));  

                } catch(Exception $emailException) {

                    DB::rollBack();

                    Log::error($emailException->getMessage());

                    return redirect()->back()->with([ 
                        'flash_message' => 'Critical error occured while try to send notification, kindly contact our suuport team or try again later',
                        'flash_type' => 'danger'
                    ]); 

                }

        DB::commit();

        return redirect()->back()->with([ 
            'flash_message' => 'Payment declined successfully',
            'flash_type' => 'success'
        ]); 
        
       } catch(Exception $err) {

        DB::rollBack();

        Log::error($err->getMessage());

        return redirect()->back()->with([ 
            'flash_message' => 'An error occured while try to decline payment, kindly try again later',
            'flash_type' => 'danger'
        ]); 



       }




    }

    public function getActivePayments()
    {
        $payments = Payment::with('student')->where('status', Payment::Active)->whereNotNull('payment_reference')->get();

        return view('admin.payments.active', compact('payments'));
    }


    public function getDeclinedPayments()
    { 
        
        $payments = Payment::with('student')->where('status', Payment::Declined)->whereNull('payment_reference')->get();

        return view('admin.payments.declined', compact('payments'));

    }





    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
