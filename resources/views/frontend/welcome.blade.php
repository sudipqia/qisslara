@extends('layouts.frontend')
@section('content')


<!-- Banner Section Start -->
<div class="qia-banner main-home pt-100 pb-100  md-pt-80 md-pb-80" style="background: url({{ asset('storage/logo/'. get_option('banner_background_picture')) }});" alt="QIA">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 pr-140 md-mb-70 md-pr-15">
                <div class="content-wrap">
                    <h1 class="it-title">{{ get_option('banner_header') }}</h1>
                    <div class="description">
                        <p class="desc">
                            {{ get_option('banner_sub_header') }}
                        </p>

                        <div id="get_demo_alert_area">
                            
                        </div>
                    </div>
                    
                    <p class="get-demo-form">
                        <input type="text" id="get_demo_email" placeholder="{{ get_option('banner_input_placeholder') }}">
                        <button type="button" id="get_demo_request">
                            {{ get_option('banner_button_text') }}
                        </button>
                    </p>
                </div>
            </div>
            
            
            <div class="col-lg-5 col-md-12 pl-70 md-pl-15">
                <div class="qia-contact main-media">
                    <div class="video-item" style="background: url({{ asset('storage/logo/'. get_option('banner_video_picture')) }});" alt="QIA">
                        <div class="qia-videos">
                            <div class="animate-border main-home style2">
                                <a class="popup-border content_management" data-url="{{ route('show-banner-video') }}" href="javascript:;">
                                {{-- <a class="popup-border" data-toggle="modal" data-target="#exampleModal" href="{{ get_option('banner_video_url') }}"> --}}
                                    <i class="fa fa-play" ></i>
                                </a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Copy until here -->

