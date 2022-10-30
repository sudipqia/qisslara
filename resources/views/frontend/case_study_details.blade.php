@extends('layouts.frontend')
@section('content')
<style>
    #blog_content ul {
        list-style: disc;
        margin: 0 0 1.5em 3em;
    }
</style>
<div class="qia-breadcrumbs img4" style="background-image: url({{ asset('storage/case-study/'. $blog->blog_bg) }})" >
    <div class="breadcrumbs-inner text-center" style="padding: 50px 0px;">
        <h1 class="page-title new-title pb-10">{{ $blog->header }}</h1>
        <ul>
            <li title="QIA">
                <a class="active" href="{{ URL::to('/') }}">Home</a>
            </li>
            <li title="Go to Blog"><a class="active" href="{{ URL::to('case-study') }}">Case Study</a></li>
            <li>{{ $blog->header }}</li>
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
                        @foreach ($relatedPosts as $post)
                            <div class="recent-post-widget">
                                <div class="post-img">
                                    <a href="{{ $post->slug }}"><img src="{{ asset('storage/case-study/'. $post->cover_photo) }}" alt="{{ $post->cover_photo_alter_tag }}"></a>
                                </div>
                                <div class="post-desc">
                                    <a href="{{ $post->slug }}">{{ $post->header }} </a>
                                    <span class="date">
                                        <i class="fa fa-calendar"></i>
                                        {{ date('d F, Y', strtotime($post->created_at)) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-8 pr-35 md-pr-15">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-details">
                            <div class="bs-img mb-35">
                                <img src="{{ asset('storage/case-study/'. $blog->main_photo) }}" alt="{{ $blog->main_photo_alter_tag }}">
                            </div>
                            <div class="blog-full">
                                <ul class="single-post-meta">
                                    <li>
                                        <span class="p-date"><i class="fa fa-calendar-check-o"></i> {{ date('d F, Y', strtotime($blog->created_at)) }} </span>
                                    </li> 

                                        
                                    {{-- <li class="post-comment"> <i class="fa fa-comments-o"></i> 1</li> --}}
                                </ul>

                                <div id="blog_content">
                                    {!! $blog->content !!}
                                </div>

                                {{-- <h3 class="comment-title">Leave a Reply</h3>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <div class="comment-note">
                                    <div id="form-messages"></div>
                                    <form id="contact-form" method="post" action="mailer.php">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                                    <input class="from-control" type="text" id="name" name="name" placeholder="Name*" required="">
                                                </div> 
                                                <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                                    <input class="from-control" type="text" id="email" name="email" placeholder="E-Mail*" required="">
                                                </div>
                                                <div class="col-lg-12 mb-30">
                                                    <textarea class="from-control" id="message" name="message" placeholder="Your message Here" required=""></textarea>
                                                </div>
                                            </div>
                                            <div class="btn-part">
                                               <a class="readon learn-more post" href="#">Post Comment</a>
                                            </div> 
                                        </fieldset>
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
@endSection