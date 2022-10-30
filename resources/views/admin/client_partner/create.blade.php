@php
    $route = 'admin.client-partner.';
@endphp

<fieldset class="mb-3">
    
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('Create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <form class="form-validate-jquery" enctype="multipart/form-data" id="content_form" action="{{ route('admin.client-partner.index') }}" method="POST">
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="picture">Picture <span class="text-danger">*</span></label>
                <input type="file" name="picture" required id="picture" class="form-control dropify">
                <span class="text-danger">Use <code>png</code> Format Icon for Best Speed. Icon Size: <b>200 X 60</b> pixel</span>
            </div>
            <div class="col-md-12 form-group">
                <label for="alt_tag">Alter Tag <span class="text-danger">*</span></label>
                <input type="text" name="alt_tag" id="alt_tag" class="form-control" placeholder="Enter Alter Tag Data" required>
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