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

    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          Pending :: Reviews
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
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reviews as $index => $review )
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ Str::ucfirst(strtolower($review->student->firstname))}} {{ Str::ucfirst(strtolower($review->student->lastname))}}</td>
              <td>{{ $review->student->email }}</td>
              <td>{{ $review->ratings }}</td>
              <td>{{ $review->status ===  0 ? 'pending' : ''}}</td>
              <td>{{ $review->comments}}</td>
              <td> <a href="{{ asset(
              'upload/'.$review->image) }}" target="_blank"><img  height="60px" src="{{ asset('upload/'.$review->image)  }}" alt="image"></a></td>
              <td>
                @include('admin.reviews.approve_form')
                @include('admin.reviews.decline_form')
        
                <span class="badge bg-success" data-bs-toggle="modal"
                  data-bs-target="#approve-form{{ $review->id }}">Approve</span>
                <span class="badge bg-danger" data-bs-toggle="modal"
                data-bs-target="#decline-form{{ $review->id }}" >Decline</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>



</x-admin-layout>