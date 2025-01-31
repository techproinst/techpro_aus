<?php

namespace App\Http\Controllers;

use App\Mail\ConsultancyNotification;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentReview;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $students = Student::count();
        $payments = Payment::Where('status', Payment::Active)->count();
        $courses = Course::count();
        $users = User::count();

        return view('admin.dashboard', compact('students','payments','courses','users'));
    }


    public function submitConsultancyForm(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string', 'max:255'],
            'email' => ['required', 'email', 'string'],
            'phone_number' => ['required', 'regex:/^(080|091|090|070|081)[0-9]{8}$/'],
            'description'  => [ 'required','string'],

        ]);


        try {

          $admin = User::first();

          Mail::to($admin->email)->send(new ConsultancyNotification($request->name, $request->email, $request->phone_number, $request->description));


        }catch(Exception $err) {

         $emailException = $err->getMessage();

         Log::error($emailException);

            return redirect()->back()->with([
                'flash_message' => 'Critical error occured while trying to send notification, Please try again later or contact our support team',
                'flash_type' => 'danger',
    
            ]);


        }


        return redirect()->back()->with([
            'flash_message' => 'Your Consultation Info has been submitted successfully',
            'flash_type' => 'success',

        ]);




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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
