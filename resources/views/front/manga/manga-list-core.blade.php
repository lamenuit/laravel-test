@extends('front.core.layout')

@section('main')
    <p>ICI LE CONTENT DE MA SECTION</p>

    TEST DE MANGA
    <a href="{{ route('manga-view', ['id' => $mangas->id, 'slug' => 'test']) }}">LIEN VERS MANGA test</a>
@endsection