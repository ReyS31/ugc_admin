<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $dailyActivity->title }}</title>

    <style>
        .img {
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>{{ $dailyActivity->title }}</h1>
    <p>{{ $dailyActivity->description }}</p>
    @foreach ($dailyActivity->images as $image)
        <img src="{{ asset('storage/' . $image->url) }}" class="img">
    @endforeach
</body>

</html>
