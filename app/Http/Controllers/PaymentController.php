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
    public function index(Student $student, ApplicationService $applicationService)
    {
      //  dd($student);

        try {

            $paymentSchedule = $applicationService->getPaymentSchedule($student->course_id);

            list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedule->amount);

          //  dd($continent);

            return view('payments.view',compact('student', 'amountDue', 'continent'));



        }catch(Exception $err) {


            Log::error($err->getMessage());

            return redirect()->back()->with([
                'flash_message' => $err->getMessage(),
                'flash_type' => 'danger'

            ]);



        }






    }

    
    public function showPaymentUpload(Student $student, ApplicationService $applicationService,)
    {
        try {
              

            $continent = $applicationService->getLocation();
                                                        
            return view('payments.upload',compact('student', 'continent'));

            
        } catch(Exception $err) {

            Log::error($err->getMessage());

            return redirect()->back()->with([
                'flash_message' => $err->getMessage(),
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ApplicationService  $applicationService)
    {

        $validated = $request->validate([
            'student_id' => ['required','exists:students,id'],
            'payment_receipt' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:1024',

        ]);

        
        try { 

            DB::beginTransaction();


            $student = $applicationService->getStudent($request->student_id);

            $paymentSchedule = $applicationService->getPaymentSchedule($student->course_id);

            list($amountDue, $continent) = $applicationService->getScheduleAmount($paymentSchedule->amount);

            $existingPayment = Payment::where('student_id', $request->student_id)->first();

        
            $validated['student_id'] = $request->student_id; 
            $validated['amount_due'] = $amountDue;
            $validated['transaction_reference'] = Payment::trxRef();
            $validated['invoice'] = $existingPayment ? $existingPayment->invoice : Payment::inv();
            $validated['purpose'] = $paymentSchedule->purpose;
            $validated['description'] = $paymentSchedule->description;
            $validated['schedule_id'] = $paymentSchedule->id;
            $validated['currency'] = $continent === 'Other' ? 'usd' : 'naira';

        

                if($request->hasFile('payment_receipt')) {

                    $receipt = $request->File('payment_receipt');
                    $rad =  mt_rand(1000, 9999);
            
                    $receiptName =  md5($receipt->getClientOriginalName()) . $rad . '.' . $receipt->getClientOriginalExtension();
            
            
                    $receipt->move(public_path('upload/'), $receiptName);
                    $upload =  $receiptName;
            
                    if ($upload) {
    
                        $validated['payment_receipt'] = $upload;
                    
                    }
                }



                Payment::create($validated);

            try {

                $admin = User::first();
    
                $adminEmail = $admin->email;
                $adminName = $admin->name;
          
            
              Mail::to($adminEmail)->send(new AdminNotification ($adminName));


            }catch(Exception $err) {

                DB::rollBack();

                $emailException = $err->getMessage();

                Log::error($emailException);

                return redirect()->back()->with([
                    'flash_message' => 'critical error occurred  while processing email notification, try again later! or contact  support team',
                    'flash_type' => 'danger'
    
                ]);

            }

            DB::commit();

            return view('payments.success');


        } catch(Exception $err) {

            Log::error("Error processing payment for student ID {$request->id}: " . $err->getMessage());
            
            return redirect()->back()->with([

                'flash_message' => 'Critical error occured while processing payment upload, kindly try again later or contact our support team',
                'flash_type' => 'danger'

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
               'payment_reference' => ['required', 'string',],

              ]);
  
         try {   
            
                  DB::beginTransaction();

                $payment = Payment::with('student.course')->find($id);

                if(!$payment || !$payment->student) {

                    return redirect()->back()->with([ 
                        'flash_message' => 'Student or payment record not found',
                        'flash_type' => 'danger'
                    ]);
        
                }

                $student = $payment->student;
                $course = $student->course;

                if(!$student->app_no) {

                    $year = date('Y');
                    $student->app_no =  Student::genAppNo($year);
   
                    $student->save();

                }

            
                 $payment->update([
                    'amount' => $request->amount,
                    'payment_reference' => $request->payment_reference,
                    'status' => Payment::Active,
                 ]);

               
               try {

              Mail::to($student->email)->send(new PaymentApprovalMail(
                    $student->firstname,
                    $student->lastname,
                    $student->email,
                    $course->name,
                    $student->app_no,
                    $payment->payment_reference,
                    $payment->amount,
                    $payment->currency));

               } catch(Exception $emailException) {

                DB::rollBack();

                Log::error($emailException->getMessage());

                return redirect()->back()->with([
                    'flash_message' => 'Critical error occured while processing email notification, kindly try again later or contact our support team',
                    'flash_type' => 'danger'

                 ]);


               }
                 
                 DB::commit();

                 return redirect()->back()->with([
                    'flash_message' => 'Payment record updated successfully',
                    'flash_type' => 'success'

                 ]);

         }catch(Exception $err) {

            DB::rollBack();

            Log::error($err->getMessage());

            return redirect()->back()->with([ 
                'flash_message' => 'An error occured while updating payment record',
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
