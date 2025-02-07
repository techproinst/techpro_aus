
<x-pages-layout>
  <x-slot:title>
    Enroll :: New Course
  </x-slot:title>

  <x-slot:link>
    Application
  </x-slot:link>


  <x-slot:course_title>
    New Course
  </x-slot:course_title>

  <x-slot:styles>
    <link rel="stylesheet" href="{{ asset('assets/styles/details.css') }}">
  </x-slot:styles>
  
  <div  class="container">
    
    <div class="row">
      <div class="form-wrapper ">
        <div class="col-lg-6">
            @if (session('flash_message'))
            <div class="alert alert-{{ session('flash_type', 'info') }} alert-dismissible fade show me-5" role="alert">
                {{ session('flash_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>
    </div>
    <div class="row main-details-wrapper">
      <div class="col-lg-6">
        
          <form action="{{ route('newCourse.submit') }}" method="POST">
            @csrf
            <div class="form-group mt-2">
              <label for="newCourse" class="label-name">New Course</label>
              <input  value="{{ Str::upper($course->name) }}" type="text" class="form-control mt-2" readonly>
              <input required name='course_id' value="{{ $course->id}}" type="text" class="form-control mt-2" hidden>
            </div>
            <label for="app_no" class="form-label mt-2 label-name">Enter your Application ID</label>
            <input style="width: 100%" type="text" class="form-control" value="{{ old('app_no') }}" name="app_no"
              placeholder="APP/2024/123456" required>
            <span class="text-danger">
              @error('app_no')
              {{ $message }}
  
              @enderror
            </span>
            <button   type="submit" class="view-btn mt-3">Proceed</button>
          </form>
        

      </div>
    </div>

  </div>
  

  
    


</x-pages-layout>