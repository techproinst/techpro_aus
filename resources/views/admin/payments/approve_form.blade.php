<form action="{{ route('payment.approve', ['id' => $payment->id]) }}" method="POST">
  @csrf

  <div class="modal fade text-left modal-borderless" id="approve-form{{ $payment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Appprove :: Payment</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="firstname">Amount Paid</label>
            <input type="number" class="form-control" name="amount" value="" required>
            <input type="number" class="form-control" name="amount_due" value="{{$payment->amount_due}}" hidden>

          </div>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="firstname">Payment Reference</label>
            <input type="text" class="form-control" name="payment_reference" value="" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>
          <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Aprove</span>
          </button>
        </div>
      </div>
    </div>
  </div>

</form>