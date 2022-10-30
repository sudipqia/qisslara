@extends('layouts.frontend')
@section('content')
<div class="qia-breadcrumbs img4" style="background-image: url({{ asset('storage/about/'. get_option('blog_bg')) }});">
    <div class="breadcrumbs-inner text-center" style="padding: 50px 0px;">
        <h1 class="page-title">Case Study</h1>
        <ul>
            <li title="QI-A">
                <a class="active" href="{{ URL::to('/') }}">Home</a>
            </li>
            <li>Case Study</li>
        </ul>
    </div>
</div>

<div class="qia-inner-blog pt-120 pb-120 md-pt-90 md-pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 order-last">
                <div class="widget-area">
                    <div class="recent-posts mb-50">
                        <div class="widget-title">
                            <h3 class="title">Latest Case Study</h3>
                        </div>
                        @foreach ($blogs as $blog)
                            <div class="recent-post-widget">
                                <div class="post-img">
                                    <a href="{{ URL::to($blog->slug) }}"><img src="{{ asset('storage/case-study/'. $blog->cover_photo) }}" alt="{{ $blog->cover_photo_alter_tag }}"></a>
                                </div>
                                <div class="post-desc">
                                    <a href="{{ URL::to($blog->slug) }}">{{ $blog->header }} </a>
                                    <span class="date">
                                        <i class="fa fa-calendar"></i>
                                        {{ date('d F, Y', strtotime($blog->created_at)) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-8 pr-35 md-pr-15">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-12 mb-50">
                            <div class="blog-item row">
                                <div class="blog-img p-0 col-md-6">
                                    <a href="{{ URL::to($blog->slug) }}">
                                        <img style="width:358px;height:275px;" src="{{ asset('storage/case-study/'. $blog->cover_photo) }}" alt="{{ $blog->cover_photo_alter_tag }}">
                                    </a>
                                </div>
                                <div class="blog-content pl-0 col-md-6">
                                    <h3 class="blog-title">
                                        <a href="{{ $blog->slug }}">{{ $blog->header }}</a></h3>
                                    <div class="blog-meta">
                                        <ul class="btm-cate">
                                            <li>
                                                <div class="blog-date">
                                                    <i class="fa fa-calendar-check-o"></i> {{ date('d F, Y', strtotime($blog->created_at)) }}                   
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="blog-desc">   
                                        {{ $blog->sub_header }}           
                                    </div>
                                    <div class="blog-button inner-blog">
                                        <a class="blog-btn" href="{{ $blog->slug }}">Continue Reading</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12 d-flex justify-content-center">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
@endSection