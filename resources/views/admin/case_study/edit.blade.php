@php
    $route = 'admin.case-study.';
@endphp

<fieldset class="mb-3">
    
    <legend class="text-uppercase font-size-sm font-weight-bold">Update <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <form class="form-validate-jquery" id="content_form" action="{{ route('admin.case-study.update', $model->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="picture">Picture <span class="text-danger">*</span></label>
                <img src="{{asset('storage/home-page-content/'. $model->picture)}}" style="width:50px;" alt="Icon">
                <input type="file" name="picture"  id="picture" class="form-control dropify">
                <span class="text-danger">Use <code>WebP</code> Format Icon for Best Speed. Icon Size: <b>380 X 380</b> pixel</span>
            </div>
            <div class="col-md-12 form-group">
                <label for="alt_tag">Alt Tag <span class="text-danger">*</span></label>
                <input type="text" name="alt_tag" id="alt_tag" class="form-control" placeholder="Enter Alt Tag" required value="{{ $model->alt_tag }}">
            </div>
            <div class="col-md-12 form-group">
                <label for="title">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" required value="{{ $model->title }}">
            </div>
            <div class="col-md-12 form-group">
                <label for="header">Heaser <span class="text-danger">*</span></label>
                <input type="text" name="header" id="header" class="form-control" placeholder="Enter Header" required value="{{ $model->header }}">
            </div>
            <div class="col-md-6 form-group">
                <label for="link">Link </label>
                <input type="text" name="link" id="link" class="form-control" autocomplete="off" placeholder="Enter Link" required value="{{ $model->link }}">
            </div>
            <div class="col-md-6 form-group">
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