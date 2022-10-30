<form action="{{ route('submit-booking-form') }}" method="POST" id="content_form">
    @csrf
    <input type="hidden" name="training_id" value="{{ $training->id }}">
    <div class="modal-header">
        <h5 class="modal-title">Book Training</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="fist_name">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" required placeholder="Enter Your First Name">
            </div>
            <div class="col-md-12 form-group">
                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control" required placeholder="Enter Your Last Name">
            </div>
            <div class="col-md-12 form-group">
                <label for="email">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter Your Email Address">
            </div>
            <div class="col-md-12 form-group">
                <label for="phone">Phone Number <span class="text-danger">*</span></label>
                <input type="text" name="phone" id="phone" class="form-control" required placeholder="Enter Your Phone Number">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" style="display: none;" id="submiting" disabled class="btn btn-primary">
            <i class="fa fa-spin fa-spinner fa-fw"></i>
            Submitting
        </button>
        <button type="submit" id="submit" class="btn btn-primary">
            <i class="fa fa-paper-plane fa-fw"></i>
            Submit
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-close fa-fw"></i>
            Close
        </button>
    </div>
</form>