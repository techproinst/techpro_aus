<x-admin-layout>
  <x-slot:title>
    Students
  </x-slot:title>

  <x-slot:header>
    Student :: Menu
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

    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          Registered :: Students
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Email</th>
              <th>Course</th>
              <th>App No</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($students as $index => $student )
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ Str::ucfirst(strtolower($student->firstname))}}</td>
              <td>{{ Str::ucfirst(strtolower($student->lastname))}}</td>
              <td>{{ $student->email }}</td>
              <td>{{ $student->course->name }}</td>
              <td>{{ $student->app_no }}</td>
              <td>
                @include('admin.students.edit_form')
                @include('admin.students.delete_form')
                <span class="badge bg-success" data-bs-toggle="modal"
                  data-bs-target="#border-less{{ $student->id }}">Edit</span>
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