@extends('layouts.frontend')
@section('content')

<style>
    #service_content ul {
        list-style: disc;
        margin: 0 0 1.5em 3em;
    }
</style>
<div class="qia-breadcrumbs img3" style="background:url('https://www.qi-a.com/storage/service/Inner-banner-image.jpg')">
    <div class="container">
        <div class="breadcrumbs-inner" style="padding: 50px 0px;">
            <ul class="breadcrumb-item">
                <li title="QI-A">
                    <a class="active" href="{{ URL::to('/') }}">Home</a>
                </li>
                <li>{{ $trainingContent->header }}</li>
            </ul>
            <h1 class="page-title">{{ $trainingContent->header }}</h1>
        </div>
    </div>
</div>

<div class="qia-services-single pt-120 pb-120 md-pt-80 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 md-mb-50" id="service_content">
                {!! $trainingContent->description !!}
            </div>
        </div> 
    </div> 
</div>
@endSection

@push('scripts')
    <script>
        
    </script>
@endPush