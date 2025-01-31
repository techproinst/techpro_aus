<form action="{{ route('schedule.update', ['schedule' => $schedule->id]) }}" method="POST">
  @csrf

  <div class="modal fade text-left modal-borderless" id="border-less{{ $schedule->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit-Payment Schedule</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control"  value="{{ $schedule->course->name }}" readonly>

          </div>
         @php
        $amounts = json_decode($schedule->amount,true);
        @endphp
      
          <div class="form-group">
            <label for="amount">Amount For Other Countries</label>
             <input type="number" class="form-control" name="amount_other" value="{{ $amounts['Other'] }}" required>
          </div>

          <div class="form-group">
            <label for="amount">Amount For African Countries</label>
             <input type="number" class="form-control" name="amount_africa" value="{{ $amounts['Africa'] }}" required>
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