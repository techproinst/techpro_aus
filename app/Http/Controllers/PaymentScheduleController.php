<?php

namespace App\Http\Controllers;

use App\Models\PaymentSchedule;
use Illuminate\Http\Request;

class PaymentScheduleController extends Controller
{

    public function __construct()
    {
       // $this->middleware('permission:update course-price', ['only' => 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentSchedules = PaymentSchedule::with('course')->get();

        return view('admin.payments.schedule.view', compact('paymentSchedules'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentSchedule $paymentSchedules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentSchedule $paymentSchedules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentSchedule $schedule)
    {
      $validated = $request->validate([
            'amount_other' => ['required', 'numeric', 'min:0'],
            'amount_africa' => ['required', 'numeric', 'min:0'],

        ]);


       

        $amounts = json_decode($schedule->amount, true);

        $amounts['Other'] = $validated['amount_other'];
        $amounts['Africa'] = $validated['amount_africa'];

        $schedule->amount = json_encode($amounts);

        $schedule->save();


        return redirect()->back()->with([
            'flash_message' => 'Payment Schedule has been updated successfully',
            'flash_type' => 'success',

        ]);




    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentSchedule $paymentSchedules)
    {
        //
    }
}
