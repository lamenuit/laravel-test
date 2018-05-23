@extends('front.core.layout')

@section('main')
    <p>ICI LE CONTENT DE MA SECTION</p>

    TEST DE MANGA
    @if (isset($mangas) && !empty($mangas))
        @foreach ($mangas as $manga)
            <a href="{{ route('manga-view', ['id' => $manga->id, 'slug' => 'test']) }}">LIEN VERS MANGA : {{$manga->title}}</a> <br>
        @endforeach
    @endif
@endsection