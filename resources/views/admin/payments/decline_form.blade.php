<form action="{{ route('payment.decline') }}" method="POST">
  @csrf

  <div class="modal fade text-left modal-borderless" id="decline-form{{ $payment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Decline :: Payment</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to Decline payment made by <span class="text-danger" > {{ ucfirst(strtolower($payment->student->firstname)) }} {{ ucfirst(strtolower($payment->student->lastname))  }} </span>

          <input name="id" value="{{ $payment->id }}" type="text" hidden>

          <div class="form-floating mt-3">
            <textarea name="comments" class="form-control" placeholder="Leave a comment here"
                id="floatingTextarea" required></textarea>
            <label for="floatingTextarea">Comments</label>
        </div>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>
          <button type="submit" class="btn btn-danger ms-1" data-bs-dismiss="modal">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Decline</span>
          </button>
        </div>
      </div>
    </div>
  </div>

</form>