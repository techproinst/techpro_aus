<!DOCTYPE html>
<html lang="en">
<head>
  @include('pages_include.head')
  <style>

  </style>
</head>
<body>

    @include('pages_include.nav')

    {{ $slot }}
    
    <i class="fa fa-arrow-circle-up fa-3x scroll-icon"></i>
    <section class="consultancy-wrapper consultancy-wrapper-margin">
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
                      <img
                        class="img-fluid frame"
                        src="{{ asset('assets/images/Frame 1618868751.png') }}"
                        alt=""
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div id="contact" class="form-wrapper">
                <h6>Schedule Your</h6>
                <h1 class="free-consult">Free Consultation</h1>
                @include('pages_include.consultancy-form')
               
              </div>
            </div>
          </div>
        </div>
    </section>
  
      <div class="container mt-5 count-wrapper">
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

      @include('pages_include.footer')
  
  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="{{ asset('assets/scripts/shared.js') }}"></script>

  <script>

    </script>  
</body>
</html>