<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Consultancy :: Mail</title>
</head>
<body>


  <div class="container">
    <div class="card mt-2">
        <div style="background-color: #fc3468;" class="card-header text-white">Consultancy :: Info </div>
        <div class="card-body">
        <p>This is to inform you that a client has submitted the following Consultation Information</p>
        <h6>Name: {{ucfirst(strtolower($name))}}</h6>
        <h6>Email Address: {{ $email }}</h6>
        <h6>Phone Number:  {{$phone_number}} </h6>
        <h6>Service Description: {{ $description }}</h6>
        <p>Kindly treat as urgent</p>
        <p>Thanks</p>
        </div>
    </div>
  </div>
  
</body>
</html>