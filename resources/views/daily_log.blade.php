<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembukuan - {{ $dailyLog->id }}</title>

    <style>
        .img {
            width: 100%;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>
                deskripsi
            </td>
            <td>:</td>
            <td>
                {{ $dailyLog->desc }}
            </td>
        </tr>
        <tr>
            <td>
                status
            </td>
            <td>:</td>
            <td>
                {{ $dailyLog->money_in ? 'uang masuk' : 'uang keluar' }}
            </td>
        </tr>
        <tr>
            <td>
                jumlah
            </td>
            <td>:</td>
            <td>
                {{ to_rupiah($dailyLog->amount) }}
            </td>
        </tr>
        <tr>
            <td>
                Bukti
            </td>
            <td>:</td>
            <td>
            </td>
        </tr>
    </table>
    @foreach ($dailyLog->images as $image)
        <img src="{{ asset('storage/' . $image->url) }}" class="img">
    @endforeach
</body>

</html>
