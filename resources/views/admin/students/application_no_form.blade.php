<form action="{{ route('students.gen.application_no', ['student' => $student->id]) }}" method="POST">
  @csrf

  <div class="modal fade text-left modal-borderless" id="app-no-form{{ $student->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Generate :: Application Number</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <h6>Are you sure you want to generate Application Number for this students : <span class="text-success">{{ Str::ucfirst(strtolower($student->firstname))}} {{ Str::ucfirst(strtolower($student->lastname))}}</span></h6>
          
        </div>
       

        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>
          <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Yes</span>
          </button>
        </div>
      </div>
    </div>
  </div>

</form>