
  <div class="modal fade text-left modal-borderless" id="edit_form{{ $permission->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit :: Permission</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="{{ url('admin/permissions/'. $permission->id) }}" method="POST">
          @csrf
          @method('PUT')
        
        <div class="modal-body">
          <div class="form-group">
            <label for="">Permission Name</label>
            <input type="text" class="form-control" name="name" value="{{  $permission->name  }}" required>

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