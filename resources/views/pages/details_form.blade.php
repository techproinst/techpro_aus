
<x-pages-layout>
  <x-slot:title>
    Verify :: Details
  </x-slot:title>

  <x-slot:link>
    Application
  </x-slot:link>


  <x-slot:course_title>
    Verify Details
  </x-slot:course_title>

  <x-slot:styles>
    <link rel="stylesheet" href="{{ asset('assets/styles/details.css') }}">
  </x-slot:styles>
  
  <div  class="container">
    
    <div class="row mb-5">
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
        
          <form action="{{ route('details.post') }}" method="POST">
            @csrf
            <label for="app_no" class="form-label mt-2 label-name">Log in with Application ID</label>
            <input style="width: 100%" type="text" class="form-control" value="{{ old('app_no') }}" name="app_no"
              placeholder="APP/2024/123456" required>
            <span class="text-danger">
              @error('app_no')
              {{ $message }}
  
              @enderror
            </span>
            <button   type="submit" class="view-btn mt-3">Submit</button>
          </form>
        

      </div>
    </div>

  </div>
  

  
    


</x-pages-layout>