@php
    $route = 'admin.service-category.';
@endphp

<fieldset class="mb-3">
    
    <legend class="text-uppercase font-size-sm font-weight-bold">Update <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <form class="form-validate-jquery" id="content_form" action="{{ route('admin.service-category.update', $model->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-lg-12 form-group">
                <label for="name">Category Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Category Name" required value="{{ $model->name }}">
            </div>

            <div class="col-md-12 form-group">
                <label for="status">Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control select" data-placeholder="Select Status" required>
                    <option value="">Select Status</option>
                    <option {{ $model->status == 1 ? 'selected' : '' }} value="1">Active</option>
                    <option {{ $model->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                </select>
            </div>
            <div class="col-md-12 form-group">
                <label for="archive">Archive <span class="text-danger">*</span></label>
                <select name="archive" id="archive" class="form-control select" data-placeholder="Select Archive" required>
                    <option value="">Select Archive</option>
                    <option {{ $model->archive == 1 ? 'selected' : '' }} value="1">Yes</option>
                    <option {{ $model->archive == 0 ? 'selected' : '' }} value="0">No</option>
                </select>
            </div>
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-sm btn-outline-success" id="submit" >{{ _lang('Submit') }}</button>
    
                <button type="button" class="btn btn-sm btn-outline-primary" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
    
                <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal"> {{  _lang('close') }} </button>
            </div>
        </div>
       
    </form>
</fieldset>

@push('admin.scripts')

@endpush