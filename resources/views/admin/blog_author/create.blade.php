@php
    $route = 'admin.blog-author.';
@endphp

<fieldset class="mb-3">
    
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('Create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <form class="form-validate-jquery" enctype="multipart/form-data" id="content_form" action="{{ route('admin.blog-author.index') }}" method="POST">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="bg_photo">Background Picture <span class="text-danger">*</span></label>
                <input type="file" name="bg_photo" required id="bg_photo" class="form-control dropify">
                <span class="text-danger">Use <code>webp</code> Format Icon for Best Speed. Icon Size: <b>1920 X 500</b> pixel</span>
            </div>
            <div class="col-md-6 form-group">
                <label for="picture">Picture <span class="text-danger">*</span></label>
                <input type="file" name="picture" required id="picture" class="form-control dropify">
                <span class="text-danger">Use <code>png</code> Format Icon for Best Speed. Icon Size: <b>60 X 60</b> pixel</span>
            </div>
            <div class="col-md-6 form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Author Name" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="slug">Slug <span class="text-danger">*</span></label>
                <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter Slug" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="designation">Designation <span class="text-danger">*</span></label>
                <input type="text" name="designation" required id="designation" class="form-control" >
            </div>
            <div class="col-md-12 form-group">
                <label for="status">Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control select" data-placeholder="Select One" required>
                    <option value="">Select One</option>
                    <option selected value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="col-md-6 form-group">
                <label for="meta_title">Meta Title </label>
                <input type="text" name="meta_title" id="meta_title" class="form-control">
            </div>
            
            <div class="col-md-6 form-group">
                <label for="site_title">Site Title </label>
                <input type="text" name="site_title" id="site_title" class="form-control">
            </div>

            <div class="col-md-6 form-group">
                <label for="meta_keyword">Meta Keyword </label>
                <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="3" class="form-control"></textarea>
            </div>
            
            <div class="col-md-6 form-group">
                <label for="meta_description">Meta Description </label>
                <textarea name="meta_description" id="meta_description" cols="30" rows="3" class="form-control"></textarea>
            </div>
            
            <div class="col-md-6 form-group">
                <label for="meta_article_tag">Meta Article </label>
                <textarea name="meta_article_tag" id="meta_article_tag" cols="30" rows="3" class="form-control"></textarea>
            </div>
            
            <div class="col-md-6 form-group">
                <label for="meta_script">Meta Script </label>
                <textarea name="meta_script" id="meta_script" cols="30" rows="3" class="form-control"></textarea>
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