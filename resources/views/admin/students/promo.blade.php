<x-admin-layout>
  <x-slot:title>
    Promo
  </x-slot:title>

  <x-slot:header>
    Promo :: Menu
  </x-slot:header>

  <div class="row">
    <div class="d-flex justify-content-end align-items-center">
      <div class="col-md-6 col-lg-4">
        @if (session('flash_message'))
        <div class="alert  alert-{{ session('flash_type', 'info') }} alert-dismissible show fade">
          {{ session('flash_message') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>
    </div>
  </div>

  <div class="row">
    @if ($errors->any())
    <div class="d-flex justify-content-end">
      <div class="col-md-6 col-lg-4">
        <div class="alert alert-danger alert-dismissible show fade">
          @foreach ($errors->all() as $error)
          {{ $error }} <br>
          @endforeach

          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          Generate :: Promo Codes
        </h5>
        @role('super-admin')
        <form action="{{ route('promo.create') }}" method="POST">
          @csrf 

          <button type="submit" class="btn btn-outline-primary block">
            Generate
          </button>

        </form>
       
        @endrole

      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Promo Codes</th>
              <th>Status</th>
              <th>Action</th>
           
            </tr>
          </thead>
          <tbody>
            @foreach ($promoCodes as $code)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="promo-code">{{ $code->promo_code }}</td>
                <td>{{ $code->status === 0 ? 'New' : 'Used' }}</td>
                <td>
                    @role('super-admin')
                    <button class="btn btn-primary btn-sm copy-btn" data-code="{{ $code->promo_code }}">Copy</button>
                    <span class="copy-message text-success" style="display: none;">Copied Successfully!</span> {{-- Hidden success message --}}
                    @endrole
                </td>
            </tr>
            @endforeach
        </tbody>
        
        
        </table>
      </div>
    

    </div>
      
    <!--Basic Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1">Permissions</h5>
            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
              <i data-feather="x"></i>
            </button>
          </div>
      <form action="{{ url('admin/roles') }}" method="POST"> 
        @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="">Role Name</label>
              <input type="text" class="form-control" name="name"  required>
  
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Save</span>
            </button>
          </div>
      </form>
        </div>
      </div>
    </div>

  </div>

 

 <script src="{{ asset('assets/scripts/promocode.js') }}"></script>

</x-admin-layout>