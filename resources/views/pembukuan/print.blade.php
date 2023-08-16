@php
    use Carbon\Carbon;
@endphp
@extends('layout.print')

@section('body')
    <main class="container text-center">
        <div class="mx-auto py-5">
            <div class="text-end">
                {{ Carbon::parse($request->startDate)->format('y/m/d') }}-{{ Carbon::parse($request->endDate)->format('y/m/d') }}
            </div>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Debit</th>
                        <th scope="col">Kredit</th>
                        <th scope="col">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($dLog) > 0)
                        @foreach ($dLog as $log)
                            <tr>
                                <td>{{ $log->created_at }}</td>
                                <td>{{ $log->desc }}</td>
                                @if ($log->money_in)
                                    <td>{{ to_rupiah($log->amount) }}</td>
                                    <td></td>
                                @else
                                    <td></td>
                                    <td>{{ to_rupiah($log->amount) }}</td>
                                @endif
                                <td>{{ to_rupiah($log->latest_amount) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Tidak ada data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
@endpush
