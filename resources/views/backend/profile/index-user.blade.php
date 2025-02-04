@extends('backend.layouts')

@section('content')
    <div id="app">
        @include('backend.components.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Manajemen Akun</h3>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            @if (Auth::user()->profile == "default")
                                <img class="card-img" src="{{ asset('assets/image/user.png') }}" alt="avatar">
                            @else
                                <img class="card-img" src="{{ asset(Auth::user()->profile) }}" alt="avatar">
                            @endif
                            <div class="card-body text-center">
                                <h3>{{Auth::user()->name}}</h3>
                                <p class="text-small">Developer Perumahaan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{Route('profile.update',Auth::user()->id)}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label for="name" class="form-label">Username</label>
                                        <input type="text" name="username" id="name" class="form-control"
                                            placeholder="Username" value="{{Auth::user()->username}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nama Perusahaan</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Nama Perusahaan" value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            placeholder="Email Perusahaan" value="{{Auth::user()->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="profile">Profile</label>
                                        <input type="file" name="profile" id="profile" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password Lama</label>
                                        <input type="password" name="old" class="form-control" placeholder="****">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password Baru</label>
                                        <input type="password" name="password" class="form-control " placeholder="****">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password Konfirmasi</label>
                                        <input type="password" name="confirm" class="form-control " placeholder="****">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.components.flash')
@endsection
