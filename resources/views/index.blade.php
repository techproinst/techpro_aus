<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <link rel="stylesheet" href="{{ asset('assets/styles/nav.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/styles/index.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/styles/shared.css') }}">
  <script src="{{ asset('assets/scripts/index.js') }}"></script>

  <style>

  </style>


</head>

<body>
  <section class="header">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-2 d-flex align-items-center text-white">
          <i class="bi bi-whatsapp"></i>
          <i class="bi bi-envelope-arrow-down envelope ms-4"></i>
        </div>
        <div class="col-10 text-end text-white align-items-center">
          <h6 class="mb-0">
            <i class="bi bi-telephone"></i> Support : +61405380435 | +
            2348137206269
          </h6>
        </div>
      </div>
    </div>
  </section>
  <nav class="navbar navbar-expand-lg bg-body-white nav-margin">
    <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 mt-2">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Courses
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="{{ route('show.businessAnalysis') }}">Business Analysis</a>
              </li>
              <li>
                <a class="dropdown-item" href="show.scrumMaster">Scrum master</a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Mentorship</a>
          </li>
        </ul>
        <a class="login-btn me-3 mt-2" href="">Log In</a>
        <a class="register-btn mt-2" href="#register">Register Now</a>
      </div>
    </div>
  </nav>
  <div class="container mt-2 mt-md-5">
    <div class="row">
      <div class="">
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
    <div class="row">
      
      <div class="col-12 col-md-6 mb-3">
        <h1 class="intro-text mt-0 mt-md-5">Bridging the Gap to</h1>
        <h1 class="intro-text">Tech Careers</h1>

        <p class="help-text mt-2">
          We help individuals transition into tech by providing expert
          training and real world project experience
        </p>
        <h6 class="webinar-text mt-2 mt-md-5">Register for Webinar</h6>

        <div class="input-container mt-md-3 mt-2">
          <input type="email" placeholder="Enter Your Email..." />
          <button>Register</button>
        </div>
      </div>
      <div class="col-12 col-md-6 text-center text-md-end">
        <img class="img-fluid main-image" src="{{ asset('assets/images/main_image.png') }}" alt="" />
      </div>
    </div>
    <div class="row">
      <div class="col text-center">
        <p class="mt-5">
          <img class="img-tick" src="{{ asset('assets/images/tick-circle.png') }}" alt="" />Discover
          the perfect course for you by taking our personality test.
          <span><a class="test" href="quiz.html">Take a test</a> </span>
        </p>
      </div>
    </div>
  </div>
  <section class="partners-wrapper">
    <div class="container">
      <div class="row mt-4">
        <div class="col text-center pt-5">
          <h5 class="talent-text">Our Talents Work With Leading Companies</h5>
        </div>
        <div class="row pb-5 pt-1">
          <div class="col text-center">
            <a href=""><img src="{{ asset('assets/images/Brand.png') }}" alt="" /></a>
          </div>
          <div class="col text-center">
            <a href=""><img src="{{ asset('assets/images/Brand2.png') }}" alt="" /></a>
          </div>
          <div class="col text-center">
            <a href=""><img src="{{ asset('assets/images/Frame 863.png') }}" alt="" /></a>
          </div>
          <div class="col text-center">
            <a href=""><img src="{{ asset('assets/images/Brand3.png') }}" alt="" /></a>
          </div>
          <div class="col text-center">
            <a href=""><img src="{{ asset('assets/images/Brand4.png') }}" alt="" /></a>
          </div>
        </div>
      </div>
    </div>
  </section>

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
    <div class="row mt-4 justify-content-center">
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

    <div class="row mt-5">
      <div class="col text-center">
        <h1 class="title mt-5">Why Train With Techpro</h1>
        <p class="desc-text">
          Unlock Your Tech Potential with Expert Guidance and Real World
          Project Experience
        </p>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-sm-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
        <div class="card shadow-sm feauture-card" style="width: 20rem">
          <div class="number-wrapper">01</div>
          <div class="card-body">
            <h5 class="card-title feature-title">Real-Life Project</h5>
            <p class="desc-text">
              We provide students with real-life project opportunities,
              building hands-on experience, skills, and confidence for a
              competitive edge in the job market.
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
        <div class="card shadow-sm feauture-card" style="width: 20rem">
          <div class="number-wrapper">02</div>
          <div class="card-body">
            <h5 class="card-title feature-title">Cross-functional team</h5>
            <p class="desc-text">
              Students work in teams on real projects, gaining collaboration,
              communication, and stakeholder management skills valued by tech
              employers.
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
        <div class="card shadow-sm feauture-card" style="width: 20rem">
          <div class="number-wrapper">03</div>
          <div class="card-body">
            <h5 class="card-title feature-title">
              Local industry experience
            </h5>
            <p class="desc-text">
              We leverage local tech market expertise and industry connections
              to help students navigate the job market, secure opportunities,
              and build lasting networks.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="team-wrapper mt-5">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h1 class="title pt-5">We Have Expert Team</h1>
          <p class="desc-text">Meet our expert management team members</p>
        </div>
      </div>
      <div class="row pt-4">
        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
          <div class="card team-card" style="width: 18rem">
            <img src="{{ asset('assets/images/WhatsApp Image 2025-01-29 at 04.56.06_1e3963c1.jpg') }}"
              class="card-img-top img-team" alt="..." />
            <div class="card-body">
              <div class="social-wrapper">
                <h5 class="card-title">Kabir Akinola</h5>
                <div class="social-icons">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <p class="desc-text">Senior Business Analyst / Mentor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
          <div class="card team-card" style="width: 18rem">
            <img src="{{ asset('assets/images/aisha.jpg') }}" class="card-img-top img-team aisha" alt="..." />
            <div class="card-body">
              <div class="social-wrapper ">
                <h5 class="card-title">Aisha Olayiwola</h5>
                <div class="social-icons">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <p class="desc-text">Business Analyst Lead / Mentor</p>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
          <div class="card team-card" style="width: 18rem">
            <img src="{{ asset('assets/images/MIB[1].jpg') }}" class="card-img-top img-team" alt="..." />
            <div class="card-body">
              <div class="social-wrapper">
                <h5 class="card-title">Dr, Olukomaiya</h5>
                <div class="social-icons">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <p class="desc-text">Senior Reporting Officer / Mentor</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div
          class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between">
          <h2 class="title-testimonial text-center text-md-start">
            What Customers Are <br />Saying About Us
          </h2>
          <div class="nav-buttons-wrapper d-flex justify-content-center mb-2 mb-md-0 mt-3 mt-md-0 me-0 me-md-5">
            <button class="nav-button prev swiper-button-next me-2">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M15 19l-7-7 7-7"></path>
              </svg>
            </button>
            <button class="nav-button next swiper-button-prev">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 5l7 7-7 7"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
     
    </div>

    <div class="row">
     
      <div class="col">
       
        <div class="title-testimonial text-center text-md-start mt-5 mt-md-0">
            <button class="review-btn"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Leave a review</button>
        </div>
        
      </div>
    </div>

    <div class="row mt-4">
      <div class="col">
        <div class="swiper">
          <div class="swiper-wrapper">
            @foreach ($students as $student )
            <div class="swiper-slide testimonial-card">
              <div class="card shadow-sm mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ asset('upload/'. $student->passport) }}"
                      class="img-fluid rounded-start testimonial-image" alt="..." />
                  </div>
                  <div class="col-md-8">
                    <div class="card-body testimonial">
                      <p class="card-title quote-mark">"</p>
                      <p class="card-text comment">
                       {{ $student->comment }}
                      </p>
                      <p class="card-text author">{{Str::ucfirst(Str::lower($student->firstname))}} {{ Str::ucfirst(Str::lower($student->lastname)) }}</p>
                      <p class="card-text role">
                        <small class="text-body-secondary">Student</small>
                      </p>
                      <p class="card-text author">{{ $student->country }}</p>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
              
            @endforeach

            {{-- <div class="swiper-slide testimonial-card">
              <div class="card shadow-sm mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ asset('assets/images/Rectangle 8.png') }}"
                      class="img-fluid rounded-start testimonial-image" alt="..." />
                  </div>
                  <div class="col-md-8">
                    <div class="card-body testimonial">
                      <p class="card-title quote-mark">"</p>
                      <p class="card-text comment">
                        Tech Pro's course taught me practical skills that I
                        could apply immediately. The projects were challenging
                        but rewarding
                      </p>
                      <p class="card-text author">Michael Smith</p>
                      <p class="card-text role">
                        <small class="text-body-secondary">Student</small>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide testimonial-card">
              <div class="card shadow-sm mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ asset('assets/images/Rectangle 7.png') }}" class="img-fluid rounded-start h-100"
                      alt="..." />
                  </div>
                  <div class="col-md-8">
                    <div class="card-body testimonial">
                      <p class="card-title quote-mark">"</p>
                      <p class="card-text comment">
                        Tech Pro's course taught me practical skills that I
                        could apply immediately. The projects were challenging
                        but rewarding
                      </p>
                      <p class="card-text author">Michael Smith</p>
                      <p class="card-text role">
                        <small class="text-body-secondary">Student</small>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide testimonial-card">
              <div class="card shadow-sm mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ asset('assets/images/Rectangle 8.png') }}" class="img-fluid rounded-start h-100"
                      alt="..." />
                  </div>
                  <div class="col-md-8">
                    <div class="card-body testimonial">
                      <p class="card-title quote-mark">"</p>
                      <p class="card-text comment">
                        Tech Pro's course taught me practical skills that I
                        could apply immediately. The projects were challenging
                        but rewarding
                      </p>
                      <p class="card-text author">Michael Smith</p>
                      <p class="card-text role">
                        <small class="text-body-secondary">Student</small>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide testimonial-card">
              <div class="card shadow-sm mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ asset('assets/images/Rectangle 7.png') }}" class="img-fluid rounded-start h-100"
                      alt="..." />
                  </div>
                  <div class="col-md-8">
                    <div class="card-body testimonial">
                      <p class="card-title quote-mark">"</p>
                      <p class="card-text comment">
                        Tech Pro's course taught me practical skills that I
                        could apply immediately. The projects were challenging
                        but rewarding
                      </p>
                      <p class="card-text author">Michael Smith</p>
                      <p class="card-text role">
                        <small class="text-body-secondary">Student</small>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}


          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
  <section class="consultancy-wrapper mt-5">
    <div class="container">
      <div class="row pt-5">
        <div class="col-lg-7">
          <div class="free-text text-white">
            <h1 class="free-content">Get a Free, Personalized</h1>
            <h1 class="free-content">1-on-1 Career Guidance</h1>
            <h1 class="free-content">Session Today"</h1>
            <p class="schedule-text">
              Schedule a free consultation to explore your transition into
              tech.
            </p>
            <p class="fill-text">
              Fill out the form, and our career experts will contact you
            </p>
          </div>
          <div class="row mt-4 mb-5">
            <div class="col">
              <div>
                <img class="consult-img" src="{{ asset('assets/images/image7.png') }}" alt="" />
              </div>
            </div>
            <div class="col">
              <div class="book-wrapper">
                <h1 class="book-text">Book a</h1>
                <h1 class="book-text">Consultation</h1>
                <h1 class="book-text">Today</h1>
                <div class="d-flex justify-content-end">
                  <img class="img-fluid frame" src="{{ asset('assets/images/Frame 1618868751.png') }}" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div id="contact" class="form-wrapper">
            <h6>Schedule Your</h6>
            <h1 class="free-consult">Free Consultation</h1>
            <form action="">
              <div class="mt-4 mt-md-5">
                <input type="text" class="form-control" id="legal" placeholder="Legal Name" />
              </div>
              <div class="mt-4 mt-md-5">
                <input type="email" class="form-control" id="email" placeholder="Email" />
              </div>
              <div class="mt-4 mt-md-5">
                <input type="text" class="form-control" id="phone" placeholder="Phone Number" />
              </div>
              <textarea class="form-control mt-4 mt-md-5 mb-4" id="textarea" rows="3"
                placeholder="Service Description"></textarea>
              <input class="submit-btn" type="submit" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container mt-5">
    <div class="row pt-2">
      <div class="col-md-6 col-lg-3">
        <div class="score text-center">
          <h1>5000+</h1>
          <p>Global Reach</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="score text-center">
          <h1>99%</h1>
          <p>Success Rate</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="score text-center">
          <h1>9.8/10</h1>
          <p>Student Satisfaction</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="score text-center">
          <h1>2000+</h1>
          <p>Career Impact</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Leave a review</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('submit.feedback') }}" method="POST" enctype="multipart/form-data">
          @csrf  
              <div class="form-group mt-2">
                <label for="firstname">Application Number</label>
                <input required name='app_no' value="{{ old('app_no') }}" type="text" class="form-control mt-2">
                @error('app_no')
                <span class="text-danger">
                  {{ $message }}
                </span>
                  
                @enderror
              </div>
              
            
              <div class="mb-3 mt-3">
                <label for="formFile" class="form-label">Upload Image</label>
                <input class="form-control" name="passport" type="file" id="formFile">
              </div>

              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Comments</label>
                <textarea class="form-control" name="comment" rows="3">{{ old('comment') }}</textarea>
                @error('comment')
                <span class="text-danger">
                  {{ $message }}
                </span>
                  
                @enderror
              </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      
     </form>
    </div>
  </div>
