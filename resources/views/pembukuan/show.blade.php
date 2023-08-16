@extends('layout.print')

@section('body')
    <table>
        <tr>
            <td>
                Deskripsi
            </td>
            <td>:</td>
            <td>
                {{ $dailyLog->desc }}
            </td>
        </tr>
        <tr>
            <td>
                Tanggal
            </td>
            <td>:</td>
            <td>
                {{ $dailyLog->created_at->format('d M Y H:i:s') }}
            </td>
        </tr>
        <tr>
            <td>
                Status
            </td>
            <td>:</td>
            <td>
                {{ $dailyLog->money_in ? 'Uang masuk' : 'Uang keluar' }}
            </td>
        </tr>
        <tr>
            <td>
                Jumlah
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
