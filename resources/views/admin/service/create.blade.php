@php
    $route = 'admin.service.';
    $js = ['bank'];
@endphp
@extends('layouts.app', ['title' => _lang('Create Service')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<a href="{{ route( $route . 'index') }}"  class="breadcrumb-item active">{{ _lang('Services') }}</a>
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
			    <button type="button" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i> {{ _lang('Back to Services') }}</button>
            </a>
		</div>
	</div>
	<div class="card-body">
		<form class="form-validate-jquery" id="content_form"  action="{{ route($route . 'store') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="category_id">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control select" data-placeholder="Select Category" required data-parsley-errors-container="#category_id_error">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span id="category_id_error"></span>
                </div>

                <div class="col-md-4 form-group">
                    <label for="sub_category_id">Sub Category <span class="text-danger">*</span></label>
                    <select name="sub_category_id" id="sub_category_id" class="form-control select" data-placeholder="Select Sub Category" required data-parsley-errors-container="#sub_category_id_error">
                        <option value="">Select Sub Category</option>
                    </select>
                    <span id="sub_category_id_error"></span>
                </div>

                <div class="col-md-4 form-group">
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

                <div class="col-md-12 form-group">
                    <label for="header">Header <span class="text-danger">*</span></label>
                    <input type="text" name="header" id="header" class="form-control" placeholder="Enter Header" required>
                </div>

                <div class="col-md-12 form-group">
                    <label for="sub_header">Sub Header</label>
                    <textarea name="sub_header" id="sub_header" cols="30" rows="4" class="form-control" placeholder="Enter Sub Header"></textarea>
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="description">Content</label>
                    <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
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
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script>

        CKEDITOR.replace( "description" );

        _modalFormValidation();
        _componentSelect2Normal();

        $(document).on('change', '#category_id', function() {
            let value = $(this).val();
            $.ajax({
                url : '/admin/service/get-sub-category',
                type : 'GET',
                data : {
                    value : value
                },
                dataType:'json',
                success : function(data) {              
                    $("#sub_category_id").html('').select2({data: data}).trigger('change');
                }
            });
        })

    </script>
@endpush