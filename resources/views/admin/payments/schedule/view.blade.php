<x-admin-layout>
  <x-slot:title>
    Payment Schedule
  </x-slot:title>

  <x-slot:header>
    Payments Schedule :: Menu
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
          Schedule :: Menu
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Course Name</th>
              <th>Purpose</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($paymentSchedules as  $schedule )
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$schedule->course->name}}</td>
              <td>{{ $schedule->purpose }}</td>
              <td>{{ $schedule->description}}</td>
              @php
                $amounts = json_decode($schedule->amount,true);
              @endphp
              <td> @foreach ($amounts as $key => $amount )

                  @php
                  $currencySymbol =   $key === 'Other' ? '$' : '&#8358;';    
                  @endphp 

                 {{ $key }} :  {!! $currencySymbol !!}{{ number_format($amount) }}  <br>
                
              @endforeach</td>
              <td>
                  @include('admin.payments.schedule.edit_form')
                  {{-- @can('update course-price') --}}
                  <span class="badge bg-success" data-bs-toggle="modal"
                  data-bs-target="#border-less{{ $schedule->id }}">Edit</span> 
                  {{-- @endcan --}}
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>



</x-admin-layout> 