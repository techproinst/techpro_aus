<form action="{{ route('approve.reviews', ['studentReview' => $review->id]) }}" method="POST">
  @csrf

  <div class="modal fade text-left modal-borderless" id="approve-form{{ $review->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Appprove :: Review</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <h6>Are you sure you want to approve  <span class="text-success">{{ Str::ucfirst(strtolower($review->student->firstname))}} {{ Str::ucfirst(strtolower($review->student->lastname))}}</span> comment </h6>
          
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