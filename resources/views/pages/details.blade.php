<x-pages-layout>

  <x-slot:title>
    Details :: Page
  </x-slot:title>

  <x-slot:link>
    Details
  </x-slot:link>


  <x-slot:course_title>
    Full Details
  </x-slot:course_title>
  <style>
    
    .card .card-header{
      background-color:  #e02d5b;
      height: 45px;

    }

    .card {
      transition: none;
    
    }

    .card:hover {
      transform: none;
      box-shadow: none;

    }
    .custom-wrapper {
      margin-bottom: 140px;
    }

    @media (max-width:778px) {
        .custom-wrapper {
          margin-bottom: 120px;
        }
    }
  </style>

    
  @if(isset($student))
  <div class="container mt-3 mt-md-5">
    <div class="card">
      <div class="card-header" style="background-color: #e02d5b;">
        <h6 class="card-title text-white ">Student :: Details</h6>
      </div>
      <div class="card-body">
        <div class="row">
           
          <div class="col-md-8">
            <h6>Firstname: <span >{{ Str::ucfirst(((Str::lower($student->firstname)))) }}</span></h6>
            <h6>Lastname: <span >{{Str::ucfirst(Str::lower($student->lastname)) }}</span></h6>
            <h6>Email Address: <span>{{Str::ucfirst(Str::lower($student->email)) }}</span></h6>
            <h6>App No: <span >{{ $student->app_no }}</span></h6>
            <h6>Course: <span >{{Str::ucfirst(Str::lower($student->course->name)) }}</span></h6>
        </div>
        

        </div>
      </div>
    </div>
  </div>

  @endif

  @if(isset($payments))
  <div class="container mt-3 mt-md-5 custom-wrapper">
    <div class="card">
      <div class="card-header" style="background-color: #e02d5b;">
        <h6 class="card-title text-white">Payment :: Details</h6>
      </div>
      <div class="card-body">
        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Invoice</th>
                <th scope="col">Description</th>
                <th scope="col">Payment Reference</th>
                <th scope="col">Receipt</th>
                <th scope="col">Amount Paid</th>
              </tr>
            </thead>
            <tbody>
              @php
               $totalAmount = 0 ;
               $currencySymbol = $currency === 'usd' ? '$' : '&#8358;';
              
              @endphp
              @foreach ($payments as $index => $payment) 
                <tr>
                  <th scope="row">{{ $index + 1 }}</th>
                  <td>{{ date('d/m/y', strtotime($payment->created_at)) }}</td>
                  <td>{{ $payment->invoice }}</td>
                  <td>{{ $payment->description }}</td>
                  <td>{{ $payment->payment_reference }}</td>
                  <td>
                    <a href="{{ asset('upload/' . $payment->payment_receipt) }}" target="_blank">
                      <img class="img-fluid" style="height: 100px;" src="{{ asset('upload/' . $payment->payment_receipt) }}" alt="">
                    </a>
                  </td>
                  <td>{!!$currencySymbol!!}{{number_format($payment->amount) }}</td>
                </tr>
                @php $totalAmount += $payment->amount; @endphp
              @endforeach
              <tr>
                <td colspan="6" class="text-right"><strong>Total Amount Paid</strong></td>
                <td><strong>{!!$currencySymbol!!}{{number_format($totalAmount) }}</strong></td>
              </tr>
              @if( isset($balance) && $balance > 0)
                <tr>
                  <td colspan="6" class="text-right"><strong>Balance Remaining</strong></td>
                  <td><strong>{!!$currencySymbol!!}{{number_format($balance) }}</strong></td>
                </tr>
                <tr>
                  <td colspan="9"><strong><a href="{{ route('outstanding.payment', ['student' => $student->id]) }}">proceed to pay balance</a></strong></td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endif



</x-pages-layout>