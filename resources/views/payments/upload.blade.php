
<x-pages-layout>
  <x-slot:title>
    Payment Upload Page
  </x-slot:title>

  <x-slot:link>
    Payment Upload
  </x-slot:link>


  <x-slot:course_title>
     Cart
  </x-slot:course_title>
  <x-slot:styles>
    <link rel="stylesheet" href="{{ asset('assets/styles/upload.css') }}">
  </x-slot:styles>

  <style>
     .card {
      transition: none;
    
      
    }

    .card:hover {
      transform: none;
      box-shadow: none;

    }
 
  </style>


  <div class="container mt-5">
    <div class="row mt-4">
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
      <div class="mx-auto col-md-8 col-lg-6 ">
        <div class="card mt-2 shadow-sm mt-0 mt-md-2 cart-margin">
          <div
            style="background-color: #e02d5b;"
            class="card-header text-white text-center"
          >
            Payment :: Details
          </div>
          <div class="card-body">
            <h6 class="">Please pay to the below account details</h6>
            <p><strong>Account Number:</strong> 0123410346</p>
            <p><strong>Account Name:</strong> Tech Pro Consulting</p>
            <p><strong>Bank Name:</strong> Comm Bank</p>
            <h6 class=""><strong>Full Name:</strong> {{Str::ucfirst(Str::lower($student->firstname) )}} {{Str::upper(Str::lower( $student->lastname) ) }}</h6>
            <h6 class=""><strong>Email:</strong> {{Str::ucfirst(Str::lower( $student->email) ) }}</h6>
            @php
              $course = $student->courses->first();
            @endphp
            <h6 class=""><strong>Course:</strong> {{Str::ucfirst(Str::lower( $course->name) ) }}</h6>
            <form action="{{ route('payment.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="formFile" class="form-label">Upload Evidence of Payment</label>
                <input class="form-control" type="file" name="payment_receipt">
                <input value="{{$student->id }}" type="text" name="student_id" hidden>
                <input value="{{ $continent }}" name="continent" type="text" hidden>
                @error('payment_receipt')
                <span class="text-danger">
                  {{ $message }}

                </span>
                  
                @enderror

                @error('student_id')
                <span class="text-danger">
                  {{ $message }}

                </span>
                  
                @enderror
              </div>

              <button type="submit" class="upload-btn float-end">Proceed</button>

            </form>
           

          </div>
        </div>
      </div>
    </div>
  </div>


 





</x-pages-layout>