<style>
  html {
    font-size: 14px;
  }
  
  .container {
    font-size: 15px;
    color: #666666;
    /*font-family: "Open Sans";*/
  }

  .card-custom {
    overflow: hidden;
    min-height: 450px;
    box-shadow: 0 0 15px rgba(10, 10, 10, 0.3);
    background-image: linear-gradient(to right top, #CBEDEE, #F3F2F3);
    }

    .card-custom-img {
    height: 200px;
    min-height: 200px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    border-color: #e3f0f1;
    }

    /* First border-left-width setting is a fallback */
    .card-custom-img::after {
    position: absolute;
    content: '';
    top: 161px;
    left: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-top-width: 40px;
    border-right-width: 0;
    border-bottom-width: 0;
    border-left-width: 545px;
    border-left-width: calc(575px - 5vw);
    border-top-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    border-left-color: inherit;
    }

    .card-custom-avatar img {
    border-radius: 50%;
    box-shadow: 0 0 15px rgba(10, 10, 10, 0.3);
    position: absolute;
    top: 100px;
    left: 1.25rem;
    width: 100px;
    height: 100px;

    }
    .custom-head-su {

    position: absolute;
    top: 21px;
    left: 1.25rem;
    /* width: 100px; */
    height: 100px;
    font-size: 22px;
    color: #ffffff;

    }

</style>

<div class="container">
    <div class="row pt-5 m-auto">

        @php
            $cards = App\Card::get();
        @endphp
        @foreach ($cards as $card)
            <div class="col-md-6 col-lg-4 pb-3">
                <div class="card card-custom bg-white border-white border-0">
                    <div class="card-custom-img" style="background-image: url({{ asset('storage/home-page-content/'. $card->background_picture) }});" alt="QIA"></div>
                    <div class="card-custom-avatar">
                        <img class="img-fluid" src="{{ asset('storage/home-page-content/'. $card->icon) }}" alt="Avatar" />
                    </div>
                    <div class="card-body" style="overflow-y: auto">
                        <h2 class="custom-head-su">{{ $card->header }}</h2>
                        <p class="card-text">{{ $card->content }}</p>
                    </div>
                    <div class="card-footer" style="background: inherit; border-color: #e2eff0;">
                        <ul class="qia-features-list">
                            <li><i class="fa fa-check"></i><span>{{ $card->list_one }} </span></li>
                            <li><i class="fa fa-check"></i><span>{{ $card->list_two }}</span></li>
                            <li><i class="fa fa-check"></i><span>{{ $card->list_three }}</span></li>
                        </ul>
                        <a {{ $card->open_another_tab == 1 ? 'target="_blank"' : '' }} class="readon started mt-4" href="{{ $card->button_url }}">{{ $card->button_text }}</a>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</div>



<!-- <div class="qia-services main-home gray-color pt-50 pb-30 md-pt-80 md-pb-80">
    <div class="container pt-relative">
        <div class="row">
            @php
                $solutionCards = App\SolutionCard::get();
            @endphp
            @foreach ($solutionCards as $solutionCard)
                <div class="col-lg-4 col-md-12 mb-25">
                    <div class="services-item">
                        <h2 style="font-size: 22px;">{{ $solutionCard->header }}</h2>
                        <p>
                            {{ $solutionCard->sub_header }}
                        </p>
                        <ul class="qia-features-list">
                            <li><i class="fa fa-check"></i><span>{{ $solutionCard->list_one }} </span></li>
                            <li><i class="fa fa-check"></i><span>{{ $solutionCard->list_two }}</span></li>
                            <li><i class="fa fa-check"></i><span>{{ $solutionCard->list_three }}</span></li>
                            <li><i class="fa fa-check"></i><span>{{ $solutionCard->list_four }}</span></li>
                        </ul>

                        <a class="readon started mt-4" href="{{ $solutionCard->button_url }}" {{ $solutionCard->open_another_tab == 1 ? 'target="_blank"' : '' }}>{{ $solutionCard->button_text }}</a>
                    </div> 
                </div>
            @endforeach
        </div>
    </div>
</div> -->



<!-- Solution Card Start -->

<!-- Solution Card End -->

<!-- Get Demo Section Start -->
<div class="qia-cta style1 bg7 pt-80 pb-80" style="background: url({{ asset('storage/logo/'. get_option('get_demo_background_picture')) }});" alt="QIA">
    <div class="container">
        <div class="cta-wrap">
            <div class="row align-items-center">
                <div class="col-lg-9 col-md-12 md-mb-30">
                    <span>{{ get_option('get_demo_title') }}</span>
                    <div class="title-wrap">
                        <h3 class="epx-title">{{ get_option('get_demo_header') }}</h3>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-12">
                    <div class="button-wrap">
                        <a class="readon learn-more" {{ get_option('get_demo_open_another_tab') == 1 ? 'target="_blank"' : '' }} href="{{ get_option('get_demo_button_url') }}">{{ get_option('get_demo_button_text') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Get Demo Section End -->

<!-- Client Partner Section Start -->
<div class="qia-partner style4 pb-20" style="background-color: #ffff;" >
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 text-center pt-3">
                <h4 style="font-size: 23px !important;font-weight: bold;" >{{ get_option('banner_client_partner_text') }}</h4>
            </div>
            <div class="col-lg-8">
                <div class="qia-carousel owl-carousel" data-autoplay="true" data-loop="true" data-items="4" data-smart-speed="1000" data-hoverpause="false" data-nav-speed="true"  data-autoplay-timeout="2500" >
                    @php
                        $clientPartners = App\ClientPartner::get();
                    @endphp
                    @foreach ($clientPartners as $clientPartner)
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="javascript:;">
                                    <img src="{{ asset('storage/home-page-content/'. $clientPartner->picture) }}" alt="{{ $clientPartner->alt_tag }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Client Partner Section End -->

<!-- Solution Section Start -->
<div class="qia-about gray-color bg13  style3 pt-80 pb-80 md-pt-75 md-pb-80">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 pl-32 md-pl-15">
                <ul class="services-list">
                    @php
                        $solutions = App\Solution::select('id', 'title')->get();
                    @endphp

                    @foreach ($solutions as $solution)
                        <li><a href="javascript:;" data-id="{{ $solution->id }}" class="solution_content">{{ $solution->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-7 mx-auto md-mb-40">
                <div id="solution_content">
                    <div class="process-wrap bg3" style="padding:20px 40px 75px 20px">
                        <div class="sec-title mb-30">
                            <div class="sub-text new">{{ get_option('solution_title') }}</div>
                            <h5 class="title white-color">
                                {{ get_option('solution_heading') }}
                            </h5>
                            <p class="white-color mt-4">{{ nl2br(get_option('solution_content')) }}</p>
                        </div>
                        <div class="btn-part mt-40">
                            <a class="readon learn-more contact-us" {{ get_option('solution_button_open_in_another_tab') == 1 ? 'target="_blank"' : '' }} href="{{ get_option('solution_button_url') }}">{{ get_option('solution_button_text') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Solution Section End -->

<div class="qia-services gray-color main-home style2 pt-120 pb-120 md-pt-80 md-pb-80">
    <div class="container">
        <div class="sec-title2 text-center mb-45">
            <h5 class="title title2">
                {{ get_option('service_header') }}
            </h5>
        </div>
        <div class="row">

            @php
                $services = App\HomePageContent::get();
            @endphp
            @foreach ($services as $service)

                <div class="col-lg-4 col-md-4 mb-3">
                    <div class="services-item">
                        <div class="services-icon">
                            <div class="image-part">
                                <a {{ $service->open_another_tab == 1 ? 'target="_blank"' : '' }} href="{{ $service->button_url }}">
                                     <img src="{{ asset('storage/home-page-content/'. $service->icon) }}" alt="Icon Image">  
                                </a>
                            </div>
                        </div>
                        <div class="shape-part">
                            <img class="move-y" src="{{ asset('img/shape.png') }}" alt="">
                        </div>
                        <div class="services-content">
                            <div class="services-text">
                                <h3 class="services-title">
                                    <a {{ $service->open_another_tab == 1 ? 'target="_blank"' : '' }} href="{{ $service->button_url }}">
                                        {{ $service->header }}
                                    </a>
                                </h3>
                            </div>
                            <div class="services-desc">
                                <p>
                                    {{ $service->content }}
                                </p>
                            </div>
                        </div>
                    </div> 
                </div>
                
            @endforeach

            {{-- <div class="col-md-12 mt-5 text-center">
                <a {{ get_option('service_button_open_another_tab') == 1 ? 'target="_blank"' : '' }} class="readon learn-more contact-us" href="{{ get_option('service_button_url') }}">{{ get_option('service_button_text') }}</a>
            </div> --}}
        </div>
    </div>
</div>


<!-- About Section -->
<div class="qia-about pt-120 pb-120 bg13  md-pt-80 md-pb-80">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="home8-about z-index-1">
                    <img src="{{ asset('storage/logo/'. get_option('home_about_picture')) }}" alt="{{ get_option('home_about_alt_tag') }}">
                </div>
            </div>
            <div class="col-lg-6 pl-60 md-pl-15">
                <div class="contact-wrap">
                    <div class="sec-title mb-30">
                        <div class="sub-text style-bg">{{ get_option('home_about_title') }}</div>
                        <h4 class="title pb-38">
                            {{ get_option('home_about_header') }}
                        </h4>
                        <div class="desc pb-35">
                           {{ get_option('home_about_content') }}
                        </div>
                    </div>
                    <div class="btn-part">
                        <a class="readon learn-more" {{ get_option('home_about_btn_open_another_tab') == 1 ? 'target="_blank"' : '' }} href="{{ get_option('home_about_btn_url') }}">{{ get_option('home_about_btn_text') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="qia-about pt-120 pb-120 bg13  md-pt-80 md-pb-80">
    <div class="container">
        {{-- <div class="sec-title6 mb-50 text-center">
            <h6 class="title">Upcoming Events</h6>
        </div> --}}
        <div class="row align-items-center">
            <!--<div class="col-md-3">-->
            <!--    <ul style="cursor: pointer;text-align:center;" class="list-group">-->
                    @php
                        $eventCategoryId = null;
                        $eventCategories = App\TrainingCategory::select('id', 'name')->where('status', 1)->where('archive', 0)->orderBy('id', 'DESC')->get();
                        $eventCategoryCounter = 1;
                    @endphp
                    @foreach ($eventCategories as $evemtCategpru)
                        @php
                            if($eventCategoryCounter == 1) {
                                $eventCategoryId = $evemtCategpru->id;
                            }
                        @endphp
                        <!--<li data-id="{{ $evemtCategpru->id }}" class="list-group-item event-category {{ $eventCategoryCounter == 1 ? 'event-active' : '' }}">-->
                        <!--    <i class="fa fa-calendar-o"></i> <br>-->
                        <!--    <h6 class="mt-2">{{ $evemtCategpru->name }}</h6>-->
                        <!--</li>-->
                        @php
                            
                            $eventCategoryCounter += 1;
                        @endphp
                    @endforeach
            <!--    </ul>-->
            <!--</div>-->
            <div class="col-md-12" id="trainings_details_area">
                <div class="row">
                    @php
                        function rand_color() {
                            return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        }
                        $trainings = App\Training::where('category_id', $eventCategoryId)->where('status', 1)->where('archive', 0)->get();
                    @endphp                 
                    @foreach ($trainings as $trainingItem)
                        <div class="col-md-12">
                            <div class="card flex-row">
                                <!--<div class="card-body event-date" style="background-color: {{ rand_color() }};">-->
                                    
                                <!--    <h4 style="color:white;">-->
                                <!--        {{ $trainingItem->event_date }}-->
                                <!--    </h4>-->
                                    
                                <!--    <h5 style="color:white;">{{ $trainingItem->start_time }} - {{ $trainingItem->end_time }}</h5>-->
                                <!--</div>-->
                                <img style="width:200px;" class="card-img-left example-card-img-responsive" src="{{ asset('storage/training/'. $trainingItem->picture) }}" alt="training"/>
                                <div class="card-body">
                                    <a href="{{ $trainingItem->slug }}">
                                        <h4 class="card-title h5 h4-sm">{{ $trainingItem->header }}</h4>
                                    </a>
                                    <p class="card-text text-justify">{{ nl2br($trainingItem->sub_header) }}</p>

                                    <div class="text-right">
                                        <button data-url="{{ URL::to('book-training', $trainingItem->id) }}" class="btn btn-sm btn-primary book_event">
                                            Register <i class="fa fa-check fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonial Section -->
<div class="qia-testimonial style8 gray-color pt-30 pb-50 md-pt-80 md-pb-80">
    <div class="container">
        <div class="sec-title6 mb-50 text-center">
            <span class="sub-text new-text">{{ get_option('testimonial_title') }}</span>
            <h5 class="title">{{ get_option('testimonial_header') }}</h5>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="testimonial-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="2" data-md-device-nav="false" data-md-device-dots="true">

                    @php
                        $testimonials = App\Testimonial::get();
                        $testimonialCounter = 1;
                    @endphp
                    @foreach ($testimonials as $testimonial)
                        @if ($testimonialCounter == 1)
                            @php
                                $testimonialName = $testimonial->name;
                                $testimonialDesignation = $testimonial->designation;
                                $testimonialLink = $testimonial->id;
                                $testimonialCounter += 1;
                            @endphp
                        @endif
                        <div class="testi-item" data-id="{{ $testimonial->id }}">
                            
                            <div class="item-content-basic">

                                <div class="testi-information mb-3">
                                    {{-- <div class="img-part">
                                        <img src="assets/images/testimonial/style2/3.jpg" alt="Images">
                                    </div> --}}
                                    <div class="testi-content pl-0">
                                        <div class="testi-name">{{ $testimonial->name }}</div>
                                        <span class="testi-title">{{ $testimonial->designation }}</span>
                                    </div>
                                </div>

                                <span><img src="{{ asset('storage/home-page-content/'. $testimonial->rating) }}" alt="Rating Images"></span>
                                <p>{{ $testimonial->content }}</p>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="qia-contact mod1">
                    <div class="contact-wrap" style="padding: 0;;" id="testimonial_content">
                        <img src="storage/home-page-content/EeOtq5mPasiYvpjBryAVxFL5paxVjnFQOgoS38g5.png" alt="">
                        <div class="qia-videos">
                            <div class="animate-border main-home">
                                <h4 class="testimonial-h4">{{ $testimonialName }}</h4>
                                <h5 class="testimonial-h6">{{ $testimonialDesignation }}</h5>
                                <a style="left: 50%;top: 30%;" class="popup-border popup-videos content_management" href="javascript:;" data-url="{{ url('show-banner-video?id='. $testimonialLink) }}">
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Case Study Section -->
<div class="qia-case-study primary-background">
    <div class="row margin-0 align-items-center">
        <div class="col-lg-4 padding-0">
            <div class="case-study bg12 mod" style="background: url({{ asset('storage/logo/'. get_option('case_study_bg_picture')) }});" alt="QIA">
                <div class="sec-title2 mb-30">
                    <div class="sub-text white-color">{{ get_option('case_study_title') }}</div>
                    <h5 class="title testi-title white-color pb-20">
                        {{ get_option('case_study_header') }}
                    </h5>
                    <div class="desc-big">
                       {{ get_option('case_study_content') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 padding-0">
            <div class="case-study-wrap">
                <!-- Project Section Start -->
                <div class="qia-project style3 modify1 mod md-pt-0">
                    <div class="qia-carousel owl-carousel" data-loop="false" data-items="4" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="3" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="4" data-md-device-nav="true" data-md-device-dots="false">
                        @php
                            $caseStudies = App\CaseStudy::get();
                        @endphp
                        @foreach ($caseStudies as $caseStudy)
                            <div class="project-item">
                                <div class="project-img">
                                    <a href="{{ $caseStudy->link }}" {{ $caseStudy->open_another_tab == 1 ? 'target="_blank"' : '' }} ><img src="{{ asset('storage/home-page-content/'. $caseStudy->picture) }}" alt="{{ $caseStudy->alt_tag }}"></a>
                                </div>
                                <div class="project-content">
                                    <div class="portfolio-inner">
                                        <h3 class="title"><a href="{{ $caseStudy->link }}" {{ $caseStudy->open_another_tab == 1 ? 'target="_blank"' : '' }}>{{ $caseStudy->header }}</a></h3>
                                        <span class="category"><a href="{{ $caseStudy->link }}" {{ $caseStudy->open_another_tab == 1 ? 'target="_blank"' : '' }}>{{ $caseStudy->title }}</a></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Project Section End -->
            </div>
        </div>
    </div>
</div>

<!-- Pricing section start -->
{{-- <-- <div class="qia-pricing style2  modify1  gray-color pt-110 pb-150 md-pt-75 md-pb-80">
    <div class="container">
        <div class="sec-title2 text-center mb-30">
            <div class="sub-text">Pricing</div>
            <h4 class=" title title5 pb-20">
                Choose your pricing plan
            </h4>
        </div>
       <div class="row">
           <div class="col-lg-4 md-pb-30">
               <div class="pricing-table table-btn">
                   <div class="pricing-badge secondary-bg">
                       Silver
                   </div>
                   <div class="pricing-icon">
                       <img src="assets/images/pricing/main-home/style2/1.png" alt="">
                   </div>
                   <div class="pricing-table-price">
                        <div class="pricing-table-bags">
                            <span class="pricing-currency">$</span>
                            <span class="table-price-text">29.99</span>
                            <span class="table-period">Monthly Package</span>
                        </div>
                   </div>
                   <div class="pricing-table-body">
                       <ul>
                           <li><i class="fa fa-check"></i><span>Powerful Admin Panel</span></li>
                           <li><i class="fa fa-check"></i><span>1 Native Android App</span></li>
                           <li><i class="fa fa-close"></i><span>Multi-Language Support</span></li>
                           <li><i class="fa fa-check"></i><span>Support via E-mail and Phone</span></li>
                       </ul>
                   </div>
                   <div class="btn-part">
                       <a class="readon buy-now table-btn" href="shop-single.html">Buy Now</a>
                   </div>
               </div>
           </div>
           <div class="col-lg-4 md-pb-30">
               <div class="pricing-table">
                   <div class="pricing-badge secondary-bg">
                       Gold
                   </div>
                   <div class="pricing-icon">
                       <img src="assets/images/pricing/main-home/style2/2.png" alt="">
                   </div>
                  <div class="pricing-table-price">
                       <div class="pricing-table-bags">
                           <span class="pricing-currency">$</span>
                           <span class="table-price-text">39.99</span>
                           <span class="table-period">Monthly Package</span>
                       </div>
                  </div>
                   <div class="pricing-table-body">
                       <ul>
                            <li><i class="fa fa-check"></i><span>Powerful Admin Panel</span></li>
                            <li><i class="fa fa-check"></i><span>2 Native Android App</span></li>
                            <li><i class="fa fa-check"></i><span>Multi-Language Support</span></li>
                            <li><i class="fa fa-check"></i><span>Support via E-mail and Phone</span></li>
                       </ul>
                   </div>
                   <div class="btn-part">
                       <a class="readon buy-now table-btn" href="shop-single.html">Buy Now</a>
                   </div>
               </div>
           </div>
           <div class="col-lg-4">
               <div class="pricing-table">
                   <div class="pricing-badge secondary-bg">
                       Platinum
                   </div>
                   <div class="pricing-icon">
                       <img src="assets/images/pricing/main-home/style2/3.png" alt="">
                   </div>
                    <div class="pricing-table-price">
                         <div class="pricing-table-bags">
                             <span class="pricing-currency">$</span>
                             <span class="table-price-text">79.99</span>
                             <span class="table-period">Monthly Package</span>
                         </div>
                    </div>
                   <div class="pricing-table-body">
                       <ul>
                            <li><i class="fa fa-check"></i><span>Powerful Admin Panel</span></li>
                            <li><i class="fa fa-check"></i><span>3 Native Android App</span></li>
                            <li><i class="fa fa-check"></i><span>Multi-Language Support</span></li>
                            <li><i class="fa fa-check"></i><span>Support via E-mail and Phone</span></li>
                       </ul>
                   </div>
                   <div class="btn-part">
                       <a class="readon buy-now table-btn" href="shop-single.html">Buy Now</a>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div> --> --}}
<!-- Pricing section end -->

<!-- Blog Section Start -->
<div id="qia-blog" class="qia-blog pt-110 pb-120 md-pt-75 md-pb-80">
    <div class="container">  
        <div class="sec-title2 text-center mb-30">
            <h4 class="title testi-title">
                {{ get_option('home_blog_header') }}
            </h4>
            <div class="desc">
                {!! nl2br(get_option('home_blog_content')) !!}
            </div>
        </div>
        <div class="qia-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="false" data-md-device-dots="false">
            @php
                $blogs = App\Blog::select('slug', 'cover_photo', 'created_at', 'category_id', 'author_id', 'header')->get()->random(4);
            @endphp
            @foreach ($blogs as $blog)
                <div class="blog-item">
                    <div class="image-wrap">
                        <a href="{{ $blog->slug }}">
                            <img style="width:370px;height:250px;" src="{{ asset('storage/blog/'. $blog->cover_photo) }}" alt="{{ $blog->cover_photo_alter_tag }}">
                        </a>
                        @php
                            $blogCategory = App\BlogCategory::where('id', $blog->category_id)->first();
                        @endphp
                        @if ($blogCategory)
                            <ul class="post-categories">
                                <li><a href="{{ $blogCategory->slug }}">{{ $blogCategory->name }}</a></li>
                            </ul>
                        @endif
                    </div>
                    <div class="blog-content">
                    <ul class="blog-meta">
                        <li class="date"><i class="fa fa-calendar-check-o"></i> {{ date('d F, Y', strtotime($blog->created_at)) }}</li>
                        @php
                            $blogAuthor = App\BlogAuthor::where('id', $blog->author_id)->first();
                        @endphp
                        @if ($blogAuthor)
                            <li class="admin"><i class="fa fa-user-o"></i> {{ $blogAuthor->name }}</li>
                        @endif
                    </ul>
                    <h3 class="blog-title"><a href="{{ $blog->slug }}">{{ $blog->header }}</a></h3>
                    <div class="blog-button"><a class="text-muted" href="{{ $blog->slug }}">Details..</a></div>
                    </div>
                </div>
            @endforeach
            
            <!--{{-- <div class="blog-item">-->
            <!--    <div class="image-wrap">-->
            <!--        <a href="blog-details.html"><img style="width:370px;height:250px;" src="assets/images/2.jpg" alt=""></a>-->
            <!--        <ul class="post-categories">-->
            <!--            <li><a href="blog-details.html">Audit Management</a></li>-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--    <div class="blog-content">-->
            <!--       <ul class="blog-meta">-->
            <!--           <li class="date"><i class="fa fa-calendar-check-o"></i> 20 December 2020</li>-->
            <!--           <li class="admin"><i class="fa fa-user-o"></i> admin</li>-->
            <!--       </ul>-->
            <!--       <h3 class="blog-title"><a href="blog-details.html">Tech Products That Makes Its Easier to Stay at Home</a></h3>-->
            <!--       <div class="blog-button"><a class="text-muted" href="blog-details.html">Learn More</a></div>-->
            <!--    </div>-->
            <!--</div> --}}-->
            <!--{{-- <div class="blog-item">-->
            <!--    <div class="image-wrap">-->
            <!--        <a href="blog-details.html"><img style="width:370px;height:250px;" src="assets/images/3.jpg" alt=""></a>-->
            <!--        <ul class="post-categories">-->
            <!--            <li><a href="blog-details.html">Supplier Management</a></li>-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--    <div class="blog-content">-->
            <!--       <ul class="blog-meta">-->
            <!--           <li class="date"><i class="fa fa-calendar-check-o"></i> 22 December 2020</li>-->
            <!--           <li class="admin"><i class="fa fa-user-o"></i> admin</li>-->
            <!--       </ul>-->
            <!--       <h3 class="blog-title"><a href="blog-details.html">Open Source Job Report Show More Openings Fewer</a></h3>-->
            <!--       <div class="blog-button"><a class="text-muted" href="blog-details.html">Learn More</a></div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="blog-item">-->
            <!--    <div class="image-wrap">-->
            <!--        <a href="blog-details.html"><img style="width:370px;height:250px;" src="assets/images/4.jpg" alt=""></a>-->
            <!--        <ul class="post-categories">-->
            <!--            <li><a href="blog-details.html">Customer Survey</a></li>-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--    <div class="blog-content">-->
            <!--       <ul class="blog-meta">-->
            <!--           <li class="date"><i class="fa fa-calendar-check-o"></i> 26 December 2020</li>-->
            <!--           <li class="admin"><i class="fa fa-user-o"></i> admin</li>-->
            <!--       </ul>-->
            <!--       <h3 class="blog-title"><a href="blog-details.html">Types of Social Proof What its Makes Them Effective</a></h3>-->
            <!--       <div class="blog-button"><a class="text-muted" href="blog-details.html">Learn More</a></div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="blog-item">-->
            <!--    <div class="image-wrap">-->
            <!--        <a href="blog-details.html"><img style="width:370px;height:250px;" src="assets/images/5.jpg" alt=""></a>-->
            <!--        <ul class="post-categories">-->
            <!--            <li><a href="blog-details.html">Maintenance Management</a></li>-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--    <div class="blog-content">-->
            <!--       <ul class="blog-meta">-->
            <!--           <li class="date"><i class="fa fa-calendar-check-o"></i> 28 December 2020</li>-->
            <!--           <li class="admin"><i class="fa fa-user-o"></i> admin</li>-->
            <!--       </ul>-->
            <!--       <h3 class="blog-title"><a href="blog-details.html">Tech Firms Support Huawei Restriction, Balk at Cost</a></h3>-->
            <!--       <div class="blog-button"><a class="text-muted" href="blog-details.html">Learn More</a></div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="blog-item">-->
            <!--    <div class="image-wrap">-->
            <!--        <a href="blog-details.html"><img style="width:370px;height:250px;" src="assets/images/5.jpg" alt=""></a>-->
            <!--        <ul class="post-categories">-->
            <!--            <li><a href="blog-details.html">Calibration Management</a></li>-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--    <div class="blog-content">-->
            <!--       <ul class="blog-meta">-->
            <!--           <li class="date"><i class="fa fa-calendar-check-o"></i> 30 December 2020</li>-->
            <!--           <li class="admin"><i class="fa fa-user-o"></i> admin</li>-->
            <!--       </ul>-->
            <!--       <h3 class="blog-title"><a href="blog-details.html">Servo Project Joins The Linux Foundation Fold Desco</a></h3>-->
            <!--       <div class="blog-button"><a class="text-muted" href="blog-details.html">Learn More</a></div>-->
            <!--    </div>-->
            <!--</div> --}}-->
         </div>
    </div>
</div>
<!-- Blog Section End -->

<div class="modal fade" id="modal_remote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" id="remote_modal_content">
            
        </div>
    </div>
</div>

<div class="modal fade" id="book_modal_remote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" id="book_remote_modal_content">
            
        </div>
    </div>
</div>

@stop

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="{{asset('/css/parsley.css')}}">
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script>
        $(document).on('click', '.event-category', function() {
            let id = $(this).data('id');
            let url = '{{ URL::to("get-event-category") }}'
            $('.event-category').removeClass('event-active');
            $(this).addClass('event-active');
            $.ajax({
                type : 'GET',
                url : url,
                data : {
                    id : id
                },
                dataType: 'HTML',
                cache: false,
                success: function(html) {
                    $('#trainings_details_area').html(html);
                }
            })
        })

        $(document).on('click', '.book_event', function() {
            let url = $(this).data("url");
            $.ajax({
                type : 'GET',
                url : url,
                dataType: 'HTML',
                cache: false,
                success: function(html) {
                    $('#book_modal_remote').modal('show');
                    $('#book_remote_modal_content').html(html);
                    _modalFormValidation();
                }
            })
        })
       
        $(document).on('click', '.content_management', function() {
            let url = $(this).data("url");
            $.ajax({
                type : 'GET',
                url : url,
                dataType: 'HTML',
                cache: false,
                success: function(html) {
                    $('#modal_remote').modal('show');
                    $('#remote_modal_content').html(html);
                }
            })
        })

        document.addEventListener('click', function (e) {
            if(e.target.className === 'modal'){
            }else {
                $('#remote_modal_content').html("");
            }
        }, false);


        $(document).on('click', '.solution_content', function() {
            let id = $(this).data('id');
            $.ajax({
                type : 'GET',
                url : '{{ route("get_solution_details") }}',
                data: {
                    id : id
                },
                dataType: 'HTML',
                cache: false,
                success: function(html) {
                    $('#solution_content').html(html);
                }
            })
        })

        var _modalFormValidation = function() {
            if ($('#content_form').length > 0) {
                $('#content_form').parsley().on('field:validated', function() {
                    var ok = $('.parsley-error').length === 0;
                    $('.bs-callout-info').toggleClass('hidden', !ok);
                    $('.bs-callout-warning').toggleClass('hidden', ok);
                });
            }
            $('#content_form').on('submit', function(e) {
                e.preventDefault();
                $('#submit').hide();
                $('#submiting').show();
                $(".ajax_error").remove();
                var submit_url = $('#content_form').attr('action');
                //Start Ajax
                var formData = new FormData($("#content_form")[0]);
                $.ajax({
                    url: submit_url,
                    type: 'POST',
                    data: formData,
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == 'danger') {
                            toastr.error(data.message);

                        } else {
                            toastr.success(data.message)
                            $('#submit').show();
                            $('#submiting').hide();
                            $('#book_modal_remote').modal('toggle');

                            setTimeout(() => {
                                window.location.href="";
                            }, 2500);
                        }
                    },
                    error: function(data) {
                        var jsonValue = data.responseJSON;
                        const errors = jsonValue.errors;
                        if (errors) {
                            var i = 0;
                            $.each(errors, function(key, value) {
                                const first_item = Object.keys(errors)[i];
                                const message = errors[first_item][0];
                                if ($('#' + first_item).length > 0) {
                                    $('#' + first_item).parsley().removeError('required', {
                                        updateClass: true
                                    });
                                    $('#' + first_item).parsley().addError('required', {
                                        message: value,
                                        updateClass: true
                                    });
                                }

                                // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                                new PNotify({
                                    width: '30%',
                                    title: jsUcfirst(first_item) + ' Error!!',
                                    text: value,
                                    type: 'error',
                                    addclass: 'alert alert-danger alert-styled-left',
                                });
                                i++;
                            });
                        } else {
                            new PNotify({
                                width: '30%',
                                title: 'Something Wrong!',
                                text: jsonValue.message,
                                type: 'error',
                                addclass: 'alert alert-danger alert-styled-left',
                            });
                        }
                        $('#submit').show();
                        $('#submiting').hide();
                    }
                });
            });
        };
    </script>
@endpush