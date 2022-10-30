@php
    $route = 'admin.testimonial.';
    $js = ['bank'];
@endphp
@extends('layouts.app', ['title' => _lang('Update Testimonial')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<a href="{{ route( $route . 'index') }}"  class="breadcrumb-item active">{{ _lang('Services') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Update Service') }}</span>
			</div>Testimonial
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{ _lang('Update Testimonial Information') }}
		    
		</h5>
		<div class="header-elements">
            <a href="{{ route($route.'index') }}">
			    <button type="button" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i> {{ _lang('Back to Testimonial') }}</button>
            </a>
		</div>
	</div>
	<div class="card-body">
		<form class="form-validate-jquery" id="content_form"  action="{{ route($route . 'update', $model->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="rating">Rating <span class="text-danger">*</span></label>
                    <input type="file" name="rating" id="rating" class="form-control dropify" data-default-file="{{ asset('storage/home-page-content/'. $model->rating) }}">
                    <span class="text-danger">Use <code>png</code> Format Icon for Best Speed. Icon Size: <b>100 X 13</b> pixel</span>
                </div>
                <div class="col-md-6 form-group">
                    <label for="picture">Picture <span class="text-danger">*</span></label>
                    <input type="file" name="picture" id="picture" class="form-control dropify" data-default-file="{{ asset('storage/home-page-content/'. $model->picture) }}">
                    <span class="text-danger">Use <code>png</code> Format Icon for Best Speed. Icon Size: <b>382 X 445</b> pixel</span>
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required value="{{ $model->name }}">
                </div>
                <div class="col-md-12 form-group">
                    <label for="designation">Designation <span class="text-danger">*</span></label>
                    <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter designation" required value="{{ $model->designation }}">
                </div>
                <div class="col-md-12 form-group">
                    <label for="content">Content </label>
                    <textarea name="content" id="content" cols="30" rows="3" class="form-control">{{ $model->content }}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label for="video_url">Video URL </label>
                    <textarea name="video_url" id="video_url" cols="30" rows="3" class="form-control">{{ $model->video_url }}</textarea>
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-sm btn-outline-success" id="submit" >{{ _lang('Update') }}</button>
        
                    <button type="button" class="btn btn-sm btn-outline-primary" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
        
                    <a href="{{ $route . 'index' }}">
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
<script>
    $('.dropify').dropify();
    _modalFormValidation();
    _componentSelect2Normal();
</script>
@endpush