<x-admin-layout>
  <x-slot:title>
    Add :: Permission To Role
  </x-slot:title>

  <x-slot:header>
    Permission To Role :: Menu
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
       
        <h5 class="card-title"> Role : {{ $role->name }}</h5>
        <a  href="{{ url('admin/roles') }}" class="btn btn-primary btn-sm float-end">Back</a>
  
      </div>
      <div class="card-body">
        <form action="{{ url('admin/roles/'.$role->id.'/give-permissions') }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            @error('permission')
            <span class="text-danger">
              {{ $message }}
            </span>
              
            @enderror
            <div class="form-group">
              <label for="">Permissions</label>
              <div class="row">
                @foreach ($permissions as  $permission)
                <div class="col-md-2">
                  <label for="">
                    <input 
                    type="checkbox"
                    name="permission[]"
                     value="{{  $permission->name  }}"
                     {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                    >
                    {{ $permission->name }}

                  </label>
                  

                </div>
                @endforeach
              </div>

  
            </div>


            <button type="submit" class="btn btn-primary btn-sm ms-1">
             Update
            </button>
          </div>
          


        </form>
      </div>
    </div>

  </div>



</x-admin-layout>