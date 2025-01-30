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
              <th>Ratings</th>
              <th>Status</th>
              <th>comments</th>
              <th>Image</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reviews as $index => $review )
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ Str::ucfirst(strtolower($review->student->firstname))}} {{ Str::ucfirst(strtolower($review->student->lastname))}}</td>
              <td>{{ $review->student->email }}</td>
              <td>{{ $review->ratings }}</td>
              <td>{{ $review->status ===  1 ? 'success' : ''}}</td>
              <td>{{ $review->comments}}</td>
              <td> <a href="{{ asset(
              'upload/'.$review->image) }}" target="_blank"><img  height="60px" src="{{ asset('upload/'.$review->image)  }}" alt="image"></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>



</x-admin-layout>