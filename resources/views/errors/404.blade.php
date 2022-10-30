
<!DOCTYPE html>
<html lang="zxx">  
    <head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>404 - QIA</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="{{ asset('storage/logo/'. get_option('favicon')) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/logo/'. get_option('favicon')) }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/flaticon.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/rs-spacing.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <![endif]-->
    </head>
    <body class="defult-home">

        <!-- Main content Start -->
        <div class="main-content"> 
            <div class="page-error">
                <div class="container">
                    <div class="error-not-found">
                        <div class="error-content">
                            <h2 class="title"><span>404</span>oops! page not found</h2>
                            <div class="btn-part">
                                <a href="{{ URL::to('/') }}" class="readon learn-more">Back To Homepage</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Main content End -->

        <script src="{{ asset('assets/js/modernizr-2.8.3.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nav.js') }}"></script>      
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>