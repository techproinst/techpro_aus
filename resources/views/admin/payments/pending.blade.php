<x-admin-layout>
  <x-slot:title>
   Pending :: payments
  </x-slot:title>

  <x-slot:header>
    Payments :: Menu
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
          Pending :: payments
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Fullname</th>
              <th>Invoice</th>
              <th>Transaction Ref</th>
              <th>Status</th>
              <th>Amount Due</th>
              <th>Payment Receipts</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($payments as $index => $payment )
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ Str::ucfirst(strtolower($payment->student->firstname))}} {{ Str::ucfirst(strtolower($payment->student->lastname))}}</td>
              <td>{{ $payment->invoice }}</td>
              <td>{{ $payment->transaction_reference }}</td>
              <td>{{ $payment->status === 0  ? 'Pending' : '' }}</td>
              @php
                $currencySymbol = $payment->currency === 'usd' ? '$' : '&#8358;';

              @endphp
              <td>{!!$currencySymbol!!}{{number_format($payment->amount_due)}}</td>
              <td> <a href="{{ asset(
              'upload/'.$payment->payment_receipt) }}" target="_blank"><img  height="60px" src="{{ asset('upload/'.$payment->payment_receipt)  }}" alt="payment receipts"></a> </td>
              <td>
                 @include('admin.payments.approve_form')
                 @include('admin.payments.decline_form')
                <span class="badge bg-success" data-bs-toggle="modal"
                  data-bs-target="#approve-form{{ $payment->id }}">Approve</span>
                <span class="badge bg-danger" data-bs-toggle="modal"
                data-bs-target="#decline-form{{ $payment->id }}" >Decline</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>



</x-admin-layout>