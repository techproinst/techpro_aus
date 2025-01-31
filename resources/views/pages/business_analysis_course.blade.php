<x-pages-layout>
  <x-slot:title>
    Business Analysis Course
  </x-slot:title>

  <x-slot:link>
    Courses
  </x-slot:link>

  <x-slot:course_title>
    Business Analysis
  </x-slot:course_title>

  <div class="container">
    <div class="row mt-4">
      <div class="col text-center mt-1 mt-md-5 ">
        <h1 class="title">Business Analysis</h1>
        <p>Select the course that aligns with  your intrests and goals</p>
      </div>
    </div>

    <div class="row main">
      <div  class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
        <div class="card basic-package-margin" style="width: 20rem; ">
          <div class="container pt-3">
            <img src="{{ asset('assets/images/Single2.png') }}" class="card-img-top" alt="...">
          </div>
          <div class="card-body">  
            @php
            $currencySymbol = $location === 'Other' ? '$' : '&#8358;';            
            @endphp

            <h2>{!!$currencySymbol!!}{{number_format($basicPackage['price'] )}}</h2>
            <hr>
            <ul>
              <li>
                <span class="checkmark">✓</span>Virtual theoretical BA training  sessions
              </li>
              <li>
                <span class="checkmark">✓</span>Practical scenarios and assessments
              </li>
              <li>
                <span class="checkmark">✓</span>Access to BA tools
              </li>
              <li><span class="checkmark">✓</span>Participation in a real life project</li>
              <li>
                <span class="checkmark">✓</span>CV  revamping and interview Preparation support
              </li>
             
            </ul>
            
            <div class="text-center basic-package">
              <hr>
              <a class="enrol-btn" href="{{ route('application.form', ['course' => $basicPackage['course_id']])}}">Enroll Now</a>
            </div>
          
          </div>
        </div>
      </div>
      <div  class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
        <div class="card complete-package-margin" style="width: 20rem;">
          <div class="container pt-3">
            <img src="{{ asset('assets/images/business-analysis.png') }}" class="card-img-top" alt="...">
          </div>
          <div class="card-body">
            <h2>{!!$currencySymbol!!}{{number_format($completePackage['price']) }}</h2>
            <hr>
            <ul>
              <li>
                <span class="checkmark">✓</span>Virtual theoretical BA training  sessions
              </li>
              <li>
                <span class="checkmark">✓</span>Practical scenarios and assessments
              </li>
              <li>
                <span class="checkmark">✓</span>Access to BA tools
              </li>
              <li><span class="checkmark">✓</span>Participation in a real life project</li>
              <li>
                <span class="checkmark">✓</span>CV  revamping and interview Preparation support
              </li>
              <li>
                <span class="checkmark">✓</span>Scrum Master certification training
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
                <span class="checkmark">✓</span>Product Owner exam voucher (Scrum Institute)
              </li>
            </ul>
            <div class="text-center complete_package">
              <hr>
              <a class="complete-package-btn" href="{{ route('application.form', ['course' => $completePackage['course_id']])}}">Enroll Now</a>
            </div>
          
          </div>
        </div>
      </div>
      <div   class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
        <div class="card job-package-margin" style="width: 20rem;">
          <div class="container pt-3">
            <img src="{{ asset('assets/images/Single1.png') }}" class="card-img-top" alt="...">
          </div>
          <div class="card-body">
            <h2>{!!$currencySymbol!!}{{number_format($jobPackage['price']) }}</h2>
            <hr>
            <ul>
              <li>
                <span class="checkmark">✓</span>Virtual theoretical BA training  sessions
              </li>
              <li>
                <span class="checkmark">✓</span>Practical scenarios and assessments
              </li>
              <li>
                <span class="checkmark">✓</span>Access to BA tools
              </li>
              <li><span class="checkmark">✓</span>Participation in a real life project</li>
              <li>
                <span class="checkmark">✓</span>CV  revamping and interview Preparation support
              </li>
             
            </ul>
            <div class="text-center  job-package">
              <hr>
              <a class="enrol-btn" href="{{ route('application.form', ['course' => $jobPackage['course_id']])}}">Enroll Now</a>
            </div>
          
          </div>
        </div>
      </div>
    </div>
  </div>
    


</x-pages-layout>