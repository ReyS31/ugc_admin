@extends('layout.layout')

@section('body')
    <main class="container">
        <div class="mx-auto py-5">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <h2 class="text-center">Tambah Data Kegiatan</h2>
            <form class="row" method="POST" action="{{ route('kegiatan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" id="title" class="form-control" name="title"
                        aria-describedby="titleHelpBlock" required>
                    <div id="titleHelpBlock" class="form-text">
                        Judul kegiatan yang dilakukan.
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                    </div>
                    <div id="descriptionHelpBlock" class="form-text">
                        Deskripsi apa saja yang dilakukan dalam kegiatan.
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
