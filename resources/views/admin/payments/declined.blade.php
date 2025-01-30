<x-admin-layout>
  <x-slot:title>
   Declined :: payments
  </x-slot:title>

  <x-slot:header>
    Payments :: Menu
  </x-slot:header>

 

    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
        Declined :: payments
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
              <th>Amount Deposited</th>
              <th>Amount Due</th>
              <th>Payment Receipts</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($payments as $index => $payment )
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ Str::ucfirst(strtolower($payment->student->firstname))}} {{ Str::ucfirst(strtolower($payment->student->lastname))}}</td>
              <td>{{ $payment->invoice }}</td>
              <td>{{ $payment->transaction_reference }}</td>
              <td>{{ $payment->status === -1 ? 'Declined' : '' }}</td>
              @php
                $currencySymbol = $payment->currency === 'usd' ? '$' : '&#8358';
              @endphp
              <td>{!!$currencySymbol!!}{{number_format($payment->amount)}}</td>
              <td>{!!$currencySymbol!!}{{number_format($payment->amount_due)}}</td>
              <td> <a href="{{ asset(
              'upload/'.$payment->payment_receipt) }}" target="_blank"><img  height="60px" src="{{ asset('upload/'.$payment->payment_receipt)  }}" alt="payment receipts"></a> </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>



</x-admin-layout>