@php
    $route = 'admin.training.';
    $js = ['bank'];
@endphp
@extends('layouts.app', ['title' => _lang('Create Training')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<a href="{{ route( $route . 'index') }}"  class="breadcrumb-item active">{{ _lang('Training') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Create Service') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{ _lang('Create New Service') }}
		    
		</h5>
		<div class="header-elements">
            <a href="{{ route($route.'index') }}">
			    <button type="button" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i> {{ _lang('Back to Training') }}</button>
            </a>
		</div>
	</div>
	<div class="card-body">
		<form class="form-validate-jquery" id="content_form"  action="{{ route($route . 'store') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="category_id">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control select" data-placeholder="Select Category" required data-parsley-errors-container="#category_id_error">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span id="category_id_error"></span>
                </div>

                <div class="col-md-6 form-group">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter Slug" required>
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="page_title">Page Title <span class="text-danger">*</span></label>
                    <input type="text" name="page_title" id="page_title" class="form-control" placeholder="Enter Page Title" required>
                </div>

                <div class="col-md-12 form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Enter Meta Title">
                </div>

                <div class="col-md-12 form-group">
                    <label for="meta_keyword">Meta Keywords </label>
                    <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control" placeholder="Enter Meta Keyword"></textarea>
                    <small class="text-danger">Use <code>,</code> to separete Meta Keywords</small>
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="meta_description">Meta Description </label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="4" class="form-control" placeholder="Enter Meta Description"></textarea>
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="article_tag">Article Tag </label>
                    <textarea name="article_tag" id="article_tag" cols="30" rows="4" class="form-control" placeholder="Enter Article Tag"></textarea>
                </div>

                <div class="col-md-4 form-group">
                    <label for="date">Date</label>
                    <input type="text" name="date" id="" class="form-control date" value="{{ date('m-d-Y') }}">
                </div>

                <div class="col-md-4 form-group">
                    <label for="start_time">Start Time </label>
                    <input type="text" name="start_time" id="start_time" class="form-control" placeholder="Enter Start Time">
                </div>

                <div class="col-md-4 form-group">
                    <label for="end_time">End Time </label>
                    <input type="text" name="end_time" id="end_time" class="form-control" placeholder="Enter End Time">
                </div>

                <div class="col-md-12 form-group">
                    <label for="header">Header <span class="text-danger">*</span></label>
                    <input type="text" name="header" id="header" class="form-control" placeholder="Enter Header" required>
                </div>

                <div class="col-md-12 form-group">
                    <label for="sub_header">Sub Header</label>
                    <textarea name="sub_header" id="sub_header" cols="30" rows="4" class="form-control" placeholder="Enter Sub Header"></textarea>
                </div>

                <div class="col-md-12 form-group">
                    <label for="picture">Picture </label>
                    <input type="file" name="picture" id="picture" class="form-control dropify">
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="content">Content</label>
                    <textarea name="description" id="content" cols="30" rows="4" class="form-control"></textarea>
                </div>

                <div class="col-md-6 form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control select" data-placeholder="Select Status" required>
                        <option value="">Select Status</option>
                        <option selected value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
    
                <div class="col-md-6 form-group">
                    <label for="archive">Archive <span class="text-danger">*</span></label>
                    <select name="archive" id="archive" class="form-control select" data-placeholder="Select Archive" required>
                        <option value="">Select Archive</option>
                        <option value="1">Yes</option>
                        <option selected value="0">No</option>
                    </select>
                </div>

                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-sm btn-outline-success" id="submit" >{{ _lang('Submit') }}</button>
        
                    <button type="button" class="btn btn-sm btn-outline-primary" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
        
                    <a href="{{ route($route . 'index') }}">
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
    <link rel="stylesheet" href="{{ asset('asset/assets/css/dropify.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script src="{{ asset('asset/assets/js/dropify.js') }}"></script>
    <script>

        $('.dropify').dropify();
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });

        $('.select').select2({width: '100%'});
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
                formData.append('description', CKEDITOR.instances['content'].getData());

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