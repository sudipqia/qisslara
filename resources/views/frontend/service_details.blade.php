@extends('layouts.frontend')
@section('content')

<style>
    #service_content ul {
        list-style: disc;
        margin: 0 0 1.5em 3em;
    }

    #service-sticky-area {
        position: sticky;
        top: 10%;
    }
    
</style>

<div class="qia-breadcrumbs img3" style="background:url({{ asset('storage/service/'. $service->background_picture) }})">
    <div class="container">
        <div class="breadcrumbs-inner" style="padding: 50px 0px;">
            <ul>
                <li title="QI-A">
                    <a class="active" href="{{ URL::to('/') }}">Home</a>
                </li>
                <li>{{ $service->header }}</li>
            </ul>
            <h1 class="page-title">{{ $service->header }}</h1>
        </div>
    </div>
</div>

<div class="qia-services-single pt-120 pb-120 md-pt-80 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 md-mb-50">
                @php
                    $contents = App\ServiceContent::where('service_id', $service->id)->where('status', 1)->orderBy('position', 'ASC')->get();
                @endphp

                @foreach ($contents as $content)
                
                    @if ($content->content_type == 'Only Picture')

                        <div class="services-img mt-2">
                            @if ($content->another_tab == 1)
                                <a href="<?= $content->picture_link ?>" target="_blank">
                                    <img src="{{ asset('storage/service/'. $content->picture) }}" alt="{{ $content->picture_alter_tag }}">
                                </a>
                            @else 
                                <img src="{{ asset('storage/service/'. $content->picture) }}" alt="{{ $content->picture_alter_tag }}">
                            @endif
                        </div>

                    @elseif ($content->content_type == 'Only Content')

                        <div id="service_content">
                            {!! $content->content !!}
                        </div>    

                    @elseif($content->content_type == 'Left Side Picture')

                        <div class="row  mt-2">
                            <div class="col-md-6">
                                <div class="services-img">
                                    @if ($content->another_tab == 1)
                                        <a href="{{ $content->picture_link }}" target="_blank">
                                            <img src="{{ asset('storage/service/'. $content->picture) }}" alt="{{ $content->picture_alter_tag }}">
                                        </a>
                                    @else 
                                        <img src="{{ asset('storage/service/'. $content->picture) }}" alt="{{ $content->picture_alter_tag }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="service_content">
                                    {!! $content->content !!}
                                </div>  
                            </div>
                        </div>

                    @elseif($content->content_type == 'Right Side Picture')
                        
                        <div class="row  mt-2">
                            <div class="col-md-6">
                                <div id="service_content">
                                    {!! $content->content !!}
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="services-img">
                                    @if ($content->another_tab == 1)
                                        <a href="{{ $content->picture_link }}" target="_blank">
                                            <img src="{{ asset('storage/service/'. $content->picture) }}" alt="{{ $content->picture_alter_tag }}">
                                        </a>
                                    @else 
                                        <img src="{{ asset('storage/service/'. $content->picture) }}" alt="{{ $content->picture_alter_tag }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    @endif
                @endforeach
            </div>

            <!--<div class="col-lg-4 pl-32 md-pl-15">-->
            <!--    <div id="service-sticky-area">-->
            <!--        <ul class="services-list">-->
            <!--            @foreach ($relatedServices as $item)-->
            <!--                <li>-->
            <!--                    <a class="{{ $item->id == $service->id ? 'active' : '' }}" href="{{ $item->slug }}">-->
            <!--                        {{ $item->header }}-->
            <!--                    </a>-->
            <!--                </li>-->
            <!--            @endforeach-->
            <!--        </ul>-->
            <!--        {{-- <div class="services-add mb-50 mt-50">-->
            <!--            <div class="address-item mb-35">-->
            <!--                <div class="address-icon">-->
            <!--                    <i class="fa fa-phone"></i>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <h2 class="title">Have any Questions? <br> Call us Today!</h2>-->
            <!--            <div class="contact">-->
            <!--                <a href="tel:{{ get_option('phone') }}">{{ get_option('phone') }}</a>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="brochures">-->
            <!--            <h3>Brochures</h3>-->
            <!--            <p>-->
            <!--                Cras enim urna, interdum nec por ttitor vitae, sollicitudin eu erosen. Praesent eget mollis nulla sollicitudin.-->
            <!--            </p>-->
            <!--            <div class="pdf-btn">-->
            <!--                <a class="readon learn-more pdf" href="contact.html">Download Now<i class="fa fa-file-pdf-o"></i></a>-->
            <!--            </div>-->
            <!--        </div> --}}-->
            <!--    </div>-->
            <!--</div>-->
        </div> 
    </div> 
</div>
@endSection

@push('scripts')
    <script>
        
    </script>
@endPush