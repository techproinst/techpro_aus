<form action="{{ route('student.update', ['student' => $student->id]) }}" method="POST">
  @csrf

  <div class="modal fade text-left modal-borderless" id="border-less{{ $student->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit-Student</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="firstname">Firstname</label>
            <input type="text" class="form-control" name="firstname" value="{{ $student->firstname }}" required>

          </div>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="firstname">lastname</label>
            <input type="text" class="form-control" name="lastname" value="{{ $student->lastname }}" required>
            <input type="text" class="form-control" name="id" value="{{ $student->id}}" hidden>
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