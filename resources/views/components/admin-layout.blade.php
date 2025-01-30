<!DOCTYPE html>
<html lang="en">
@include('admin_includes.head')
<body>
    <script src="{{asset('assets/static/js/initTheme.js')  }}"></script> 
    <div id="app">
        @include('admin_includes.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                  <i class="bi bi-justify fs-3"></i>
                </a>
              </header>
      
              <div class="page-heading">
                <h3>{{$header ?? ''  }}</h3>
              </div>
              <div class="page-content">
                <section class="row">
                  {{ $cards ?? '' }}
                  
                </section>
                <section class="row">
                  {{ $slot }}
                </section>
              </div>

            @include('admin_includes.footer')
        </div>

    </div>
    @include('admin_includes.scripts')
    
</body>
</html>