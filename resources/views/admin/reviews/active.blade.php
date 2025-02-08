<x-admin-layout>
  <x-slot:title>
    Reviews
  </x-slot:title>

  <x-slot:header>
    Review :: Menu
  </x-slot:header>

  <div class="row">
    <div class="d-flex justify-content-end align-items-center">
      <div class="col-md-6 col-lg-4">
        @if (session('flash_message'))
        <div class="alert  alert-{{ session('flash_type', 'info') }} alert-dismissible show fade">
          {{ session('flash_message') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>
    </div>
  </div>

  <div class="row">
    @if ($errors->any())
    <div class="d-flex justify-content-end">
      <div class="col-md-6 col-lg-4">
        <div class="alert alert-danger alert-dismissible show fade">
            @foreach ($errors->all() as $error)
            {{ $error }} <br>
            @endforeach
          
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
    @endif

  <div class="row">
  
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          Active :: Reviews
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Status</th>
              <th>comments</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($students as $student )
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ Str::ucfirst(strtolower($student->firstname))}} {{ Str::ucfirst(strtolower($student->lastname))}}</td>
              <td>{{ $student->email }}</td>
              <td>{{ $student->review_status ===  1 ? 'success' : ''}}</td>
              <td>{{ $student->comment}}</td>
              <td> <a href="{{ asset(
              'upload/'.$student->passport) }}" target="_blank"><img  height="60px" src="{{ asset('upload/'.$student->passport)  }}" alt="image"></a></td>
             <td>
              @include('admin.reviews.delete_form')
              <span class="badge bg-danger" data-bs-toggle="modal"
              data-bs-target="#delete{{ $student->id }}" >Delete</span>
            </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>



</x-admin-layout>