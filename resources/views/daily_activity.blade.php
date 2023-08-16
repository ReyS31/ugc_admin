@extends('layout.layout')

@section('body')
    <h1>{{ $dailyActivity->title }}</h1>
    <p>{{ $dailyActivity->description }}</p>
    @foreach ($dailyActivity->images as $image)
        <img src="{{ asset('storage/' . $image->url) }}" class="img">
    @endforeach
@endsection
