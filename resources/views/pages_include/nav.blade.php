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
    <a class="navbar-brand" href="{{ route('index') }}"
      ><img src="{{ asset('assets/images/logo.png') }} " alt=""></a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 mt-2">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('index') }}"
            >Home</a
          >
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Courses
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('show.businessAnalysis') }}"
                >Business Analysis</a
              >
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('show.scrumMaster') }}"
                >Scrum master</a
              >
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
      <a class="register-btn mt-2" href="">Register Now</a>
    </div>
  </div>
</nav>
<section  class="breadcrumb">
<div class="container">
  <div class="row">
    <div class="col">
      <div class="pt-3">
        <i class="fa-solid fa-house house-icon pe-2">
        </i><span class="text-white">></span>
        <a class="course-link" href="">Courses</a>
        <span class="text-white">></span>
        <span class="business-text">{{ $course_title ?? '' }}</span>

      </div>
    </div>
  </div>
  
    

  
</div>
</section>