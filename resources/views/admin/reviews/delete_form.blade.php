<form action="{{ route('student.review.delete', ['student' => $student->id]) }}" method="POST">
  @csrf
  @method('DELETE')

  <div class="modal fade text-left modal-borderless" id="delete{{ $student->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete-Review</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button> 
        </div>
        <div class="modal-body">
         <p>Are you sure you want to delete this review : <span class="text-danger">{{ Str::upper(ucfirst($student->comment))}}</span></p>
        </div>
        

        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>
          <button type="submit" class="btn btn-danger ms-1" data-bs-dismiss="modal">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Delete</span>
          </button>
        </div>
      </div>
    </div>
  </div>

</form>