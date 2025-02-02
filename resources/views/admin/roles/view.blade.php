<x-admin-layout>
  <x-slot:title>
    Role
  </x-slot:title>

  <x-slot:header>
    Role :: Menu
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
          Create :: Roles
        </h5>
        @role('super-admin')
        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#default" data-bs-backdrop="false">
          Add Roles
        </button>
        @endrole

      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Action</th>
           
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as $role )
            <tr>
              <td>{{ $role->id }}</td>
              <td>{{ $role->name }}</td>
              @include('admin.roles.edit_form')
              @include('admin.roles.delete_form')
              <td>
                @role('super-admin')
                <a href="{{ url('admin/roles/'.$role->id.'/give-permissions') }}" class="btn btn-primary btn-sm">Add/Edit Role Permission</a>
                @endrole
                
                @can('update role')
                <span class="badge bg-success" data-bs-toggle="modal"
                data-bs-target="#edit_form{{ $role->id }}">Edit</span>
             
                @endcan

                @can('delete role')
                <span class="badge bg-danger" data-bs-toggle="modal"
                data-bs-target="#delete_form{{ $role->id }}" >Delete</span>
                  
                @endcan
               
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



</x-admin-layout>