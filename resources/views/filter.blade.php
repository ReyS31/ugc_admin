@extends('layout.layout')

@section('body')
    <main class="container text-center">
        <div class="mx-auto py-5">
            @if ($type == 'pembukuan')
                <form class="border p-5" action="{{ route('pembukuan.index') }}" method="GET">
                    <h1 class="h3 mb-3 fw-normal">Pembukuan</h1>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                        <label for="startDate">Dari Tanggal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                        <label for="endDate">Sampai Tanggal</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">OK</button>
                </form>
            @else
                <form class="border p-5" action="{{ route('kegiatan.index') }}" method="GET">
                    <h1 class="h3 mb-3 fw-normal">Kegiatan</h1>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                        <label for="startDate">Dari Tanggal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                        <label for="endDate">Sampai Tanggal</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">OK</button>
                </form>
            @endif
        </div>
    </main>
@endsection
