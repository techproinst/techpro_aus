<x-pages-layout>
  <x-slot:title>
    Scrum Analysis Course
  </x-slot:title>

  <x-slot:link>
    Courses
  </x-slot:link>


  <x-slot:course_title>
    Scrum Analysis
  </x-slot:course_title>
  <x-slot:styles>
    <link rel="stylesheet" href="{{ asset('assets/styles/scrum-course.css') }}">
  </x-slot:styles>
 

 
  <div class="container">
    <div class="row mt-4">
      <div class="col text-center mt-1 mt-md-5 ">
        <h1 class="title">Scrum Master Certifcation</h1>
        <p>Select the Certificate that aligns with  your intrests and goals</p>
      </div>
    </div>

    <div class="row main scrum-main">
      <div  class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
        <div class="card basic-package-margin start" style="width: 20rem; ">
          <div class="container pt-3">
            <img src="{{ asset('assets/images/basic.png') }}" class="card-img-top" alt="...">
          </div>
          <div class="card-body">
            @php
            $currencySymbol = $location === 'Africa' ? '&#8358;' : '$';            
            @endphp

           <h2>{!!$currencySymbol!!}{{number_format($basicPackage['price'] )}}</h2>
            <hr>
            <ul>
              <li>
                <span class="checkmark">✓</span>Scrum Master certification training
              </li>
              <li>
                <span class="checkmark">✓</span>Practice with Scrum Master past questions
              </li>
              <li>
                <span class="checkmark">✓</span>Scrum Master exam voucher (Scrum Institute)
              </li>

             
             
            </ul>
            
            <div class="text-center basic-package start-btn">
              <hr>
              <a class="enrol-btn" href="{{ route('application.form', ['course' => $basicPackage['course_id']])}}">Enroll Now</a>
            </div>
          
          </div>
        </div>
      </div>
      <div  class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
        <div class="card complete-package-margin middle" style="width: 20rem;">
          <div class="container pt-3">
            <img src="{{ asset('assets/images/complete.png') }}" class="card-img-top" alt="...">
          </div>
          <div class="card-body">
            <h2>{!!$currencySymbol!!}{{number_format($completePackage['price']) }}</h2>
            <hr>
            <ul>
              <li>
                <span class="checkmark">✓</span>Srum Master certification Training
              </li>
              <li>
                <span class="checkmark">✓</span>Practice with Scrum Master past questions 
              </li>
              <li>
                <span class="checkmark">✓</span>Scrum Master exam voucher (Scrum Institute)
              </li>
              <li>
                <span class="checkmark">✓</span>Product Owner Certification Training
              </li>
              <li>
                <span class="checkmark">✓</span>Practice with Product Owner Past Questions
              </li>
              <li>
                <span class="checkmark">✓</span>Product Owner exam voucher (Scrum Institute)
              </li>
            </ul>
            <div class="text-center complete_package middle-btn">
              <hr>
              <a class="complete-package-btn" href="{{ route('application.form', ['course' => $completePackage['course_id']])}}">Enroll Now</a>
            </div>
          
          </div>
        </div>
      </div>
      <div   class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center scrum-main">
        <div class="card job-package-margin last" style="width: 20rem;">
          <div class="container pt-3">
            <img src="{{ asset('assets/images/cerificate.png') }}" class="card-img-top" alt="...">
          </div>
          <div class="card-body">
            <h2>{!!$currencySymbol!!}{{number_format($jobPackage['price']) }}</h2>
            <hr>
            <ul>
              <li>
                <span class="checkmark">✓</span>Product Owner Certification Training
              </li>
              <li>
                <span class="checkmark">✓</span>Practice with Product Owner past question  
              </li>
              <li>
                <span class="checkmark">✓</span> Product Owner exam voucher (Product Institute)
              </li>
             
            </ul>
            <div class="text-center  job-package last-btn">
              <hr>
              <a class="enrol-btn" href="{{ route('application.form', ['course' => $jobPackage['course_id']])}}">Enroll Now</a>
            </div>
          
          </div>
        </div>
      </div>
    </div>
   </div> 
  
  

</x-pages-layout>