@extends('front.core.layout')

@section('main')
    <div class="row neutral-bg" id="manga-main">
        <div class="manga-list-header">
            <h1>Listing des mangas</h1>
            <div class="search-box">
                <input type="text" name="search-field">
                <button class="search-action" data-search="title">Titre</button>
                <button class="search-action" data-search="feature">Tag</button>
                <button class="search-action" data-search="author">Auteur</button>
            </div>
        </div>
        <div id="manga-list" class="col-lg-12">
            @include('front.manga.manga-list')
        </div>
    </div>
@endsection

@push('after_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.search-action').on('click', function(event){
                var search = $('input[name="search-field"]').val(),
                    type = $(this).data('search');
                if (typeof search === 'Undefined') {
                    return;
                }
                $.ajax({
                    url: '{{ route('ajax-manga-get') }}',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        search: search,
                        type: type,
                        csrf: '{!! csrf_token() !!}',
                        action: 'filter'
                    },
                    success: function(response){
                        console.log(response);
                        if (response.error == 0) {
                            $('#manga-list').html(response.msg);
                        }
                    }
                });
            });
        });
    </script>
@endpush