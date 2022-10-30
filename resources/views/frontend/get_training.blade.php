<div class="row">
    @php
        function rand_color() {
            return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }
    @endphp  
    @foreach ($trainings as $item)
        <div class="col-md-12">
            <div class="card flex-row">
                <div class="card-body event-date" style="background-color: {{ rand_color() }};">
                    <h4 style="color:white;">
                        {{ $item->event_date }}
                    </h4>
                    <h5 style="color:white;">{{ $item->start_time }} - {{ $item->end_time }}</h5>
                </div>
                <img style="width:250px;" class="card-img-left example-card-img-responsive" src="{{ asset('storage/training/'. $item->picture) }}"/>
                <div class="card-body">
                    <a href="{{ $item->slug }}">
                        <h4 class="card-title h5 h4-sm">{{ $item->header }}</h4>
                    </a>
                    <p class="card-text text-justify">{{ nl2br($item->sub_header) }}</p>
                    
                    <div class="text-right">
                        <button data-url="{{ URL::to('book-training', $item->id) }}" class="btn btn-sm btn-primary book_event">
                            Register <i class="fa fa-check fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach               
</div>