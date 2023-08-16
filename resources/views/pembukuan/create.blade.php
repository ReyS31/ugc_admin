@extends('layout.layout')

@section('body')
    <main class="container">
        <div class="mx-auto py-5">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <h2 class="text-center">Tambah Data Pembukuan</h2>
            <form class="row" method="POST" action="{{ route('pembukuan.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" id="deskripsi" class="form-control" name="desc"
                        aria-describedby="descriptionHelpBlock">
                    <div id="descriptionHelpBlock" class="form-text">
                        Deskripsi pemasukan/pengeluaran untuk apa atau dari mana.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Jumlah</label>
                    <input type="number" min="0" id="amount" name="amount" class="form-control"
                        aria-describedby="amountHelpBlock">
                    <div id="amountHelpBlock" class="form-text">
                        Masukkan besaran dari pemasukam/pengeluaran.
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="money_in" id="money_in1" value="1">
                        <label class="form-check-label" for="money_in1">
                            Pemasukan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="money_in" id="money_in2" value="0"
                            checked>
                        <label class="form-check-label" for="money_in2">
                            Pengeluaran
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFileLg" class="form-label">Bukti</label>
                    <input class="form-control" id="formFileLg" name="images[]" type="file" accept="image/*" multiple>
                </div>
                <button class="form-control btn btn-lg btn-primary" type="submit">OK</button>
            </form>
        </div>
    </main>
@endsection
