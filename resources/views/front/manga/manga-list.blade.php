@if (isset($mangas) && !empty($mangas))
    @foreach ($mangas as $manga)
        <div class="manga-line">
            <div class="col-md-4">
                ICI IMAGE
            </div>
            <div class="col-md-8">
                <h3 class="tertiary-title">{{$manga->title}}</h3>
                <a href="{{ route('manga-view', ['id' => $manga->id, 'slug' => $manga->title]) }}">LIEN VERS MANGA</a> <br>
            </div>
        </div>
    @endforeach
@endif