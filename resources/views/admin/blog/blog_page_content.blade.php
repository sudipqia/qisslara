@extends('layouts.app', ['title' => _lang('Blog Page SEO Information')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Blog Page SEO Information') }}</span>
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
            <h5 class="card-title">{{ _lang('Blog Page SEO Information') }} </h5>
        </div>
        <div class="card-body">
            <form class="form-validate-jquery" id="content_form" action="{{ route('admin.submit-terms-and-condition') }}" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="blog_bg">Background Picture </label>
                        <input type="file" name="blog_bg" id="blog_bg" class="form-control dropify" data-default-file="{{ asset('storage/about/'. get_option('blog_bg')) }}">
                        <small class="text-danger">Use <code>WebP</code> Format Image for better output. Image size: <b>1920 X 550</b> pixels</small>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="blog_site_title">Site Title </label>
                        <input type="text" name="blog_site_title" id="blog_site_title" class="form-control" value="{{ get_option('blog_site_title') }}">
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="blog_meta_title">Meta Title </label>
                        <input type="text" name="blog_meta_title" id="blog_meta_title" class="form-control" value="{{ get_option('blog_meta_title') }}">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="blog_meta_keyword">Meta Keyword </label>
                        <textarea name="blog_meta_keyword" id="blog_meta_keyword" cols="30" rows="3" class="form-control">{{ get_option('blog_meta_keyword') }}</textarea>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="blog_meta_description">Meta Description </label>
                        <textarea name="blog_meta_description" id="blog_meta_description" cols="30" rows="3" class="form-control">{{ get_option('blog_meta_description') }}</textarea>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="blog_article_tag">Meta Article </label>
                        <textarea name="blog_article_tag" id="blog_article_tag" cols="30" rows="3" class="form-control">{{ get_option('blog_article_tag') }}</textarea>
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
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script src="{{ asset('asset/assets/js/dropify.js') }}"></script>
    <script>
        CKEDITOR.replace( "content" );
        $('.dropify').dropify();
        _componentSelect2Normal();
        _formValidation();
    </script>
@endpush