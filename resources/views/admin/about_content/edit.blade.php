@php
    $route = 'admin.about-content.';
@endphp

<fieldset class="mb-3">
    
    <legend class="text-uppercase font-size-sm font-weight-bold">Update <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <form class="form-validate-jquery" id="content_form" action="{{ route('admin.about-content.update', $model->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="picture">Picture</label>
                <input type="file" name="picture" id="picture" class="form-control dropify" data-default-file="{{ asset('storage/home-page-content/'. $model->picture) }}">
                <span class="text-danger">Use <code>Webp</code> Format image for better output. Image Size: <b>800 X 823</b> pixel</span>
            </div>
            <div class="col-md-12 form-group">
                <label for="alt_tab">Alter Tag </label>
                <input type="text" name="alt_tab" id="alt_tab" class="form-control" required value="{{ $model->alt_tab }}">
            </div>
            <div class="col-md-12 form-group">
                <label for="title">Title </label>
                <input type="text" name="title" id="title" class="form-control" required value="{{ $model->title }}">
            </div>
            <div class="col-md-12 form-group">
                <label for="header">Header </label>
                <input type="text" name="header" id="header" class="form-control" required value="{{ $model->header }}">
            </div>
            <div class="col-md-12 form-group">
                <label for="content">Content </label>
                <textarea name="content" id="content" cols="30" rows="3" class="form-control" >{{ $model->content }}</textarea>
            </div>

            <div class="col-md-4 form-group">
                <label for="button_text">Button Text <span class="text-danger">*</span></label>
                <input type="text" name="button_text" id="button_text" class="form-control" required value="{{ $model->button_text }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="button_url">Button URL <span class="text-danger">*</span></label>
                <input type="text" name="button_url" id="button_url" class="form-control" required value="{{ $model->button_url }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="open_another_tab">Open in Another Tab? </label>
                <select name="open_another_tab" id="open_another_tab" class="form-control select">
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