<footer id="qia-footer" class="qia-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                    <div class="footer-logo mb-30">
                        <a href="https://www.qi-a.com/"><img src="{{ asset('storage/logo/'. get_option('logo')) }}" alt="{{ get_option('logo_alter_tag') }}"></a>
                    </div>
                    <div class="textwidget pb-30">
                        <p>{{ get_option('footar_content') }}</p>
                    </div>
                    <ul class="footer-social md-mb-30">  
                        <li> 
                            <a href="{{ get_option('Facebook_link') }}" target="_blank"><span><i class="fa-brands fa-facebook-square"></i></span></a> 
                        </li>
                        <li> 
                            <a href="{{ get_option('twiter_link') }}" target="_blank"><span><i class="fa-brands fa-twitter"></i></span></a> 
                        </li>

                        <li> 
                            <a href="{{ get_option('youtube_link') }}" target="_blank"><span><i class="fa-brands fa-youtube"></i></i></span></a> 
                        </li>
                        <li> 
                            <a href="{{ get_option('google+_link') }}" target="_blank"><span><i class="fa-brands fa-linkedin"></i></span></a> 
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 pl-45 md-pl-15 md-mb-30">
                    <h4 style="margin-left:-10px;" class="widget-title">Our Modules</h4>
                    <ul class="site-map">
                        <li><a href="https://www.qi-a.com/document-control">Document Control</a></li>
                        <li><a href="https://www.qi-a.com/audit-management-software">Audit Management</a></li>
                        <li><a href="https://www.qi-a.com/supplier-management-software">Supplier Management</a></li>
                        <li><a href="https://www.qi-a.com/nonconformance-management-software">Nonconformance Management</a></li>
                        <li><a href="https://www.qi-a.com/capa-management-software">CAPA Management</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 md-mb-30">
                    <h5 style="margin-left:-10px;" class="widget-title">Contact Info</h5>
                    <ul class="address-widget">
                        <li>
                            <i class="flaticon-location"></i>
                            <div class="desc">{{ get_option('address') }}</div>
                        </li>
                        <li>
                            <i class="flaticon-call"></i>
                            <div class="desc">
                               <a href="tel:{{ get_option('phone') }}">{{ get_option('phone') }}</a>
                            </div>
                        </li>
                        <li>
                            <i class="flaticon-email"></i>
                            <div class="desc">
                                <a href="mailto:{{ get_option('email') }}">{{ get_option('email') }}</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <h6 class="widget-title">Newsletter</h6>
                    <p class="widget-desc">
                        {{ get_option('newsletter_content') }}

                        <div id="newsletter_alert_area"></div>
                    </p>
                    <p>
                        <input type="email" name="EMAIL" id="newsletter_email" placeholder="Your email address" required="">
                        <em class="paper-plane"><input type="submit" id="newsletter_request" value="Sign up"></em>
                        <i class="flaticon-send"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">                    
            <div class="row y-middle">
                <div class="col-lg-6 text-right md-mb-10 order-last">
                    <ul class="copy-right-menu">
                        <li><a href="{{ URL::to('about-us') }}">About Us</a></li>
                        <li><a href="{{ URL::to('news') }}">News</a></li>
                        <li><a href="{{ URL::to('case-study') }}">Case Study</a></li>
                        {{-- <li><a href="{{ URL::to('privacy-policy') }}">Privecy Policy</a></li> --}}
                        {{-- <li><a href="{{ URL::to('terms-and-condition') }}">Terms & Condition</a></li> --}}
                        <li><a href="{{ URL::to('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="copyright">
                        <p>&copy; {{ date('Y') }} All Rights Reserved. Developed By <a href="https://qi-a.com/">QIA</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>