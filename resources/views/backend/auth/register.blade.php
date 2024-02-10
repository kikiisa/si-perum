@extends('backend.layouts')

@section('content')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title fs-3">REGISTRASI SIPERUM</h1>
                    <p class="auth-subtitle mb-3 fs-5">
                        Selamat Datang di SIPERUM Silahakan
                        Registrasi terlebih dahulu
                    </p>
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl"
                                placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="name" class="form-control form-control-xl"
                                placeholder="Nama Perusahaan">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" placeholder="email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>


                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>


                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="confirm" class="form-control form-control-xl"
                                placeholder="Konfirmasi Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Registrasi</button>
                    </form>
                    <div class="text-center mt-3 text-lg fs-6">
                        <p class="text-gray-600">You have an account? <a href="{{ route('login') }}" class="font-bold">Sign
                                up</a>.</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>
    @include('backend.components.flash')
@endsection
