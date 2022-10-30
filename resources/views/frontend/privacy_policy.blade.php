@extends('layouts.frontend')
@section('content')
<div class="qia-breadcrumbs img1" style="background-image: url({{ asset('storage/about/'. get_option('privacy_policy_bg')) }});">
    <div class="breadcrumbs-inner text-center" style="padding: 50px 0px;">
        <h1 class="page-title">Privacy Policy</h1>
        <ul>
            <li title="QI-a">
                <a class="active" href="{{ URL::to('/') }}">Home</a>
            </li>
            <li>Privacy Policy</li>
        </ul>
    </div>
</div>

<div class="qia-about gray-color pt-120 pb-120 md-pt-80 md-pb-80">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 pl-60 md-pl-15">
                <div class="contact-wrap">
                    <div class="sec-title mb-30">
                        {!! get_option('privacy_policy_content') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <img class="top dance" src="images/dotted-3.png" alt="">
        </div>
    </div>
</div>
@endSection