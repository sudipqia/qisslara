@extends('layouts.frontend')
@section('content')
    <!-- Breadcrumbs Start -->
    <div class="qia-breadcrumbs img1" style="background-image: url({{ asset('storage/about/'. get_option('about_bg')) }})">
        <div class="breadcrumbs-inner text-center" style="padding: 50px 0px;">
            <h1 class="page-title">About Us</h1>
            <ul>
                <li title="QIA">
                    <a class="active" href="{{ URL::to('/') }}">Home</a>
                </li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->

    <!-- About Section Start -->
    <div class="qia-about gray-color pt-120 pb-120 md-pt-80 md-pb-80">
        <div class="container">
            <div class="row align-items-center">
                {{-- <div class="col-lg-6 md-mb-30">
                    <div class="qia-animation-shape">
                        <div class="images">
                           <img src="{{ asset('storage/about/'. get_option('about_image')) }}" alt="{{ get_option('about_image_alt_tag') }}"> 
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12 pl-60 md-pl-15">
                    <div class="contact-wrap">
                        <div class="sec-title mb-30">
                            <div class="images">
                                {{-- <img src="{{ asset('storage/about/'. get_option('about_image')) }}" alt="{{ get_option('about_image_alt_tag') }}">  --}}
                             </div>
                            <div class="sub-text style-bg">{{ get_option('about_header') }}</div>
                            <h2 class="title pb-38">
                                {{ get_option('about_string') }}
                            </h2>
                            <div class="desc">
                                {!! get_option('about_content') !!}
                            </div>
                        </div>
                        @if (get_option('about_button_url'))
                            <div class="btn-part">
                                <a {{ get_option('about_open_another_tab') == 1 ? 'target="_blank"' : '' }} class="readon learn-more" href="{{ get_option('about_button_url') }}">{{ get_option('about_button_text') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Section End -->
@endSection