@extends('layouts.app', ['title' => _lang('About Us Information')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<span class="breadcrumb-item active">{{ _lang('About Us Information') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="col-md-8 mx-auto">
    <div class="card border-top-success rounded-top-0" id="table_card">
        <div class="card-header header-elements-inline bg-light border-grey-300" >
            <h5 class="card-title">{{ _lang('About Us Information') }} </h5>
        </div>
        <div class="card-body">
            <form class="form-validate-jquery" id="content_form" action="{{ route('admin.submit-about-us-content') }}" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="about_bg">Background Picture </label>
                        <input type="file" name="about_bg" id="about_bg" class="form-control dropify" data-default-file="{{ asset('storage/about/'. get_option('about_bg')) }}">
                        <small class="text-danger">Use <code>WebP</code> Format Image for better output. Image size: <b>1920 X 550</b> pixels</small>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="about_header">Header </label>
                        <input type="text" name="about_header" id="about_header" class="form-control" value="{{ get_option('about_header') }}">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="about_string">Content String </label>
                        <input type="text" name="about_string" id="about_string" class="form-control" value="{{ get_option('about_string') }}">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="about_content">Content </label>
                        <textarea name="about_content" id="about_content" cols="30" rows="3" class="form-control">{{ get_option('about_content') }}</textarea>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="about_button_text">Button Text </label>
                        <input type="text" name="about_button_text" id="about_button_text" class="form-control" value="{{ get_option('about_button_text') }}">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="about_button_url">Button URL </label>
                        <input type="text" name="about_button_url" id="about_button_url" class="form-control" value="{{ get_option('about_button_url') }}">
                        <span class="text-danger">If you set this empty, then button will not show.</span>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="about_header">Header </label>
                        <select name="about_open_another_tab" id="about_open_another_tab" class="from-control select">
                            <option {{ get_option('about_open_another_tab') == 1 ? 'selected' : '' }} value="1">Yes</option>
                            <option {{ get_option('about_open_another_tab') == 0 ? 'selected' : '' }} value="0">No</option>
                        </select>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="about_image">Picture </label>
                        <input type="file" name="about_image" id="about_image" class="form-control dropify" data-default-file="{{ asset('storage/about/'. get_option('about_image')) }}">
                        <small class="text-danger">Use <code>WebP</code> Format Image for better output. Image size: <b>590 X 590</b> pixels</small>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="about_image_alt_tag">Image Alter Tag </label>
                        <input type="text" name="about_image_alt_tag" id="about_image_alt_tag" class="form-control" value="{{ get_option('about_image_alt_tag') }}">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="about_site_title">Site Title </label>
                        <input type="text" name="about_site_title" id="about_site_title" class="form-control" value="{{ get_option('about_site_title') }}">
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="about_meta_title">Meta Title </label>
                        <input type="text" name="about_meta_title" id="about_meta_title" class="form-control" value="{{ get_option('about_meta_title') }}">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="about_meta_keyword">Meta Keyword </label>
                        <textarea name="about_meta_keyword" id="about_meta_keyword" cols="30" rows="3" class="form-control">{{ get_option('about_meta_keyword') }}</textarea>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="about_meta_description">Meta Description </label>
                        <textarea name="about_meta_description" id="about_meta_description" cols="30" rows="3" class="form-control">{{ get_option('about_meta_description') }}</textarea>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="about_meta_article">Meta Article </label>
                        <textarea name="about_meta_article" id="about_meta_article" cols="30" rows="3" class="form-control">{{ get_option('about_meta_article') }}</textarea>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="about_meta_script">Meta Script </label>
                        <textarea name="about_meta_script" id="about_meta_script" cols="30" rows="3" class="form-control">{{ get_option('about_meta_script') }}</textarea>
                    </div>

                </div>

                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-sm btn-outline-success" id="submit" >{{ _lang('Submit') }}</button>
        
                    <button type="button" class="btn btn-sm btn-outline-primary" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@push('scripts')
    <link rel="stylesheet" href="{{ asset('asset/assets/css/dropify.min.css') }}">
    <script src="{{ asset('asset/assets/js/dropify.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( "about_content" );
        $('.dropify').dropify();
        _componentSelect2Normal();
        var _formValidationObject = function() {
            if ($('#content_form').length > 0) {
                $('#content_form').parsley().on('field:validated', function() {
                    var ok = $('.parsley-error').length === 0;
                    $('.bs-callout-info').toggleClass('hidden', !ok);
                    $('.bs-callout-warning').toggleClass('hidden', ok);
                });
            }

            $('#content_form').on('submit', function(e) {
                e.preventDefault();
                $('#submit').hide();
                $('#submiting').show();
                $(".ajax_error").remove();
                var submit_url = $('#content_form').attr('action');
                //Start Ajax
                var formData = new FormData($("#content_form")[0]);
                formData.append('about_content', CKEDITOR.instances['about_content'].getData());

                $.ajax({
                    url: submit_url,
                    type: 'POST',
                    data: formData,
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == 'danger') {
                            new PNotify({
                                title: 'Error',
                                text: data.message,
                                type: 'error',
                                addclass: 'alert alert-danger alert-styled-left',
                            });

                        } else {
                            new PNotify({
                                title: 'Success',
                                text: data.message,
                                type: 'success',
                                addclass: 'alert alert-styled-left',
                            });
                            $('#submit').show();
                            $('#submiting').hide();
                            if (data.goto) {
                                setTimeout(function() {

                                    window.location.href = data.goto;
                                }, 2500);
                            }
                            if (data.window) {
                                window.open(data.window, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
                                setTimeout(function() {
                                    window.location.href = '';
                                }, 1000);
                            }
                        }
                    },
                    error: function(data) {
                        var jsonValue = $.parseJSON(data.responseText);
                        const errors = jsonValue.errors;
                        if (errors) {
                            var i = 0;
                            $.each(errors, function(key, value) {
                                const first_item = Object.keys(errors)[i]
                                const message = errors[first_item][0];
                                $('#' + first_item).parsley().removeError('required', {
                                    updateClass: true
                                });
                                $('#' + first_item).parsley().addError('required', {
                                    message: value,
                                    updateClass: true
                                });
                                // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                                new PNotify({
                                    title: 'Error',
                                    text: value,
                                    type: 'error',
                                    addclass: 'alert alert-danger alert-styled-left',
                                });
                                i++;
                            });
                        } else {
                            new PNotify({
                                title: 'Something Wrong!',
                                text: jsonValue.message,
                                type: 'error',
                                addclass: 'alert alert-danger alert-styled-left',
                            });
                        }
                        _componentSelect2Normal();
                        $('#submit').show();
                        $('#submiting').hide();
                    }
                });
            });
        };

        _formValidationObject();

    </script>
@endpush