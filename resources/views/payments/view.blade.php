<x-pages-layout>
  <x-slot:title>
    Payment Page
  </x-slot:title>

  <x-slot:course_title>
    Payment Cart
  </x-slot:course_title>

  <x-slot:styles>
    <link rel="stylesheet" href="{{ asset('assets/styles/payment.css') }}">
  </x-slot:styles>
 

  <div class="container">
    <div class="row mt-5  text-center">
      <div class="col">
        <h4>Select mode of payment</h4>
      </div>
    </div>
    <div class="row text-center mt-2">
      <div class="col">
        <h5 class="full-payment">Full payment</h5>
        <hr class="custom-hr full-hr full-payment" />
      </div>
      <div class="col">
        <h5 class="installment">installmental</h5>
        <hr class="custom-hr installment-hr installmental" />
      </div>
    </div>
     
    <div class="container">
      <div class="row mt-4">
        <div class="d-flex justify-content-center align-items-center">
          <div class="col-md-6">
              @if (session('flash_message'))
              <div class="alert alert-{{ session('flash_type', 'info') }} alert-dismissible fade show" role="alert">
                  {{ session('flash_message') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
          </div>
      </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col">
        <label for="firstname">Firstname</label>
        <input value="{{ $student->firstname }}" class="form-control mt-2"   readonly />
      </div>
      <div class="col">
        <label for="firstname">Lastname</label>
        <input  value="{{ $student->lastname }}" type="text" class="form-control mt-2" placeholder="Last name" aria-label="Last name" readonly />
      </div>
    </div>
    <div class="row  mt-4 mb-4 mb-lg-5 mb-md-4 ">
      <div class="col">
        <label for="firstname">Course</label>
        <input value="{{ $student->course->name }}" type="text" class="form-control mt-2" placeholder="Phone Number" aria-label="First name" readonly />
      </div>
      <div class="col">
        <label for="firstname">Email</label>
        <input  value="{{ $student->email }}" type="text" class="form-control mt-2" placeholder="Email" aria-label="Last name" readonly />
      </div>
    </div>

    <div class="row mb-3 mb-md-4 mb-lg-5 full-time">
      <div class="col-lg-6">
        <div class="d-flex justify-content-between cart-wrapper">
          <div>
            <h5>Course Fee</h5>
            <h5>GST - 10%</h5>
            <h5 class="pt-3">Total Payable Fee</h5>
          </div>
          <div>
            @php
            $gst = $amountDue * 0.1; // GST is 10% of the amount due
            $total = $amountDue + $gst;  
            $currencySymbol =  $continent === 'Other' ? '$' : '&#8358;';       
            @endphp 

             <h5>{!!$currencySymbol!!}{{number_format($amountDue) }}</h5>
             <h5>{!!$currencySymbol!!}{{number_format($gst)}}</h5>
             <h5 class="pt-3">{!!$currencySymbol!!}{{number_format($total)}}</h5> 
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-3 mb-md-4 mb-lg-5 deposit installmental">
      <div class="col">
        <div class="pt-0 pt-md-2 pt-lg-5 deposit text">
          <h5>50% Deposit - Enrol your application ($660)</h5>
          <h5>by depositing 50% to confirm your enrollment</h5>
        </div>

      </div>
      <div class="col-lg-6">
        <div class="d-flex justify-content-between cart-wrapper">
          <div>
            <h5>Course Fee</h5>
            <h5>GST - 10%</h5>
            <h5 class="pt-3">Total Payable Fee</h5>
          </div>
          <div>
            @php
             $fiftyPercent =  $amountDue * 0.5;
             $gst = $amountDue * 0.1;
             $total = $fiftyPercent + $gst;
             $currencySymbol =  $continent === 'Other' ? '$' : '&#8358;'; 
              
            @endphp
            <h5>{!!$currencySymbol!!}{{number_format($fiftyPercent) }}</h5>
            <h5>{!!$currencySymbol!!}{{number_format($gst)}}</h5>
            <h5 class="pt-3">{!!$currencySymbol!!}{{number_format($total)}}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col text-center btn-wrapper">
        <a href="{{ route('payment.show', ['student' => $student->id]) }}"><button type="submit" class="Proceed-btn">Proceed to Payment </button></a>
      </div>
    </div>
  </div>



  <script src="{{ asset('assets/scripts/payment.js') }}"></script>

</x-pages-layout>