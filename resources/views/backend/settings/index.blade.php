@extends('backend.layouts')
@section('content')
    <div id="app">
        <link rel="stylesheet" href="{{ asset('assets/extensions/summernote/summernote-lite.css') }}">
        <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/form-editor-summernote.css') }}">
        @include('backend.components.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Pengaturan Aplikasi</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('pengaturan.update', $data->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" required placeholder="Judul Aplikasi" name="title"
                                                    value="{{ $data->title }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Subtitle</label>
                                                <input type="text" required placeholder="Penjelasan Singkat Aplikasi"
                                                    name="subtitle" value="{{ $data->subtitle }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" required placeholder="Email Aplikasi" name="email"
                                                    value="{{ $data->email }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" required placeholder="Phone Aplikasi" name="phone"
                                                    value="{{ $data->phone }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" required placeholder="Alamat" name="address"
                                                    value="{{ $data->address }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Aplikasi</label>
                                                <textarea name="deskripsi" id="summernote">
                                                    {{ $data->deskripsi }}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Logo</label>
                                            <input type="file" class="form-control" id="image" name="logo">
                                        </div>
                                        <div class="form-group">
                                            <label>Strukture</label>
                                            <input type="file" class="form-control" id="image" name="strukture">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            </section>
        </div>
    </div>
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $("#summernote").summernote({
            tabsize: 2,
            height: 120,
        })
        $("#hint").summernote({
            height: 100,
            toolbar: false,
            placeholder: "type with apple, orange, watermelon and lemon",
            hint: {
                words: ["apple", "orange", "watermelon", "lemon"],
                match: /\b(\w{1,})$/,
                search: function(keyword, callback) {
                    callback(
                        $.grep(this.words, function(item) {
                            return item.indexOf(keyword) === 0
                        })
                    )
                },
            },
        })
    </script>
    @include('backend.components.flash')
@endsection
