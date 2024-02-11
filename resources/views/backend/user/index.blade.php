@extends('backend.layouts')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/table-datatable.css') }}">
    <div id="app">
        @include('backend.components.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Master Vendor Perusahaan</h3>
                <p class="text-subtitle text-muted">Daftar Master Vendor.</p>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Nama Perusahaan</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Profile</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                @if ($item->name != "default")
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->username }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>
                                                            @if ($item->profile == 'default')
                                                                <img width="90" src="{{ asset('assets/image/user.png') }}"
                                                                    alt="avatar">
                                                            @else
                                                                <img width="90" src="{{ asset($item->profile) }}"
                                                                    alt="avatar">
                                                            @endif
                                                    
                                                        </td>
                                                        <td>
                                                            <form action="{{ Route('master-vendor.destroy', $item->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a href="{{ Route('master-vendor.edit', $item->uuid) }}"
                                                                    class="btn btn-warning">Edit</a>
                                                                <button class="btn btn-danger"
                                                                    onclick="return confirm('apakah anda yakin ingin menghapus data ini ?')">Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>
    @include('backend.components.flash')
@endsection
