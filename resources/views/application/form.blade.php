<x-pages-layout>
  <x-slot:title>
    Application Form
  </x-slot:title>

  <x-slot:link>
    Application
  </x-slot:link>


  <x-slot:course_title>
     Form
  </x-slot:course_title>
  <style>
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

    @media (max-width:965px) {

      .register-btn {
        width: 100%;
      }
    }

    
  
   
  </style>

 
  <div class="container mb-5 mt-4">
    <div class="row">
      <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            @if (session('flash_message'))
            <div class="alert alert-{{ session('flash_type', 'info') }} alert-dismissible fade show" role="alert">
                {{ session('flash_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>
    </div>
    <div class="row">
      <div class="mx-auto col-md-8 col-lg-6 mt-1 mt-md-4 form-margin">

        <div class="card mt-2 shadow-sm">
          <div class="card-header text-white text-center">Application :: Form</div>
          <div class="card-body">
       <form action="{{ route('application.submit') }}" method="POST">
        @csrf   
            <div class="form-group mt-2">
              <label for="firstname">Course</label>
              <input  value="{{ Str::upper($course->name) }}" type="text" class="form-control mt-2" readonly>
              <input required name='course_id' value="{{ $course->id}}" type="text" class="form-control mt-2" hidden>
            </div>
            <div class="form-group mt-2">
              <label for="firstname">Firstname</label>
              <input required name='firstname' value="{{ old('firstname') }}" type="text" class="form-control mt-2">
              @error('firstname')
              <span class="text-danger">
                {{ $message }}
              </span>
                
              @enderror
            </div>
            <div class="form-group mt-2">
              <label for="lastname">Lastname</label>
              <input required name='lastname' value="{{ old('lastname') }}" type="text" class="form-control mt-2">
              @error('lastname')
              <span class="text-danger">
                {{ $message }}
              </span>
                
              @enderror
            </div>
            <div class="form-group mt-2">
              <label for="email">Email</label>
              <input required name='email' type="email" value="{{ old('email') }}" class="form-control mt-2">
              @error('email')
              <span class="text-danger">
                {{ $message }}
              </span>
                
              @enderror
            </div>
            <div class="form-group mt-2">
              <label for="password">Password</label>
              <input required type="password" required id="password" name='password' class="form-control mt-2" value="">
              @error('password')
              <span class="text-danger">
                {{ $message }}
              </span>
                
              @enderror
            </div>
            <div class="form-group mt-2">
              <label for="confirm_password">Confirm Password</label>
              <input required type="password" required id="confirm_password" name='password_confirmation' class="form-control mt-2"
                value="">
                @error('password_confirmation')
              <span class="text-danger">
                {{ $message }}
              </span>
                
              @enderror
            </div>
             
            <button type="submit" class="btn btn-sm register-btn mt-3 float-end"> Register </button>

       </form>
         <p class="pt-2">Already a Registered student. <a href="{{ route('application.newCourse', ['course' => $course->id]) }}">click here</a>
          to apply for new course</p>
          </div>
         
        </div>

      </div>
    </div>

  </div>


</x-pages-layout>