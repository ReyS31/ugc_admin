@extends('layout.print')

@section('body')
    <h1>{{ $dailyActivity->title }}</h1>
    <p>{{ $dailyActivity->description }}</p>
    @foreach ($dailyActivity->images as $image)
        <img src="{{ asset('storage/' . $image->url) }}" class="mx-auto d-block" style="max-width: 75%">
    @endforeach
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
@endpush
