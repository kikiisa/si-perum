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
                <h3>Master Pemetaan</h3>
                <p class="text-subtitle text-muted">Lengkapi Persyaratan Pemetaan Wilayah Perumahan.</p>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    @if (Auth::check())
                                        <a href="{{Route('master-pemetaan.create')}}" class="btn btn-primary">Tambah Pemetaan</a>
                                    @endif
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Nama Perusahaan</th>
                                                <th>Nama Perumahaan</th>
                                                <th>Alamat</th>
                                                <th>Luas Lahan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>
                                                        @if ($item->vendor->name == "default")
                                                            <span class="badge bg-warning">
                                                                Tidak di ketahui
                                                            </span>
                                                        @else
                                                            {{$item->vendor->name}}
                                                        @endif
                                                    </td>
                                                    <td>{{$item->nama_perumahan}}</td>
                                                    <td>{{$item->alamat_perumahan}}</td>
                                                    <td>{{$item->luas_lahan}} m<sup>2</td>
                                                    <td>
                                                        @if ($item->status == "pending")
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif($item->status == "accepted")
                                                            <span class="badge bg-success">Disetujui</span>
                                                        @else
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{Route("master-pemetaan.destroy",$item->id)}}" method="POST">
                                                            @method("DELETE")
                                                            @csrf
                                                            <a href="{{Route('master-pemetaan.edit', $item->uuid)}}" class="badge bg-warning">Edit</a>
                                                            <button class="badge bg-danger border-0" onclick="return confirm('apakah anda yakin ingin menghapus data ini ?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
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
    <script src="{{asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/simple-datatables.js')}}"></script>
    @include('backend.components.flash')
@endsection
