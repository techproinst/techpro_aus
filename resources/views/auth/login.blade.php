<x-pages-layout>
    <x-slot:title>
      Admin ::Login
    </x-slot:title>
  
    <x-slot:course_title>
      Admin login
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

    </style>


    <div style="margin-bottom:80px" class="container d-flex justify-content-center pt-5">
        <div class="card" style="max-width: 500px; width: 100%;">
            <div class="card-header  text-white text-center">Login :: Page</div>
            <div class="card-body p-4 p-lg-5 text-black">
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="d-flex align-items-center mb-3 pb-1 justify-content-center">
                        <img src="{{ asset('assets/images/logo.png') }} " alt="">
                    </div>
    
                    <div class="form-outline mb-2">
                        <label class="form-label" for="email">Email address</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            class="form-control form-control-lg border-0 shadow-none" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
    
                    <div class="form-outline mb-2">
                        <label class="form-label" for="password">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="form-control form-control-lg border-0 shadow-none" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
    
                    <div class="form-check">
                        <input class="form-check-input" id="remember_me" type="checkbox">
                        <label class="form-check-label" for="remember_me">
                            Remember me
                        </label>
                    </div>
    
                    <div class="mt-4">
                        <button style="background-color: #fc3468;;" class="btn text-white  w-100" type="submit">
                            {{ __('Log in') }}
                        </button> <br>
    
                        @if (Route::has('password.request'))
                            <a class="d-block text-center mt-3 text-decoration-none" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>
    
            </div>
        </div>
    </div>
    
  
   
 
  
  </x-pages-layout>