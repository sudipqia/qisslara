@php
    $route = 'admin.service-content.';
    $js = ['bank'];
@endphp
@extends('layouts.app', ['title' => _lang('Update Service Content')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<a href="{{ route( $route . 'index') }}"  class="breadcrumb-item active">{{ _lang('Services') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Update Service Content') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{ _lang('Update Service Content') }}
		</h5>
		<div class="header-elements">
            <a href="{{ route($route.'index') }}">
			    <button type="button" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i> {{ _lang('Back to Services') }}</button>
            </a>
		</div>
	</div>
	<div class="card-body">
		<form class="form-validate-jquery" id="content_form"  action="{{ URL::to('admin/service-content/update/'. $model->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control select">
                        <option {{ $model->status == 1 ? 'selected' : '' }} value="1">Active</option>
                        <option {{ $model->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="content_type">Content Type <span class="text-danger">*</span></label>
                    <select name="content_type" id="content_type" class="form-control select" data-placeholder="Select Content Type" required data-parsley-errors-container="#content_type_error">
                        <option value="">Select Content Type</option>
                        <option {{ $model->content_type == 'Only Content' ? 'selected' : '' }} value="Only Content">Only Content</option>
                        <option {{ $model->content_type == 'Only Picture' ? 'selected' : '' }} value="Only Picture">Only Picture</option>
                        <option {{ $model->content_type == 'Left Side Picture' ? 'selected' : '' }} value="Left Side Picture">Left Side Picture</option>
                        <option {{ $model->content_type == 'Right Side Picture' ? 'selected' : '' }} value="Right Side Picture">Right Side Picture</option>
                    </select>
                    <span id="content_type_error"></span>
                </div>
            </div>

            <div id="only_for_content" style="{{ $model->content_type == 'Only Content' ? '' : 'display: none;' }}">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="content">Content <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" cols="30" rows="4">{{ $model->content }}</textarea>
                    </div>
                </div>
            </div>

            <div id="only_for_picture" style="{{ $model->content_type == 'Only Picture' ? '' : 'display: none;' }}">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="picture">Picture <span class="text-danger">*</span></label>
                        @if ($model->picture)
                            <input type="file" name="picture" id="picture" class="form-control dropify" data-default-file="{{ asset('storage/service/'. $model->picture) }}">
                        @else 
                            <input type="file" name="picture" id="picture" class="form-control dropify">
                        @endif
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="picture_alter_tag">Picture Alter Tag <span class="text-danger">*</span></label>
                        <input type="text" name="picture_alter_tag" id="picture_alter_tag" value="{{ $model->picture_alter_tag }}" class="form-control" >
                    </div>
                </div>
            </div>

            <div id="left_side_content_type" style="{{ $model->content_type == 'Left Side Picture' ? '' : 'display: none;' }}">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="left_side_picture">Picture <span class="text-danger">*</span></label>
                        @if ($model->picture)
                            <input type="file" name="left_side_picture" id="left_side_picture" class="form-control dropify" data-default-file="{{ asset('storage/service/'. $model->picture) }}">
                        @else 
                            <input type="file" name="left_side_picture" id="left_side_picture" class="form-control dropify">
                        @endif
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="left_side_picture_alter_tag">Picture Alter Tag <span class="text-danger">*</span></label>
                        <input type="text" name="left_side_picture_alter_tag" value="{{ $model->picture_alter_tag }}" id="left_side_picture_alter_tag" class="form-control" >
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="left_side_content">Content <span class="text-danger">*</span></label>
                        <textarea name="left_side_content" id="left_side_content" cols="30" rows="4">{{ $model->picture_alter_tag }}</textarea>
                    </div>
                </div>
            </div>

            <div id="right_side_content_type" style="{{ $model->content_type == 'Right Side Picture' ? '' : 'display: none;' }}">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="right_side_picture">Picture <span class="text-danger">*</span></label>
                        @if ($model->picture)
                            <input type="file" name="right_side_picture" id="right_side_picture" class="form-control dropify" data-default-file="{{ asset('storage/service/'. $model->picture) }}">
                        @else 
                            <input type="file" name="right_side_picture" id="right_side_picture" class="form-control dropify">
                        @endif
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="right_side_picture_alter_tag">Picture Alter Tag <span class="text-danger">*</span></label>
                        <input type="text" name="right_side_picture_alter_tag" value="{{ $model->picture_alter_tag }}" id="right_side_picture_alter_tag" class="form-control" >
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="right_side_content">Content <span class="text-danger">*</span></label>
                        <textarea name="right_side_content" id="right_side_content" cols="30" rows="4">{{ $model->picture_alter_tag }}</textarea>
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
                $('#left_side_content_type').hide();
                $('#right_side_content_type').hide();
            } else if (value == 'Only Picture') {
                $('#only_for_content').hide();
                $('#only_for_picture').show();
                $('#right_side_content_type').hide();
                $('#left_side_content_type').hide();
            } else if (value == 'Left Side Picture') {
                $('#only_for_content').hide();
                $('#only_for_picture').hide();
                $('#left_side_content_type').show();
                $('#right_side_content_type').hide();
            } else {
                $('#only_for_content').hide();
                $('#only_for_picture').hide();
                $('#left_side_content_type').hide();
                $('#right_side_content_type').show();
            }
        })

        CKEDITOR.replace('right_side_content', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('left_side_content', {
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
                formData.append('left_side_content', CKEDITOR.instances['left_side_content'].getData());
                formData.append('right_side_content', CKEDITOR.instances['right_side_content'].getData());
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