</div>

  <footer class="footer mt-4">
    <div class="container">
      <div class="row">
        <div class="col text-center mt-3">
          <img src="{{ asset('assets/images/image 1.png') }}" alt="">
        </div>
      </div>
      <div class="row">
        <div class="col text-center text-white mb-5 mt-2">
          <h5 class="footer-text">
            We bridge the gap in the tech industry, helping candidates transition into tech, even without prior
            experience, through expert training and hands-on real-life projects.
          </h5>
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex flex-wrap justify-content-center footer-links">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Membership</a></li>
            <li><a href="#">Business Analysis</a></li>
            <li><a href="#">Scrum Master</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Terms & Conditions</a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex flex-wrap justify-content-center footer-links2">
          <ul>
            <li class="me-5"><a href="#">Refund Policy</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex flex-wrap justify-content-center footer-icons">
          <a href="#"><i class="bi bi-twitter"></i></a>
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
      <div class="row pt-4">
        <div class="col text-center certification">
          <a href="#">Certification</a>
        </div>
      </div>
      <div class="row pt-4">
        <div class="col text-center text-white">
          <p>© Copyright 2025 TechPro. All rights reserved</p>
        </div>
      </div>
    </div>
  </footer>




  <script>
    const swiper = new Swiper(".swiper", {
        slidesPerView: 3,
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
        },
      });

    

  </script>
</body>

</html>