@extends('front.core.layout')

@section('main')
    <h1>PAGE MANGA</h1>

    TEST DE MANGA

    @if (isset($pages) && !empty($pages))
        <div>
            <h2>Pages</h2>
            @foreach ($pages as $page)
                {{$page->id}}.{{$page->extension}} <br>
                <img src="{{asset('storage/'.$page->image)}}">
            @endforeach
        </div>
    @endif
@endsection