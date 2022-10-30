
<!-- About Section Start -->
@php
    $aboutSections = App\AboutContent::get();
    $aboutSectionCounter = 1;
@endphp
@foreach ($aboutSections as $aboutSection)
    @if ($aboutSectionCounter % 2 == 0)
        <div class="qia-about gray-color pt-50 pb-60 md-pt-80 md-pb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 md-mb-50">
                        <div class="images">
                            <img src="{{ asset('storage/home-page-content/'. $aboutSection->picture) }}" alt="{{ $aboutSection->alt_tab }}"> 
                        </div> 
                    </div>
                    <div class="col-lg-6 pl-60 md-pl-15">
                        <div class="contact-wrap">
                            <div class="sec-title mb-30">
                                <div class="sub-text style2">{{ $aboutSection->title }}</div>
                                <h2 class="title pb-38">
                                    {{ $aboutSection->header }}
                                </h2>
                                <p class="margin-0 pb-15">
                                    {{ $aboutSection->content }}
                                </p>
                            </div>
                            <div class="btn-part">
                                <a class="readon learn-more contact-us"  {{ $aboutSection->open_another_tab == 1 ? 'target="_blank"' : '' }} href="{{ $aboutSection->button_url }}">{{ $aboutSection->button_text }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="rs-about pt-50 pb-60 md-pt-80 md-pb-80">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 pl-60 md-pl-15">
                    <div class="contact-wrap">
                        <div class="sec-title mb-30">
                            <div class="sub-text style2">{{ $aboutSection->title }}</div>
                            <h2 class="title pb-38">
                                {{ $aboutSection->header }}
                            </h2>
                            <p class="margin-0 pb-15">
                                {{ $aboutSection->content }}
                            </p>
                        </div>
                        <div class="btn-part">
                            <a class="readon learn-more contact-us"  {{ $aboutSection->open_another_tab == 1 ? 'target="_blank"' : '' }} href="{{ $aboutSection->button_url }}">{{ $aboutSection->button_text }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 md-mb-50">
                    <div class="images">
                        <img src="{{ asset('storage/home-page-content/'. $aboutSection->picture) }}" alt="{{ $aboutSection->alt_tab }}"> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
    @endif
    @php
        $aboutSectionCounter++
    @endphp
@endforeach