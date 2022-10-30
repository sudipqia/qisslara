@extends('layouts.frontend')
@section('content')
<div class="qia-breadcrumbs img4" style="background-image: url({{ asset('storage/about/'. get_option('blog_bg')) }});">
    <div class="breadcrumbs-inner text-center" style="padding: 50px 0px;">
        <h1 class="page-title">Learning Center</h1>
        <ul>
            <li title="QI-A">
                <a class="active" href="{{ URL::to('/') }}">Home</a>
            </li>
            <li>Learning Center</li>
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
                            <h3 class="title">Latest Post</h3>
                        </div>
                        @foreach ($blogs as $blog)
                            <div class="recent-post-widget">
                                <div class="post-img">
                                    <a href="{{ URL::to($blog->slug) }}"><img src="{{ asset('storage/blog/'. $blog->cover_photo) }}" alt="{{ $blog->cover_photo_alter_tag }}"></a>
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
                    <div class="categories mb-50">
                        <div class="widget-title">
                            <h3 class="Categories">Categories</h3>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ $category->slug }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="categories mb-50" style="padding: 20px 180px 20px 60px;">
                      <section id="media_image-2" class="widget widget_media_image loaded" style=""><a href="https://qi-a.com/document-control/"><img data-no-retina="" sizes="(max-width: 160px) 100vw, 160px" srcset="https://www.qi-a.com/storage/upload/are-you-looking-for-document-control-software_1660198551.jpg 160w, https://www.qi-a.com/storage/upload/are-you-looking-for-document-control-software_1660198551.jpg 80w" style="max-width: 100%; height: auto;" loading="lazy" alt="Are you looking for Document Control software?" src="https://www.qi-a.com/storage/upload/Are-you-looking-for-document-control-software_1660198032.jpg" height="600" width="180" padding="0px"></a></section>
                    </div>
                    <div class="categories mb-50">
                        <div class="widget-title">
                            <h3 class="Tags">Tags</h3>
                        </div>
                        <ul>
                            @foreach ($tags as $tag)
                                <span class="badge badge-primary">
                                    <a style="color:#fff;" href="{{ $tag->slug }}">{{ $tag->name }}</a>
                                </span>
                            @endforeach
                        </ul>
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
                                        <img style="width:358px;height:275px;" src="{{ asset('storage/blog/'. $blog->cover_photo) }}" alt="{{ $blog->cover_photo_alter_tag }}">
                                    </a>
                                    @php
                                        $blogCategory = App\BlogCategory::select('id', 'slug', 'name')->where('id', $blog->category_id)->first();
                                    @endphp
                                    @if ($blogCategory)
                                        <ul class="post-categories">
                                            <li>
                                                <a href="{{ $blogCategory->slug }}">{{ $blogCategory->name }}</a>
                                            </li>
                                        </ul>
                                    @endif
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
                                            @php
                                                $blogAuthor = App\BlogAuthor::select('id', 'name')->where('id', $blog->author_id)->first();
                                            @endphp
                                            @if ($blogAuthor)
                                                <li>
                                                    <div class="author">
                                                        <i class="fa fa-user-o"></i> {{ $blogAuthor->name }}  
                                                    </div>
                                                </li> 
                                            @endif
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