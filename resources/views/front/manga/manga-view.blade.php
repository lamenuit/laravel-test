@extends('front.core.layout')

@section('main')
    <div id="manga-page">
        <div id="manga-page-head">
            <h1 class="title">{{$manga->title}}</h1>
            <p class="subtitle">@if (isset($author) && !empty($author)) {{$author->name}} @endif</p>
        </div>

        @if (isset($pages) && !empty($pages))
            <div id="manga-page-body">
                <img id="image-display" src="{{asset('storage/'.$pages[0]->image)}}">
            </div>
        @endif
    </div>
@endsection

@push('after_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var pages = [
                @foreach ($pages as $page)
                    '{{$page->image}}',
                @endforeach
            ];
            var pointer = 0;
            var prefix  = '{{ asset('storage') }}';

            $(document).keypress(function(e) {
                var code = e.keyCode || e.which;
                if(code == 39 && pointer < (pages.length - 1)) { // right arrow
                    pointer++;
                    $('#image-display').attr('src', prefix+'/'+pages[pointer]);
                }
                if(code == 37 && pointer != 0) { // left arrow
                    pointer--;
                    $('#image-display').attr('src', prefix+'/'+pages[pointer]);
                }
            });
        })
    </script>
@endpush