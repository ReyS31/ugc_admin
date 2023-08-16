@extends('layout.layout')

@section('body')
    <main class="container text-center">
        <div class="mx-auto py-5">
            <div class="text-end">
                <button id="print" class="btn btn-primary btn-lg">Print</button>
                <a href="{{ route('pembukuan.create') }}" class="btn btn-success btn-lg">Tambah Data</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Debit</th>
                        <th scope="col">Kredit</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
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
                            <td> <a href="{{ route('pembukuan.show', ['dailyLog' => $log]) }}"
                                    class="btn btn-primary">Print</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#print').on('click', function() {
                window.location.href = window.location + "&print=ok"
            });
        });
    </script>
@endpush
