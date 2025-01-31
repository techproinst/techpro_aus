<x-admin-layout>
  <x-slot:title>
    Reviews
  </x-slot:title>

  <x-slot:header>
    Review :: Menu
  </x-slot:header>

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
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>



</x-admin-layout>