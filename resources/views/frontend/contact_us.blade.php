@extends('layouts.frontend')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('/css/parsley.css')}}">
<div class="qia-breadcrumbs img1" style="background-image:url({{ asset('storage/about/'. get_option('contact_bg')) }});">
    <div class="breadcrumbs-inner text-center" style="padding: 50px 0px;">
        <h1 class="page-title">Contact Us</h1>
        <ul>
            <li title="Contact Us">
                <a class="active" href="{{ URL::to('/') }}">Home</a>
            </li>
            <li>Contact Us</li>
        </ul>
    </div>
</div>

<div class="qia-contact pt-120 md-pt-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 md-mb-60">
               <div class="contact-box">
                    <div class="sec-title mb-45">
                        <span class="sub-text new-text white-color">{{ get_option('contact_title') }}</span>
                        <h2 class="title white-color">{{ get_option('contact_main_title') }}</h2>
                    </div>
                    <div class="address-box mb-25">
                        <div class="address-icon">
                           <i class="fa fa-home"></i>
                        </div>
                        <div class="address-text">
                            <span class="label">Email:</span>
                            <a href="mailto:{{ get_option('email') }}">{{ get_option('email') }}</a>
                        </div>
                   </div>
                   <div class="address-box mb-25">
                       <div class="address-icon">
                           <i class="fa fa-phone"></i>
                       </div>
                       <div class="address-text">
                           <span class="label">Phone:</span>
                           <a href="tel:{{ get_option('phone') }}">{{ get_option('phone') }}</a>
                       </div>
                   </div>
                   <div class="address-box">
                       <div class="address-icon">
                           <i class="fa fa-map-marker"></i>
                       </div>
                       <div class="address-text">
                           <span class="label">Address:</span>
                           <div class="desc">{{ get_option('address') }}</div>
                       </div>
                   </div>
               </div>
            </div> 
            <div class="col-lg-8 pl-70 md-pl-15">
                <div class="contact-widget">
                    <div class="sec-title2 mb-40">
                        <span class="sub-text contact mb-15">Get In Touch</span>
                        <h2 class="title testi-title">Fill The Form Below</h2>
                    </div>
                    <div id="form-messages"></div>
                    <form id="content_form" method="post" action="{{ URL::to('submit-contact-form')}}">
                        <input type="hidden" name="origin" id="origin" value="{{ isset($_GET['act']) && $_GET['act'] == 'get_demo' ? 1 : 0 }}">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12" id="contact_alert_area">
                                    
                                </div>
                                <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                    <input class="from-control" type="text" id="name" name="name" placeholder="Name" required="">
                                </div> 
                                <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                    <input class="from-control" type="text" id="email" name="email" placeholder="E-Mail" required="">
                                </div>   
                                <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                    <input class="from-control" type="text" id="phone" name="phone" placeholder="Phone Number" required="">
                                </div>   
                                <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                    <input class="from-control" type="text" id="website" name="website" placeholder="Company" required="">
                                </div>
                          
                                <div class="col-lg-12 mb-30">
                                    <textarea class="from-control" id="message" name="message" placeholder="Your message Here" required=""></textarea>
                                </div>
                            </div>
                            <div class="btn-part">                                            
                                <div class="form-group mb-0">
                                    <input class="readon learn-more submit" id="submit" type="submit" value="Submit">
                                    <input class="readon learn-more submit" disabled id="submiting" style="display: none;" type="button" value="Submitting...">
                                </div>
                            </div> 
                        </fieldset>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <div class="map-canvas pt-120 md-pt-80">
        <iframe src="{!! get_option('contact_page_google_map') !!}"></iframe>
    </div> 
</div>
@endSection


@push('scripts')
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var _formValidation = function() {
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
                            $('#contact_alert_area').html('<div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert"><strong>Warning! !</strong> '+ data.message +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                        } else {
                            $('#contact_alert_area').html('<div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">'+ data.message +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

                            setInterval(() => {
                                window.location.href="";
                            }, 3500);
                        }

                        setTimeout(() => {
                            $('.custom-alert').fadeOut();
                        }, 2500);

                        $('#submit').show();
                        $('#submiting').hide();
                    }
                });
            });
        };

        _formValidation();
    </script>
@endpush