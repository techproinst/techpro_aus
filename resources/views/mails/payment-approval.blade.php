<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Payment approval :: Mail</title>
</head>
<body>


  <div class="container">
    <div class="card mt-2">
        <div style="background-color: #fc3468;" class="card-header text-white">Application :: Details </div>
        <div class="card-body">
        <p> Congratulations! Your payment to TechPro institute has been successfully approved by our admin team</p>
        <p>The following are your application and payment details:</p>
        <h6>Name: {{ucfirst(strtolower($firstname))}}  {{ ucfirst(strtolower($lastname))}}</h6>
        <h6>Email Address: {{ $email }}</h6>
        <h6>Course applied: </h6>
        <ul>
          @foreach ($courses as $course )
          <li>{{ $course->name }}</li>
            
          @endforeach
        </ul>
        <h6>Application Number: {{ $app_no }}</h6>
        <h6>Payment Reference: {{ $payment_reference }}</h6>
        @php
          $currencySymbol = $currency === 'usd' ? '$' : '&#8358;';
        @endphp
        <h6>Amount Paid:{!!$currencySymbol!!}{{number_format($amount )}}</h6>
        <a href="{{ route('page.details') }}">
          <button style="background-color: #fc3468;" type="button" class="btn text-white">Proceed to verify payments</button>
        </a>
            
        </div>
    </div>
  </div>
  
</body>
</html>