<!DOCTYPE html>
<html lang="en-US" class>  
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="referrer" content="origin">
        <title>{{ $meta->title }}</title>
        <meta name="description" content="{{ $meta->meta_description }}">
        <link rel="canonical" href="{{ Request::url() }}" />
        <!--<link rel=alternate href="https://www.qi-a.com" hreflang=en-US />-->
        <link rel="icon" type="image/png" href="{{ asset('storage/logo/'. get_option('favicon')) }}">
        <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
        <meta name="google-site-verification" content="jDuDbVHWdvLqEozHeXP1WaMogup96b5tmJMABcckKaI" />

        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-language" content="en">
        <meta property="og:image:width" content="200">
        <meta property="og:image:height" content="200">
        <meta property="og:site_name" content="{{ get_option('company_name') }}">
        

        <meta name="author" content="{{ get_option('company_name') }} : {{ Request::root() }} : {{ get_option('email') }}">
        <meta name="keywords" content="{{ $meta->meta_keyword }}" />
        <meta property="article:tag" content="{{ $meta->article_tag }}">
        

        <!-- For Open Graph -->
        <meta property="og:url" content="{{ Request::fullUrl() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $meta->meta_title }}">
        <meta property="og:description" content="{{ $meta->meta_description }}">
        <meta property="og:image" content="{{ asset('storage/logo/'. get_option('logo')) }}">

        <!-- For Twitter -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:creator" content="{{ get_option('company_name') }}" />
        <meta name="twitter:title" content="{{ $meta->meta_title }}" />
        <meta name="twitter:description" content="{{ $meta->meta_description }}" />
        <meta name="twitter:site" content="{{ Request::fullUrl() }}" />
        <meta name="twitter:image" content="{{ asset('storage/logo/'. get_option('logo')) }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/flaticon.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/boxicons.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/popup.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/off-canvas.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/menu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/spacing.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
        
        
        <script type="application/ld+json">{"@context":"http://schema.org","@type":"LocalBusiness","name":"Quality Institute of America-QIA","image":"https://www.qi-a.com/storage/logo/GF2m8LhsIWbF3qF3eWhnmIZoJLowjpJ2G4x5Biy8.png","telephone":"(888) 507-0619","email":"sales@qi-a.com","address":{"@type":"PostalAddress","streetAddress":"17625 El Camino Real, Suite 395","addressLocality":"Houston","addressRegion":"Texas","addressCountry":"United States","postalCode":"77058"},"openingHoursSpecification":{"@type":"OpeningHoursSpecification","dayOfWeek":{"@type":"DayOfWeek","name":"Mo,Tu,We,Th,Fr"},"opens":"09:00","closes":"15:00"},"url":"https://qi-a.com/","aggregateRating":{"@type":"AggregateRating","ratingValue":"5","bestRating":"5","worstRating":"4","ratingCount":"270"}}</script>

        <script type="application/ld+json" class="yoast-schema-graph">{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"https://qi-a.com/#organization","name":"Quality Institute of America-QIA","url":"https://qi-a.com/","sameAs":[],"logo":{"@type":"ImageObject","@id":"https://qi-a.com/#logo","inLanguage":"en-US","url":"https://www.qi-a.com/storage/logo/GF2m8LhsIWbF3qF3eWhnmIZoJLowjpJ2G4x5Biy8.png","contentUrl":"https://www.qi-a.com/storage/logo/GF2m8LhsIWbF3qF3eWhnmIZoJLowjpJ2G4x5Biy8.png","width":100,"height":83,"caption":"Quality Institute of America"},"image":{"@id":"https://qi-a.com/#logo"}},{"@type":"WebSite","@id":"https://qi-a.com/#website","url":"https://qi-a.com/","name":"QIA","description":"Quality Management System - QMS Software and Tools. QISS Quality Management Software has been created to ensure that your QMS complies with the requirements of ISO in a fast and easy way","publisher":{"@id":"https://qi-a.com/#organization"},"potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"https://qi-a.com/?s={search_term_string}"},"query-input":"required name=search_term_string"}],"inLanguage":"en-US"},{"@type":"ImageObject","@id":"https://qi-a.com/#primaryimage","inLanguage":"en-US","url":"https://www.qi-a.com/storage/logo/GF2m8LhsIWbF3qF3eWhnmIZoJLowjpJ2G4x5Biy8.png","contentUrl":"https://www.qi-a.com/storage/logo/GF2m8LhsIWbF3qF3eWhnmIZoJLowjpJ2G4x5Biy8.png","width":820,"height":360,"caption":"Quality Institute of America - QIA"},{"@type":"WebPage","@id":"https://qi-a.com/#webpage","url":"https://qi-a.com/","name":"QISS Quality Management Software | QIA","isPartOf":{"@id":"https://qi-a.com/#website"},"about":{"@id":"https://qi-a.com/#organization"},"primaryImageOfPage":{"@id":"https://qi-a.com/#primaryimage"},"datePublished":"2020-05-08T15:35:55+00:00","dateModified":"2022-04-21T17:41:40+00:00","description":"QISS Quality Management Software has been created to ensure that your QMS complies. With the requirements of ISO in a fast and easy way.","breadcrumb":{"@id":"https://qi-a.com/#breadcrumb"},"inLanguage":"en-US","potentialAction":[{"@type":"ReadAction","target":["https://qi-a.com/"]}]},{"@type":"BreadcrumbList","@id":"https://qi-a.com/#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home"}]}]}</script>
        
                
                <script type="text/javascript" id="cat-snippet">
                  (function(w, d, t, u, a, e, r) {
                    w.ContentAnalyticsToolObject = a;
                    w[a] =
                      w[a] ||
                      function() {
                        (w[a].q = w[a].q || []).push(arguments);
                      };
                    w[a].l = +new Date();
                  
                    e = d.createElement(t);
                    r = d.getElementsByTagName(t)[0];
                    e.async = 1;
                    e.src = u;
                    r.parentNode.insertBefore(e, r);
                  })(window, document, 'script', 'https://scatec.io/t/app.js?id=1c3782a2-79bf-4b5a-86c9-e614a8d9e4bc', 'cat');
                  cat('create', '1c3782a2-79bf-4b5a-86c9-e614a8d9e4bc');
                  cat('send', 'pageview');
                </script>
                
                
                
<!-- Global site tag (gtag.js) - Google Analytics -->

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-99728846-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-99728846-1');
        </script>
        
<!-- End - Google Analytics -->
        
    </head>
    <body class="defult-home">
        
		<!-- Main content -->
        <div class="main-content" style="background:#ffffff !important;">
            
            @include('_partials.frontend.header')

            @section('content')
            @show
        </div> 
     
        <!-- Footer -->
        @include('_partials.frontend.footer')

        <div id="scrollUp" class="orange-color">
            <i class="fa fa-angle-up"></i>
        </div>

        <!--<div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">-->
        <!--    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
        <!--      <span class="flaticon-cross"></span>-->
        <!--    </button>-->
        <!--    <div class="modal-dialog modal-dialog-centered">-->
        <!--        <div class="modal-content">-->
        <!--            <div class="search-block clearfix">-->
        <!--                <form method="GET" action="{{ url('search') }}">-->
        <!--                    <div class="form-group">-->
        <!--                        <input class="form-control" placeholder="Search Here..." name="search" type="text">-->
        <!--                    </div>-->
        <!--                </form>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <!-- modernizr js -->
        <script src="{{ asset('assets/js/modernizr-2.8.3.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/menu.js') }}"></script> 
        <script src="{{ asset('assets/js/jquery.nav.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('assets/js/points.min.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.min.js') }}"></script>   
        <script src="{{ asset('assets/js/particles.min.js') }}"></script>  
        <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>      
        <script src="{{ asset('assets/js/jquery.easypiechart.min.js') }}"></script>      
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/js/pointer.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        @stack('scripts')
    </body>
</html>