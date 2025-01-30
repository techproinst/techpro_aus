<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Application :: Mail</title>
</head>
<body>


  <div class="container">
    <div class="card mt-2">
        <div style="background-color: #fc3468;" class="card-header text-white">
            Application :: Details
        </div>
        <div class="card-body">
            
                <p>Your application to TechPro Institute has been successfully completed</p>
                <p>The following are your application details:</p>
                <h6>Name: {{ ucfirst(strtolower($firstname)) }} {{ ucfirst(strtolower($lastname)) }}</h6>
                <h6>Email Address: {{ $email }}</h6>
                <h6>Course applied: {{ $course }}</h6>
                
    
            <a href="{{ route('payment', ['student' => $id]) }}">
              <button style="background-color:  #fc3468; color:white" type="button" class="btn">proceed to make payments</button>
            </a>
            
        </div>
    </div>
</div>

  
</body>
</html>