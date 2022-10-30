<div class="full-width-header">
    <!--Header Start-->
    <header id="qia-header" class="qia-header style2 btn-style">

        <!-- TopBar Area Start -->
        <div class="topbar-area style2">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-8">
                        <ul class="topbar-contact">
                            <li>
                                <a href="tel:{{ get_option('phone') }}">
                                    <span>
                                        <i class='bx bxs-phone-call'></i>
                                    </span>
                                    {{ get_option('phone') }}
                                </a>
                            </li>
                            
                            <li>
                                
                                <a href="mailto:{{ get_option('email') }}">
                                    <span>
                                        <i class='bx bxs-envelope' ></i>
                                    </span>
                                    {{ get_option('email') }}    
                                </a>
                            </li>
                            <!--<li>-->
                                
                            <!--    <a style="border-right: none;" href="{{ get_option('address_link') }}" target="_blank">-->
                            <!--        <span>-->
                            <!--            <i class='bx bx-globe' ></i>-->
                            <!--        </span>-->
                            <!--        {{ get_option('address') }}-->
                            <!--    </a>-->
                            <!--</li>-->
                        </ul>
                    </div>
                    <div class="col-lg-4 text-right">
                       <div class="toolbar-sl-share">
                            <ul>
                                <li>
                                    <a href="{{ get_option('Facebook_link') }}" target="_blank">                                        
                                        <i class="fa-brands fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ get_option('twiter_link') }}" target="_blank">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ get_option('youtube_link') }}" target="_blank">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ get_option('google+_link') }}" target="_blank">
                                        <i class="fa-brands fa-linkedin"></i>
                                    </a>
                                </li>
                           </ul>
                       </div>
                    </div>
               </div>
           </div>
        </div>
        <!-- TopBar Area End -->

        

        <!-- Menu Start -->
        <div  class="menu-area menu-sticky">    
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 qi-a-logo-area">
                        <div class="logo-part">
                            <a href="{{ URL::to('/') }}"><img src="{{ asset('storage/logo/'. get_option('logo')) }}" alt="{{ get_option('logo_alter_tag') }}"></a>
                        </div>
                        <div class="mobile-menu">
                            <a href="javascript:;" class="qia-menu-toggle qia-menu-toggle-close secondary">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 qi-a-main-menu-area text-right">
                        <div class="qia-menu-area">
                            <div class="main-menu">
                                <nav class="qia-menu md-pr-0">
                                    <ul class="nav-menu">
                                        @php
                                            $serviceCategories = App\ServiceCategory::where('status', 1)->where('archive', 0)->orderBy('position', 'ASC')->get();
                                        @endphp
                                        @foreach ($serviceCategories as $category)
                                            <li class="qia-mega-menu menu-item-has-children current-menu-item"> 
                                                <a href="#">{{ $category->name }}</a>

                                                <ul style="margin-top: -22px;" class="mega-menu"> 
                                                    <li style="/* border-radius: 19px; */background-color: #ffffff;" class="mega-menu-container">
                                                        <div class="mega-menu-innner">

                                                            @php
                                                                $services = App\Service::select('page_title', 'slug')->where('category_id', $category->id)->where('status', 1)->where('archive', 0)->orderBy('position', 'ASC')->get()->toArray();
                                                                $nbCols = 3;
                                                                $nbRows = count($services)/$nbCols;
                                                                for($row=0; $row<$nbCols; $row++) {
                                                                    echo '<div class="single-megamenu"><ul class="sub-menu">';
                                                                    if($category->id == 5) {
                                                                            if ($row == 0) {
                                                                                echo '<li class="text-left"><a href="javascript:;" style="cursor:auto;"><b>Web Based Software  </b></a></li>';
                                                                            } elseif ($row == 1) {
                                                                                echo '<li class="text-left"><a href="javascript:;" style="cursor:auto;"><b>&nbsp;</b></a></li>';
                                                                            } else {
                                                                                echo '<li class="text-left"><a href="javascript:;" style="cursor:auto;">&nbsp;</a></li>';
                                                                            }
                                                                        }
                                                                    for($i=0; $i<$nbRows; $i++) {
                                                                        $arrayKey = $row + ($i*$nbCols);
                                                                        if(array_key_exists($arrayKey, $services)) {
                                                                            $index = $services[$arrayKey];
                                                                            $target = '';
                                                                            if($category->id == 4) {
                                                                                echo '<li><a target="_blank" href="'. URL::to($index['slug']) .'">'. $index['page_title'] .'</a></li>';
                                                                            } else {
                                                                                echo '<li><a href="'. URL::to($index['slug']) .'">'. $index['page_title'] .'</a></li>';
                                                                            }
                                                                            
                                                                        }
                                                                    }
                                                                    echo "</ul></div>";
                                                                }
                                                            @endphp
                                                            
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endforeach
                                        
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-15506">
                                            <a href="javascript:;">Training</a>
                                            <ul style="margin-top: -22px;" class="sub-menu">
                                                @php
                                                    $trainings = App\Training::select('slug', 'header')->where('status', 1)->where('archive', 0)->orderBy('header', 'ASC')->get();
                                                @endphp
                                                @foreach ($trainings as $training)
                                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15191">
                                                        <a href="{{ $training->slug }}">{{ $training->header }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        
                                       
                                        <li>
                                            <a href="{{ URL::to('learning-center') }}">Learning Center</a>
                                        </li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-15506">
                                            <a href="javascript:;">About Us</a>
                                            <ul style="margin-top: -22px;"  class="sub-menu">
                                                @php
                                                    $aboutContents = App\AboutUs::select('slug', 'page_title')->where('status', 1)->where('archive', 0)->orderBy('page_title', 'ASC')->get();
                                                @endphp
                                                @foreach ($aboutContents as $aboutContent)
                                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15191">
                                                        <a href="{{ $aboutContent->slug }}">{{ $aboutContent->page_title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="sidebarmenu-search">
                                            <a class="hidden-xs qia-search" data-target=".search-modal" data-toggle="modal" href="#">
                                                <i class="flaticon-search"></i>
                                            </a>
                                            <ul style="margin-top: -22px;margin-left:-220px;"  class="sub-menu">
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15191">
                                                    <a class="" href="javascript:;" >
                                                        <form style="width: 230px;margin-left: -25px;" method="GET" action="{{ url('search') }}">
                                                            <div class="form-group">
                                                                <input class="form-control" placeholder="Search Here..." name="search" type="text">
                                                            </div>
                                                        </form>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                   </ul>
                                </nav>                                         
                            </div> <!-- //.main-menu -->
                            <div class="expand-btn-inner search-icon hidden-md">
                                <ul>
                                    <!--<li class="sidebarmenu-search">-->
                                    <!--    <a class="hidden-xs qia-search" data-target=".search-modal" data-toggle="modal" href="#">-->
                                    <!--        <i class="flaticon-search"></i>-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                    <li><a class="quote-btn" href="{{ get_option('navbar_button_url') }}?act=get_demo">{{ get_option('navbar_button_text') }}</a></li>
                                </ul>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End --> 
    </header>
    <!--Header End-->
    
    <!-- Canvas Menu start -->
    <!--<nav class="right_menu_togle hidden-md">-->
    <!--    <div class="close-btn"><span id="nav-close" class="text-center"><i class="fa fa-close"></i></span></div>-->
    <!--    <div class="canvas-logo">-->
    <!--        <a href="{{ URL::to('/') }}"><img src="{{ asset('storage/logo/'. get_option('logo')) }}" alt="{{ get_option('logo_alter_tag') }}"></a>-->
    <!--    </div>-->
    <!--    <div class="offcanvas-text">-->
    <!--        <p>{{ get_option('footer_content') }}</p>-->
    <!--    </div>-->
    <!--    <div class="canvas-contact">-->
    <!--        <h5 class="canvas-contact-title">Contact Info</h5>-->
    <!--        <ul class="contact">-->
    <!--            <li><i class="fa fa-globe"></i>{{ get_option('address') }}</li>-->
    <!--            <li><i class="fa fa-phone"></i>{{ get_option('phone') }}</li>-->
    <!--            <li><i class="fa fa-envelope"></i><a href="mailto:{{ get_option('email') }}">{{ get_option('email') }}</a></li>-->
    <!--            <li><i class="fa fa-clock-o"></i>10:00 AM - 11:30 PM</li>-->
    <!--        </ul>-->
    <!--        <ul class="social">-->
    <!--            <li><a href="{{ get_option('Facebook_link') }}" target="_blank"><i class="fa fa-facebook"></i></a></li>-->
    <!--            <li><a href="{{ get_option('twitter_link') }}" target="_blank"><i class="fa fa-twitter"></i></a></li>-->
    <!--            <li><a href="{{ get_option('youtube_link') }}" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>-->
    <!--            <li><a href="{{ get_option('google+_link') }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--</nav>-->
    <!-- Canvas Menu end -->
</div>