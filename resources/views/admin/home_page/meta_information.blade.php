@extends('layouts.app', ['title' => _lang('Meta Information')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Home Page Meta Information') }}</span>
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
            <h5 class="card-title">{{ _lang('Home Page Meta Information') }} </h5>
        </div>
        <div class="card-body">
            <form class="form-validate-jquery" id="content_form" action="{{ route('admin.home-page.store-meta-information') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    
                    <div class="col-md-12 form-group">
                        <label for="home_site_title">Site Title <span class="text-danger">*</span></label>
                        <input type="text" name="home_site_title" id="home_site_title" class="form-control" placeholder="Enter Site Title" value="{{ get_option('home_site_title') }}" required>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="meta_title">Meta Title <span class="text-danger">*</span></label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Enter Meta Title" value="{{ get_option('meta_title') }}" required>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="meta_keyword">Meta Keyword </label>
                        <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="3" class="form-control" placeholder="Enter Meta Keyword">{{ get_option('meta_keyword') }}</textarea>
                        <small class="text-danger">Use <code>,</code> for separate Keywords</small>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="meta_description">Meta Description </label>
                        <textarea name="meta_description" id="meta_description" cols="30" rows="3" class="form-control" placeholder="Enter Meta Description">{{ get_option('meta_description') }}</textarea>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="article_tag">Article Tag </label>
                        <textarea name="article_tag" id="article_tag" cols="30" rows="3" class="form-control" placeholder="Enter Article Tag">{{ get_option('article_tag') }}</textarea>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="head_script">Head Script </label>
                        <textarea name="head_script" id="head_script" cols="30" rows="3" class="form-control" placeholder="Enter Head Tag">{{ get_option('head_script') }}</textarea>
                    </div>
    
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-sm btn-outline-success" id="submit" >{{ _lang('Submit') }}</button>
            
                        <button type="button" class="btn btn-sm btn-outline-primary" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@push('scripts')
    <script>

        _modalFormValidation();
        _componentSelect2Normal();

    </script>
@endpush