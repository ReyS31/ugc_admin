@extends('layout.layout')

@section('body')
    <main class="container text-center">
        <div class="mx-auto py-5">
            @if ($type == 'pembukuan')
                <form class="border p-5" action="{{ route('pembukuan.index') }}" method="GET">
                    <h1 class="h3 mb-3 fw-normal">Pembukuan</h1>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="startDate" name="startDate">
                        <label for="startDate">Dari Tanggal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="endDate" name="endDate">
                        <label for="endDate">Sampai Tanggal</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">OK</button>
                </form>
            @else
                <form class="border p-5" action="{{ route('login') }}" method="POST">
                    <h1 class="h3 mb-3 fw-normal">Login sebagai Admin</h1>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="name@example.com">
                        <label for="email">Dari Tanggal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                </form>
            @endif
        </div>
    </main>
@endsection
