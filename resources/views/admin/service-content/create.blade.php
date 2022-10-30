@php
    $route = 'admin.service-content.';
    $js = ['bank'];
@endphp
@extends('layouts.app', ['title' => _lang('Create Service Content')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<a href="{{ route( $route . 'index') }}"  class="breadcrumb-item active">{{ _lang('Services') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Create Service Content') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{ _lang('Create New Service Content') }}
		    
		</h5>
		<div class="header-elements">
            <a href="{{ route($route.'index') }}">
			    <button type="button" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i> {{ _lang('Back to Services') }}</button>
            </a>
		</div>
	</div>
	<div class="card-body">
		<form class="form-validate-jquery" id="content_form"  action="{{ URL::to('admin/service-content/store') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="content_type">Content Type <span class="text-danger">*</span></label>
                    <select name="content_type" id="content_type" class="form-control select" data-placeholder="Select Content Type" required data-parsley-errors-container="#content_type_error">
                        <option value="">Select Content Type</option>
                        <option value="Only Content">Only Content</option>
                        <option value="Only Picture">Only Picture</option>
                        <option value="Left Side Picture">Left Side Picture</option>
                        <option value="Right Side Picture">Right Side Picture</option>
                    </select>
                    <span id="content_type_error"></span>
                </div>
            </div>

            <div id="only_for_content" style="display: none;">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="content">Content <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" cols="30" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <div id="only_for_picture" style="display: none;">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="only_picture">Picture <span class="text-danger">*</span></label>
                        <input type="file" name="only_picture" id="only_picture" class="form-control dropify" >
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="picture_alter_tag">Picture Alter Tag <span class="text-danger">*</span></label>
                        <input type="text" name="picture_alter_tag" id="picture_alter_tag" class="form-control" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="picture_link">Picture Link</label>
                        <input type="text" name="picture_link" id="picture_link" class="form-control" placeholder="Enter Picture Link" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="another_tab">Open Link In Another Tab? </label>
                        <select name="another_tab" id="another_tab" class="form-control select">
                            <option value="1">Yes</option>
                            <option selected value="0">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="for_max_content_type" style="display: none;">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="picture">Picture <span class="text-danger">*</span></label>
                        <input type="file" name="picture" id="picture" class="form-control dropify" >
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="picture_alter_tag">Picture Alter Tag <span class="text-danger">*</span></label>
                        <input type="text" name="picture_alter_tag" id="picture_alter_tag" class="form-control" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="max_picture_link">Picture Link</label>
                        <input type="text" name="max_picture_link" id="max_picture_link" class="form-control" placeholder="Enter Picture Link" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="max_another_tab">Open Link In Another Tab? </label>
                        <select name="max_another_tab" id="max_another_tab" class="form-control select">
                            <option value="1">Yes</option>
                            <option selected value="0">No</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="main_content">Content <span class="text-danger">*</span></label>
                        <textarea name="main_content" id="main_content" cols="30" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-sm btn-outline-success" id="submit" >{{ _lang('Submit') }}</button>
        
                    <button type="button" class="btn btn-sm btn-outline-primary" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
        
                    <a href="{{ URL::to('admin/service/'. $service->hash . '/edit') }}">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal"> {{  _lang('Back') }} </button>
                    </a>
                </div>
            </div>
        </form>
	</div>
</div>
<!-- /basic initialization -->
@stop
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('asset/assets/css/dropify.min.css') }}">
    <script src="{{ asset('asset/assets/js/dropify.js') }}"></script>
    <script>

        $('.dropify').dropify();
        $(document).on('change', '#content_type', function() {
            let value = $(this).val();
            if (value == 'Only Content') {
                $('#only_for_content').show();
                $('#only_for_picture').hide();
                $('#for_max_content_type').hide();
            } else if (value == 'Only Picture') {
                $('#only_for_content').hide();
                $('#only_for_picture').show();
                $('#for_max_content_type').hide();
            } else {
                $('#only_for_content').hide();
                $('#only_for_picture').hide();
                $('#for_max_content_type').show();
            }
        })

        CKEDITOR.replace('main_content', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });


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
                formData.append('content', CKEDITOR.instances['content'].getData());
                formData.append('main_content', CKEDITOR.instances['main_content'].getData());
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