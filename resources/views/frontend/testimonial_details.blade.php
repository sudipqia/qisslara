<img src="{{ asset('storage/home-page-content/'. $model->picture) }}" alt="Testimonial Pictture">
<div class="qia-videos">
    <div class="animate-border main-home">
        <h4 class="testimonial-h4">{{ $model->name }}</h4>
        <h6 class="testimonial-h6">{{ $model->designation }}</h6>
        {{-- <a style="left: 50%;top: 35%;" class="popup-border testimonial-popup-videos" href="{{ $model->video_url }}">
            <i class="fa fa-play"></i>
        </a> --}}
        <a style="left: 50%;top: 30%;" class="popup-border popup-videos content_management" href="javascript:;" data-url="{{ url('show-banner-video?id='. $model->id) }}">
            <i class="fa fa-play"></i>
        </a>
    </div>
</div>

{{-- <script>
    var popupvideos = $('.testimonial-popup-videos');
    if(popupvideos.length){
        $('.testimonial-popup-videos').magnificPopup({
            disableOn: 10,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        }); 
    }
</script> --}}