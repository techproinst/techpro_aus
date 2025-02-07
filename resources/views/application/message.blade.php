<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
  <title>Application :: Completed</title>
</head>
<body>


  <div class="container mt-5">
    <div class="row">
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
    
    <div class="card mt-2">
        <div style="background-color:  #fc3468;;" class="card-header  text-white">Application :: Details </div>
        <div class="card-body">

          <p>Hi {{ ucfirst(strtolower($student->firstname))}} {{ $student->lastname }} you have registered succesfully</p>
          <p>Your application details have been sent to your email</p>

  
            <a href="{{ route('payment', ['student' => $student->id]) }}">
              <button style="background-color:  #fc3468; color:white" type="button" class="btn">proceed to make payments</button>
            </a>
              
    

          
        </div>
    </div>
  </div>
  
</body>
</html>