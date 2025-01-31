<form action="{{ route('consultancy') }}" method="POST">
  @csrf
  <div class="mt-4 mt-md-5">
    <input type="text" name="name" class="form-control" id="legal" placeholder="Legal Name" />
  </div>
  <div class="mt-4 mt-md-5">
    <input type="email" name="email" class="form-control" id="email" placeholder="Email" />
  </div>
  <div class="mt-4 mt-md-5">
    <input type="text" name="phone_number" class="form-control" id="phone" placeholder="Phone Number" />
  </div>
  <textarea name="description" class="form-control mt-4 mt-md-5 mb-4" id="textarea" rows="3" placeholder="Service Description"></textarea>
  <input class="submit-btn" type="submit" />
</form>