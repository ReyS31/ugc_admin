@extends('layout.layout')

@section('body')
    <main class="container text-center">
        <div class="mx-auto py-5">
            <div class="text-end">
                <a href="{{ route('kegiatan.create') }}" class="btn btn-success btn-lg">Tambah Data</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dAct as $act)
                        <tr>
                            <td>{{ $act->created_at }}</td>
                            <td>{{ $act->title }}</td>
                            <td>{{ $act->description }}</td>
                            <td> <a href="{{ route('kegiatan.show', ['dailyActivity' => $act]) }}"
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
