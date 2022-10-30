@extends('layouts.frontend')
@section('content')
<style>
    /** Page Search
 *************************************************** **/
.search-result {
    padding:20px 0;
	border-bottom:#eee 1px solid;
}
.search-result h4 {
	margin:0;
	line-height:20px;
}
.search-result p {
	font-size:12px;
	margin:0; padding:0;
}
.search-result img {
	float:left; 
	margin-right:10px;
	margin-top:6px;
}
</style>

<div class="qia-breadcrumbs img3" style="background:url('https://www.qi-a.com/storage/service/Inner-banner-image.jpg')">
    <div class="container">
        <div class="breadcrumbs-inner" style="padding: 50px 0px;">
            <ul class="breadcrumb-item">
                <li title="QI-A">
                    <a class="active" href="{{ URL::to('/') }}">Home</a>
                </li>
                <li>{{ $searchText }}</li>
            </ul>
            <h1 class="page-title">Search Result for: {{ $searchText }}</h1>
        </div>
    </div>
</div>

<div class="qia-services-single pt-120 pb-120 md-pt-80 md-pb-80">
    <div class="container">
        <div class="row">
            @if (count($services))
                @foreach ($services as $item)
                    <div class="col-md-12">
                        <div class="clearfix search-result"><!-- item -->
                            <h4><a {{ $item->category_id == 4 ? 'target="_blank"' : '' }} href="{{ $item->slug }}">{{ $item->page_title }}</a></h4>
                            <small class="text-success">{{ date('m-d-Y h:i:s', strtotime($item->created_at)) }}</small>
                            <p>{!! $item->sub_header !!}</p>
                        </div>
                    </div>
                @endforeach
            @else 
                <div class="col-md-12">
                    <h4>Found 0 search results for "{{ $searchText }}"</h4>
                    <p>Sorry, we have not found any matches for your query.</p>
                </div>
            @endif
        </div> 
    </div> 
</div>
@endSection

@push('scripts')
    <script>
        
    </script>
@endPush