@php
    $route = 'admin.home-page-services.';
@endphp

<fieldset class="mb-3">
    
    <legend class="text-uppercase font-size-sm font-weight-bold">Update <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <form class="form-validate-jquery" id="content_form" action="{{ route('admin.home-page-services.update', $model->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="icon">Icon <span class="text-danger">*</span></label>
                <img src="{{asset('storage/home-page-content/'. $model->icon)}}" style="width:50px;" alt="Icon">
                <input type="file" name="icon" id="icon" class="form-control dropify">
                <span class="text-danger">Use <code>png</code> Format Icon for Best Speed. Icon Size: <b>60 X 60</b> pixel</span>
            </div>
            <div class="col-md-12 form-group">
                <label for="header">Heaser <span class="text-danger">*</span></label>
                <input type="text" name="header" id="header" class="form-control" placeholder="Enter Header" required value="{{ $model->header }}">
            </div>
            <div class="col-md-12 form-group">
                <label for="content">Content </label>
                <textarea name="content" id="content" cols="30" rows="3" class="form-control">{{ $model->content }}</textarea>
            </div>
            <div class="col-md-12 form-group">
                <label for="sub_content">Sub Content </label>
                <textarea name="sub_content" id="sub_content" cols="30" rows="3" class="form-control">{{ $model->sub_content }}</textarea>
            </div>
            <div class="col-md-6 form-group">
                <label for="button_url">Button URL <span class="text-danger">*</span></label>
                <input type="text" name="button_url" required id="button_url" class="form-control" value="{{ $model->button_url }}">
            </div>
            <div class="col-md-6 form-group">
                <label for="open_another_tab">Open in Another Tab? <span class="text-danger">*</span></label>
                <select name="open_another_tab" id="open_another_tab" class="form-control select" data-placeholder="Select One" required>
                    <option value="">Select One</option>
                    <option {{ $model->open_another_tab == 1 ? 'selected' : '' }} value="1">Yes</option>
                    <option {{ $model->open_another_tab == 0 ? 'selected' : '' }} value="0">No</option>
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

<link rel="stylesheet" href="{{ asset('asset/assets/css/dropify.min.css') }}">
<script src="{{ asset('asset/assets/js/dropify.js') }}"></script>
<script>
    $('.dropify').dropify();
</script>