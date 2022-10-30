<h4 >{{ $solution->title }}</h4>
{!! $solution->youtube_video !!}
<p>
    {{ nl2br($solution->content) }} <br><br>
    <a class="quote-btn" {{ $solution->open_another_tab == 1 ? 'target="_blank"' : '' }} href="{{ $solution->button_url }}">{{ $solution->button_text }}</a>
</p>