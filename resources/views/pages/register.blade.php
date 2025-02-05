<x-pages-layout>
  <x-slot:title>
    Register :: Page
  </x-slot:title>

  <x-slot:link>
    Register
  </x-slot:link>

  <x-slot:course_title>
    Courses
  </x-slot:course_title>
  <x-slot:styles>
    <link rel="stylesheet" href="{{ asset('assets/styles/register.css') }}">
  </x-slot:styles>


  <div class="container">
    <div class="row mt-5">
      <div class="col text-center">
        <h1 id="register" class="title">OUR COURSES</h1>
        <p class="desc-text mt-3">
          Save time by choosing the plan that fits you, opt for a single
          course or the full package for the complete expertise
        </p>
      </div>
    </div>
    <div class="row mt-4 justify-content-center course-wrapper ">
      <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end mb-4 mb-md-0">
        <div class="card me-md-5 shadow-sm index-course-card" style="width: 20rem">
          <div class="container">
            <img src="{{ asset('assets/images/Agency.png') }}" class="card-img-top pt-4" alt="..." />
            <div class="card-body text-center">
              <hr />
              <p>Become a seasoned Business Analyst in 8 weeks</p>
              <p>2 Weekends of virtual Learning with experts</p>
              <p>5 Weeks of Practical Experience</p>
              <p>1 Week of Job Ready Program Guaranteed</p>
              <hr />
              <a class="package-btn" href="{{ route('show.businessAnalysis') }}">Explore Package</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
        <div class="card ms-md-5 shadow-sm index-course-card" style="width: 20rem">
          <div class="container">
            <img src="{{ asset('assets/images/Company.png') }}" class="card-img-top pt-4" alt="..." />
            <div class="card-body text-center">
              <hr />
              <p>Become a certified Professional Scrum Master</p>
              <p>1 weekend of Scrum Master Training</p>
              <p>Scrum Master Certificate Practice</p>
              <p>Access to Scrum Master Certification Dump Questions</p>
              <hr />
              <a class="package-btn" href="{{ route('show.scrumMaster') }}">Explore Package</a>
            </div>
          </div>
        </div>
      </div>
    </div>

   
  </div>

    


</x-pages-layout>