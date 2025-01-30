<x-pages-layout>
    <x-slot:title>
      Forgot :: Password
    </x-slot:title>
  
    <x-slot:course_title>
      Password Reset
    </x-slot:course_title>

    <style>
        .consultancy-wrapper, .count-wrapper {
            display: none;
        }
            .card .card-header{
        background-color:  #e02d5b;
        height: 45px;

        }

        .card {
        transition: none;
        
        
        }

        .card:hover {
        transform: none;
        box-shadow: none;

        }

        .form-control {
            border: 1px solid #e02d5b;
            border-radius: 0;
        
        }
       .form-control:focus {
            border-color: #fc3468;
            box-shadow: none;
            
            } 

    </style>



<div style="margin-bottom:80px; margin-top:70px;" class="container d-flex justify-content-center">
    <div class="card" style="max-width: 500px; width: 100%;">
        <div  class="card-header text-white text-center">Forgot :: Password</div>
        <div class="card-body p-4 p-lg-5 text-black">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <img src="{{ asset('assets/images/logo.png') }} " alt="">  
                </div>
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="form-outline mb-4 text-center">
                        <label class="form-label" for="email">Email Address</label>
                        <input style=" border: 1px solid #ced4da;" id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="form-control form-control-lg w-75 mx-auto  " style="border-radius: 0; box-shadow: none;" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <button style="background-color: #e02d5b;" type="submit" class="btn w-100 mt-3 text-white"> {{ __('Email Password Reset Link') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>



 
  
   
 
  
  </x-pages-layout>