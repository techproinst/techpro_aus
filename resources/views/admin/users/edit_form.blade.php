
<div class="modal fade text-left modal-borderless" id="edit_form{{ $user->id }}" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit :: User</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form action="{{ url('admin/users/'. $user->id) }}" method="POST">
        @csrf
        @method('PUT')
      
      <div class="modal-body">
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" value="{{ $user->name }}" class="form-control" name="name"  required>
          @error('name')
          <span class="text-danger">
            {{ $message }}
          </span>
            
          @enderror

        </div>
        <div class="form-group">
         <label for="">Email</label>
         <input type="text" value="{{ $user->email }}" class="form-control" name="email"  readonly>

       </div>
       <div class="form-group">
         <label for="">Password</label>
         <input type="text" class="form-control" name="password">
         @error('password')
         <span class="text-danger">
           {{ $message }}
         </span>
           
         @enderror

       </div>
       <div class="form-group">
         <label for="">Roles</label>
         <select name="roles[]" class="form-control"  multiple>
           <option value="">Select Role</option>
           @foreach ($roles as $role )
           <option value="{{ $role }}">{{ $role }}</option>              
           @endforeach
         </select>
         @error('roles')
         <span class="text-danger">
           {{ $message }}
         </span>
           
         @enderror
      
       </div>
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>
        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
          <i class="bx bx-check d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Update</span>
        </button>
      </div>
    </div>
  </div>
</div>

</form>