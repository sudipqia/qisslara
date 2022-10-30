@php
    $route = 'admin.solution-card.';
@endphp

<fieldset class="mb-3">
    
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('Create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <form class="form-validate-jquery" enctype="multipart/form-data" id="content_form" action="{{ route('admin.solution-card.index') }}" method="POST">
        <div class="row">

            <div class="col-md-12 form-group">
                <label for="header">Header <span class="text-danger">*</span></label>
                <input type="text" name="header" id="header" class="form-control" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="sub_header">Sub Header <span class="text-danger">*</span></label>
                <input type="text" name="sub_header" id="sub_header" class="form-control" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="list_one">List One Content <span class="text-danger">*</span></label>
                <input type="text" name="list_one" id="list_one" class="form-control" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="list_two">List Two Content <span class="text-danger">*</span></label>
                <input type="text" name="list_two" id="list_two" class="form-control" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="list_three">List Three Content <span class="text-danger">*</span></label>
                <input type="text" name="list_three" id="list_three" class="form-control" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="list_four">List Four Content <span class="text-danger">*</span></label>
                <input type="text" name="list_four" id="list_four" class="form-control" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="button_text">Button Text <span class="text-danger">*</span></label>
                <input type="text" name="button_text" id="button_text" class="form-control" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="button_url">Button URL <span class="text-danger">*</span></label>
                <input type="text" name="button_url" id="button_url" class="form-control" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="open_another_tab">Open in Another Tab? </label>
                <select name="open_another_tab" id="open_another_tab" class="form-control select">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
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