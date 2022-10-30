@extends('layouts.app', ['title' => _lang('Home Page Content Information')])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Home Page Content Information') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="col-md-12">
    <div class="card border-top-success rounded-top-0" id="table_card">
        <div class="card-header header-elements-inline bg-light border-grey-300" >
            <h5 class="card-title">{{ _lang('Home Page Content Information') }} </h5>
        </div>
        <div class="card-body">
            <form class="form-validate-jquery" id="content_form" action="{{ route('admin.submit-home-page-content') }}" method="POST" enctype="multipart/form-data">

                <div id="accordion-group">
                    <div class="card rounded-top-0 rounded-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a data-toggle="collapse" class="text-body collapsed" href="#accordion-item-group1" aria-expanded="false">Banner Content</a>
                            </h6>
                        </div>

                        <div id="accordion-item-group1" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="navbar_button_text">Navbar Button Text</label>
                                        <input type="text" name="navbar_button_text" id="navbar_button_text" class="form-control" value="{{ get_option('navbar_button_text') }}">
                                    </div>
                                    
                                    <div class="col-md-4 form-group">
                                        <label for="navbar_button_url">Navbar Button URL</label>
                                        <input type="text" name="navbar_button_url" id="navbar_button_url" class="form-control" value="{{ get_option('navbar_button_url') }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="navbar_button_open_another_tab">Open another Tab? </label>
                                        <select name="navbar_button_open_another_tab" id="navbar_button_open_another_tab" class="form-control select">
                                            <option {{ get_option('navbar_button_open_another_tab') == 1 ? 'selected' : '' }} value="1">Yes</option>
                                            <option {{ get_option('navbar_button_open_another_tab') == 0 ? 'selected' : '' }} value="0">No</option>
                                        </select>
                                    </div>
                                    

                                    <div class="col-md-12 form-group">
                                        <label for="banner_background_picture">Background Picture</label>
                                        <input type="file" name="banner_background_picture" id="banner_background_picture" class="form-control dropify" data-default-file="{{ asset('storage/logo/'. get_option('banner_background_picture')) }}">
                                        <span class="text-danger">Use <code>WEBP</code> Format for best Output Quality. Image Size: <b>1920 X 765</b> pixel</span>
                                    </div>
        
                                    <div class="col-md-12 form-group">
                                        <label for="banner_header">Header</label>
                                        <input type="text" name="banner_header" id="banner_header" class="form-control" placeholder="Enter Hewder" value="{{ get_option('banner_header') }}">
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="banner_sub_header">Sub Header</label>
                                        <input type="text" name="banner_sub_header" id="banner_sub_header" class="form-control" placeholder="Enter Sub Hewder" value="{{ get_option('banner_sub_header') }}">
                                    </div>
        
                                    <div class="col-md-6 form-group">
                                        <label for="banner_input_placeholder">Input Placeholder</label>
                                        <input type="text" name="banner_input_placeholder" id="banner_input_placeholder" class="form-control" placeholder="Enter Hewder" value="{{ get_option('banner_input_placeholder') }}">
                                    </div>
        
                                    <div class="col-md-6 form-group">
                                        <label for="banner_button_text">Button Text</label>
                                        <input type="text" name="banner_button_text" id="banner_button_text" class="form-control" placeholder="Enter Banner Text" value="{{ get_option('banner_button_text') }}">
                                    </div>
        
                                    <div class="col-md-12 form-group">
                                        <label for="banner_video_picture">Video Picture</label>
                                        <input type="file" name="banner_video_picture" id="banner_video_picture" class="form-control dropify" data-default-file="{{ asset('storage/logo/'. get_option('banner_video_picture')) }}">
                                        <span class="text-danger">Use <code>WEBP</code> Format for best Output Quality. Image Size: <b>1000 X 665</b> pixel</span>
                                    </div>
        
                                    <div class="col-md-12 form-group">
                                        <label for="banner_video_picture_alt_tag">Video Picture Alter Text</label>
                                        <input type="text" name="banner_video_picture_alt_tag" id="banner_video_picture_alt_tag" class="form-control" placeholder="Enter Video Picture Alter Text" value="{{ get_option('banner_video_picture_alt_tag') }}">
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="banner_video_url">Video Url</label>
                                        <textarea name="banner_video_url" id="banner_video_url" cols="30" rows="3" class="form-control">{{ get_option('banner_video_url') }}</textarea>
                                    </div>
        
                                    <div class="col-md-12 form-group">
                                        <label for="banner_client_partner_text">Client Portal Text</label>
                                        <input type="text" name="banner_client_partner_text" id="banner_client_partner_text" class="form-control" value="{{ get_option('banner_client_partner_text') }}">
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="service_header">Service Header</label>
                                        <input type="text" name="service_header" id="service_header" class="form-control" value="{{ get_option('service_header') }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="service_button_text">Service Button Text</label>
                                        <input type="text" name="service_button_text" id="service_button_text" class="form-control" value="{{ get_option('service_button_text') }}">
                                    </div>
                                    
                                    <div class="col-md-4 form-group">
                                        <label for="service_button_url">Service Button URL</label>
                                        <input type="text" name="service_button_url" id="service_button_url" class="form-control" value="{{ get_option('service_button_url') }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="service_button_open_another_tab">Open another Tab? </label>
                                        <select name="service_button_open_another_tab" id="service_button_open_another_tab" class="form-control select">
                                            <option {{ get_option('service_button_open_another_tab') == 1 ? 'selected' : '' }} value="1">Yes</option>
                                            <option {{ get_option('service_button_open_another_tab') == 0 ? 'selected' : '' }} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-top-0 rounded-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a class="text-body" data-toggle="collapse" href="#accordion-item-group3" aria-expanded="true">
                                    Get Demo 
                                </a>
                            </h6>
                        </div>

                        <div id="accordion-item-group3" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="get_demo_title">Title</label>
                                        <input type="text" name="get_demo_title" id="get_demo_title" class="form-control" placeholder="Enter Title" value="{{ get_option('get_demo_title') }}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="get_demo_header">Header</label>
                                        <input type="text" name="get_demo_header" id="get_demo_header" class="form-control" placeholder="Enter Title" value="{{ get_option('get_demo_header') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="get_demo_button_text">Button Text</label>
                                        <input type="text" name="get_demo_button_text" id="get_demo_button_text" class="form-control" placeholder="Enter Button Text" value="{{ get_option('get_demo_button_text') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="get_demo_button_url">Button URL</label>
                                        <input type="text" name="get_demo_button_url" id="get_demo_button_url" class="form-control" placeholder="Enter Button Text" value="{{ get_option('get_demo_button_url') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="get_demo_open_another_tab">Open In another Tab? </label>
                                        <select name="get_demo_open_another_tab" id="get_demo_open_another_tab" class="form-control select">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="get_demo_background_picture">Background Picture</label>
                                        <input type="file" name="get_demo_background_picture" id="get_demo_background_picture" class="form-control dropify" data-default-file="{{ asset('storage/logo/'. get_option('get_demo_background_picture')) }}">
                                        <span class="text-danger">Use <code>WEBP</code> Format for best Output Quality. Image Size: <b>1920 X 800</b> pixel</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-top-0 rounded-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a class="text-body" data-toggle="collapse" href="#accordion-item-group9" aria-expanded="true">
                                    Solution Content
                                </a>
                            </h6>
                        </div>

                        <div id="accordion-item-group9" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="solution_title">Title</label>
                                        <input type="text" name="solution_title" id="solution_title" class="form-control" placeholder="Enter Title" value="{{ get_option('solution_title') }}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="solution_heading">Header</label>
                                        <input type="text" name="solution_heading" id="solution_heading" class="form-control" placeholder="Enter Title" value="{{ get_option('solution_heading') }}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="solution_content">Solution Content </label>
                                        <textarea name="solution_content" id="solution_content" class="form-control" cols="30" rows="3">{{ get_option('solution_content') }}</textarea>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="solution_button_text">Button Text</label>
                                        <input type="text" name="solution_button_text" id="solution_button_text" class="form-control" placeholder="Enter Button Text" value="{{ get_option('solution_button_text') }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="solution_button_url">Button URL</label>
                                        <input type="text" name="solution_button_url" id="solution_button_url" class="form-control" placeholder="Enter Button Text" value="{{ get_option('solution_button_url') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="solution_button_open_in_another_tab">Open In another Tab? </label>
                                        <select name="solution_button_open_in_another_tab" id="solution_button_open_in_another_tab" class="form-control select">
                                            <option {{ get_option('solution_button_open_in_another_tab') == 1 ? 'selected' : '' }} value="1">Yes</option>
                                            <option {{ get_option('solution_button_open_in_another_tab') == 0 ? 'selected' : '' }} value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="solution_bg_picture">Background Picture</label>
                                        <input type="file" name="solution_bg_picture" id="solution_bg_picture" class="form-control dropify" data-default-file="{{ asset('storage/logo/'. get_option('solution_bg_picture')) }}">
                                        <span class="text-danger">Use <code>WEBP</code> Format for best Output Quality. Image Size: <b>410 X 480</b> pixel</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-top-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a class="text-body collapsed" data-toggle="collapse" href="#accordion-item-group2" aria-expanded="false">About</a>
                            </h6>
                        </div>

                        <div id="accordion-item-group2" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="home_about_title">Title </label>
                                        <input type="text" id="home_about_title" name="home_about_title" class="form-control" value="{{ get_option('home_about_title') }}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="home_about_header">Open In another Tab </label>
                                        <input type="text" id="home_about_header" name="home_about_header" class="form-control" value="{{ get_option('home_about_header') }}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="home_about_content">Content </label>
                                        <textarea name="home_about_content" id="home_about_content" cols="30" rows="3" class="form-control">{{ get_option('home_about_content') }}</textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="home_about_picture">Picture</label>
                                        <input type="file" name="home_about_picture" id="home_about_picture" class="form-control dropify" data-default-file="{{ asset('storage/logo/'. get_option('home_about_picture')) }}">
                                        <span class="text-danger">Use <code>WEBP</code> Format for best Output Quality. Image Size: <b>590 X 587</b> pixel</span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="home_about_alt_tag">Picture Alter Tag </label>
                                        <input type="text" id="home_about_alt_tag" name="home_about_alt_tag" class="form-control" value="{{ get_option('home_about_alt_tag') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="home_about_btn_text">Button Text</label>
                                        <input type="text" name="home_about_btn_text" id="home_about_btn_text" class="form-control" placeholder="Enter Button Text" value="{{ get_option('home_about_btn_text') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="home_about_btn_url">Button URL</label>
                                        <input type="text" name="home_about_btn_url" id="home_about_btn_url" class="form-control" placeholder="Enter Button Text" value="{{ get_option('home_about_btn_url') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="home_about_btn_open_another_tab">Open In another Tab? </label>
                                        <select name="home_about_btn_open_another_tab" id="home_about_btn_open_another_tab" class="form-control select">
                                            <option value="1" {{ get_option('home_about_btn_open_another_tab') == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ get_option('home_about_btn_open_another_tab') == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-top-0 rounded-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a class="text-body collapsed" data-toggle="collapse" href="#accordion-item-group5" aria-expanded="false">Testimonial</a>
                            </h6>
                        </div>

                        <div id="accordion-item-group5" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="testimonial_title">Title </label>
                                        <input type="text" name="testimonial_title" id="testimonial_title" class="form-control" value="{{ get_option('testimonial_title') }}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="testimonial_header">Header </label>
                                        <input type="text" name="testimonial_header" id="testimonial_header" class="form-control" value="{{ get_option('testimonial_header') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card rounded-top-0 rounded-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a class="text-body collapsed" data-toggle="collapse" href="#accordion-item-group6" aria-expanded="false">Case Study</a>
                            </h6>
                        </div>

                        <div id="accordion-item-group6" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="col-md-12 form-group">
                                    <label for="case_study_title">Title</label>
                                    <input type="text" name="case_study_title" id="case_study_title" class="form-control" value="{{ get_option('case_study_title') }}">
                                </div> 
                                <div class="col-md-12 form-group">
                                    <label for="case_study_header">Header</label>
                                    <input type="text" name="case_study_header" id="case_study_header" class="form-control" value="{{ get_option('case_study_header') }}">
                                </div> 
                                <div class="col-md-12 form-group">
                                    <label for="case_study_content">Content</label>
                                    <textarea name="case_study_content" id="case_study_content" cols="30" rows="3" class="form-control">{{ get_option('case_study_content') }}</textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="case_study_bg_picture">Picture</label>
                                    <input type="file" name="case_study_bg_picture" id="case_study_bg_picture" class="form-control dropify" data-default-file="{{ asset('storage/logo/'. get_option('case_study_bg_picture')) }}">
                                    <span class="text-danger">Use <code>WEBP</code> Format for best Output Quality. Image Size: <b>575 X 605</b> pixel</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-top-0 rounded-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a class="text-body" data-toggle="collapse" href="#accordion-item-group15" aria-expanded="true">
                                    Blog Content
                                </a>
                            </h6>
                        </div>

                        <div id="accordion-item-group15" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="home_blog_header">Header</label>
                                        <input type="text" name="home_blog_header" id="home_blog_header" class="form-control" placeholder="Enter Header" value="{{ get_option('home_blog_header') }}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="home_blog_content">Content </label>
                                        <textarea name="home_blog_content" id="home_blog_content" class="form-control" cols="30" rows="3">{{ get_option('home_blog_content') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-top-0 rounded-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a class="text-body" data-toggle="collapse" href="#accordion-item-group25" aria-expanded="true">
                                    News Content
                                </a>
                            </h6>
                        </div>

                        <div id="accordion-item-group25" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="news_site_title">Site Title <span class="text-danger">*</span></label>
                                        <input type="text" name="news_site_title" id="news_site_title" class="form-control" placeholder="Enter Site Title" value="{{ get_option('news_site_title') }}" required>
                                    </div>
                
                                    <div class="col-md-12 form-group">
                                        <label for="news_meta_title">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" name="news_meta_title" id="news_meta_title" class="form-control" placeholder="Enter Meta Title" value="{{ get_option('news_meta_title') }}" required>
                                    </div>
                
                                    <div class="col-md-12 form-group">
                                        <label for="news_meta_keyword">Meta Keyword </label>
                                        <textarea name="news_meta_keyword" id="news_meta_keyword" cols="30" rows="3" class="form-control" placeholder="Enter Meta Keyword">{{ get_option('news_meta_keyword') }}</textarea>
                                        <small class="text-danger">Use <code>,</code> for separate Keywords</small>
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="news_meta_description">Meta Description </label>
                                        <textarea name="news_meta_description" id="news_meta_description" cols="30" rows="3" class="form-control" placeholder="Enter Meta Description">{{ get_option('news_meta_description') }}</textarea>
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="news_article_tag">Article Tag </label>
                                        <textarea name="news_article_tag" id="news_article_tag" cols="30" rows="3" class="form-control" placeholder="Enter Article Tag">{{ get_option('news_article_tag') }}</textarea>
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="news_head_script">Head Script </label>
                                        <textarea name="news_head_script" id="news_head_script" cols="30" rows="3" class="form-control" placeholder="Enter Head Tag">{{ get_option('news_head_script') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-top-0 rounded-0">
                        <div class="card-header">
                            <h6 class="card-title">
                                <a class="text-body" data-toggle="collapse" href="#accordion-item-group35" aria-expanded="true">
                                    Case Study Page Content
                                </a>
                            </h6>
                        </div>

                        <div id="accordion-item-group35" class="collapse" data-parent="#accordion-group" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="case_study_site_title">Site Title <span class="text-danger">*</span></label>
                                        <input type="text" name="case_study_site_title" id="case_study_site_title" class="form-control" placeholder="Enter Site Title" value="{{ get_option('case_study_site_title') }}" required>
                                    </div>
                
                                    <div class="col-md-12 form-group">
                                        <label for="case_study_meta_title">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" name="case_study_meta_title" id="case_study_meta_title" class="form-control" placeholder="Enter Meta Title" value="{{ get_option('case_study_meta_title') }}" required>
                                    </div>
                
                                    <div class="col-md-12 form-group">
                                        <label for="case_study_meta_keyword">Meta Keyword </label>
                                        <textarea name="case_study_meta_keyword" id="case_study_meta_keyword" cols="30" rows="3" class="form-control" placeholder="Enter Meta Keyword">{{ get_option('case_study_meta_keyword') }}</textarea>
                                        <small class="text-danger">Use <code>,</code> for separate Keywords</small>
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="news_meta_description">Meta Description </label>
                                        <textarea name="news_meta_description" id="news_meta_description" cols="30" rows="3" class="form-control" placeholder="Enter Meta Description">{{ get_option('news_meta_description') }}</textarea>
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="case_study_meta_description">Article Tag </label>
                                        <textarea name="case_study_meta_description" id="case_study_meta_description" cols="30" rows="3" class="form-control" placeholder="Enter Article Tag">{{ get_option('case_study_meta_description') }}</textarea>
                                    </div>
                                    
                                    <div class="col-md-12 form-group">
                                        <label for="case_study_head_script">Head Script </label>
                                        <textarea name="case_study_head_script" id="case_study_head_script" cols="30" rows="3" class="form-control" placeholder="Enter Head Tag">{{ get_option('case_study_head_script') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script>
        $('.dropify').dropify();
        _componentSelect2Normal();
        _modalFormValidation();
    </script>
@endpush