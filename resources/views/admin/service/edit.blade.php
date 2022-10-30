@php
    $route = 'admin.service.';
    $js = ['bank'];
@endphp
@extends('layouts.app', ['title' => _lang('Update Service')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<a href="{{ route( $route . 'index') }}"  class="breadcrumb-item active">{{ _lang('Services') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Update Service') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{ _lang('Service Content') }}
		    
		</h5>
		<div class="header-elements">
            <a href="{{ url('admin/service-content/create/'. $model->hash) }}">
			    <button type="button" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i> {{ _lang('Create') }}</button>
            </a>
		</div>
	</div>
	<div class="card-body">

        @if(Session::has('success_message'))
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success_message') }}
                </div>
            </div>
        @endif

        @if(Session::has('error_message'))
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error_message') }}
                </div>
            </div>
        @endif
        
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Position</th>
                    <th>Change Position</th>
                    <th width="20%" class="text-center">Action</th>
                </thead>
                @php
                    $serviceContents = App\ServiceContent::where('service_id', $model->id)->orderBy('position', 'ASC')->get();
                    $last = App\ServiceContent::orderBy('position', 'DESC')->first();
                    if($last) {
                        $last = $last->position;
                    } else {
                        $last = 1;
                    }
                @endphp
                @if (count($serviceContents) > 0)
                    @foreach ($serviceContents as $serviceContent)
                        <tr>
                            <td>{{ $serviceContent->content_type }}</td>
                            <td>
                                @if ($serviceContent->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else 
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td><span class="badge badge-dark">{{ $serviceContent->position }}</span></td>
                            <td>
                                @if ($serviceContent->position != 1)
                                    <a href="{{ route('admin.service-content.up', $serviceContent->position) }}">
                                        <button type="button" class="btn btn-sm btn-outline-success">
                                            <i class="icon-circle-up2"></i> Up
                                        </button>
                                    </a>
                                @endif

                                @if ($serviceContent->position != $last)
                                    <a href="{{ route('admin.service-content.down', $serviceContent->position) }}">
                                        <button type="button" class="btn btn-sm btn-outline-danger">
                                            <i class="icon-circle-down2"></i> Down 
                                        </button>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ url('admin/service-content/edit/'. $serviceContent->id) }}">
                                    <button type="button" class="btn btn-sm btn-outline-info text-info-800 border-info-600"> 
                                        {{ _lang('Edit') }}
                                    </button>
                                </a>
                                <a id="delete_item" data-id="{{ $serviceContent->id }}" data-url="{{ url('admin/service-content/delete/'. $serviceContent->id) }}" href="javascript:;">
                                    <button type="button" class="btn btn-sm btn-outline-danger ">
                                        {{ _lang('Delete') }}
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else 
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center"><b>Nothing to show</b></td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
	</div>
</div>

<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{ _lang('Update Service Information') }}
		    
		</h5>
		<div class="header-elements">
            <a href="{{ route($route.'index') }}">
			    <button type="button" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i> {{ _lang('Back to Services') }}</button>
            </a>
		</div>
	</div>
	<div class="card-body">

		<form class="form-validate-jquery" id="content_form"  action="{{ route($route . 'update', $model->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">

                <div class="col-md-12 form-group">
                    <label for="background_picture">Background Picture</label>
                    @if ($model->background_picture)
                        <input type="file" name="background_picture" id="background_picture" class="form-control dropify" data-default-file="{{ asset('storage/service/'. $model->background_picture) }}">
                    @else 
                        <input type="file" name="background_picture" id="background_picture" class="form-control dropify" >
                    @endif
                </div>

                <div class="col-md-4 form-group">
                    <label for="category_id">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control select" data-placeholder="Select Category" required data-parsley-errors-container="#category_id_error">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option {{ $model->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span id="category_id_error"></span>
                </div>

                <div class="col-md-4 form-group">
                    <label for="sub_category_id">Sub Category <span class="text-danger">*</span></label>
                    <select name="sub_category_id" id="sub_category_id" class="form-control select" data-placeholder="Select Sub Category" required data-parsley-errors-container="#sub_category_id_error">
                        <option value="">Select Sub Category</option>
                        @foreach ($sub_categories as $sub_category)
                            <option {{ $model->sub_category_id == $sub_category->id ? 'selected' : '' }} value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                        @endforeach
                    </select>
                    <span id="sub_category_id_error"></span>
                </div>

                <div class="col-md-4 form-group">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter Slug" required value="{{ $model->slug }}">
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="page_title">Page Title <span class="text-danger">*</span></label>
                    <input type="text" name="page_title" id="page_title" class="form-control" placeholder="Enter Page Title" required value="{{ $model->page_title }}">
                </div>

                <div class="col-md-12 form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Enter Meta Title" value="{{ $model->meta_title }}">
                </div>

                <div class="col-md-12 form-group">
                    <label for="meta_keyword">Meta Keywords </label>
                    <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control" placeholder="Enter Meta Keyword">{{ $model->meta_keyword }}</textarea>
                    <small class="text-danger">Use <code>,</code> to separete Meta Keywords</small>
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="meta_description">Meta Description </label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="4" class="form-control" placeholder="Enter Meta Description">{{ $model->meta_description }}</textarea>
                </div>
                
                <div class="col-md-12 form-group">
                    <label for="article_tag">Article Tag </label>
                    <textarea name="article_tag" id="article_tag" cols="30" rows="4" class="form-control" placeholder="Enter Article Tag">{{ $model->article_tag }}</textarea>
                </div>

                <div class="col-md-12 form-group">
                    <label for="header">Header <span class="text-danger">*</span></label>
                    <input type="text" name="header" id="header" class="form-control" placeholder="Enter Header" required value="{{ $model->header }}">
                </div>

                <div class="col-md-12 form-group">
                    <label for="sub_header">Sub Header</label>
                    <textarea name="sub_header" id="sub_header" cols="30" rows="4" class="form-control" placeholder="Enter Sub Header">{{ $model->sub_header }}</textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control select" data-placeholder="Select Status" required>
                        <option value="">Select Status</option>
                        <option {{ $model->status == 1 ? 'selected' : '' }} value="1">Active</option>
                        <option {{ $model->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                    </select>
                </div>
    
                <div class="col-md-6 form-group">
                    <label for="archive">Archive <span class="text-danger">*</span></label>
                    <select name="archive" id="archive" class="form-control select" data-placeholder="Select Archive" required>
                        <option value="">Select Archive</option>
                        <option {{ $model->archive == 1 ? 'selected' : '' }} value="1">Yes</option>
                        <option {{ $model->archive == 0 ? 'selected' : '' }} value="0">No</option>
                    </select>
                </div>

                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-sm btn-outline-success" id="submit" >{{ _lang('Update') }}</button>
        
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
    <script src="{{ asset('asset/assets/js/dropify.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script>

        CKEDITOR.replace( "description" );
        $('.dropify').dropify();

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