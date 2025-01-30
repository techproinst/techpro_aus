<x-admin-layout>
  <x-slot:title>
    Courses
  </x-slot:title>

  <x-slot:header>
    Courses :: Menu
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
          Registered :: Courses
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Course Name</th>
              <th>Certification</th>
              <th>Course  Code</th>
              <th>Duration</th>
              <th>Syllabus</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($courses as  $index => $course )
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{$course->name}}</td>
              <td>{{$course->certification === 1 ? 'Yes' : 'No'}}</td>
              <td>{{ $course->course_code }}</td>
              <td>{{ $course->duration}}</td>
              @php
                $syllabuses = json_decode($course->syllabus)
              @endphp
              <td> @foreach ($syllabuses as $syllabus )

                {{ $syllabus }} <br>
                
              @endforeach</td>
              <td>
                {{-- @include('admin.students.edit_form')
                @include('admin.students.delete_form') --}}
                <span class="badge bg-success" data-bs-toggle="modal"
                  data-bs-target="#border-less">Edit</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>



</x-admin-layout>