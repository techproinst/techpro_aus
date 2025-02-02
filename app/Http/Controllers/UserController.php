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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{


    
    public function __construct()
    {
          $this->middleware('permission:view user',['only' => ['index']]);
          $this->middleware('permission:create user',['only' => ['create', 'store',]]);
          $this->middleware('permission:update user',['only' => ['update', 'edit']]);
          $this->middleware('permission:delete user',['only' => ['destroy']]);
       
    
    }
    /**
     * Display a listing of the resource.
     */
    public function loadDashboard()
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

    public function index()
    { 
        $roles = Role::pluck('name', 'name')->all();
        $users = User::all();

        return view('admin.users.view', compact('users', 'roles'));
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

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
            'roles' => ['required'],

        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        $user->syncRoles($request->roles);

        return redirect()->back()->with([
            'flash_message' => 'User created successfully with Roles',
            'flash_type' => 'success',

        ]);



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
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all(); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'max:20'],
            'roles' => ['required'],

        ]);
         
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)) {

            $data += [
                'password' => Hash::make($request->password),
            ];

        }

        $user->update($data);

        $user->syncRoles($request->roles);

        return redirect()->back()->with([
            'flash_message' => 'User Updated successfully with Roles',
            'flash_type' => 'success',

        ]);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId)
    {
         $user = User::findOrFail($userId);
         $user->delete();

         return redirect()->back()->with([
            'flash_message' => 'User Deleted successfully',
            'flash_type' => 'success',

        ]);

    }
}
