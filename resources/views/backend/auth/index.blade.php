@extends('backend.layouts')

@section('content')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title fs-3">LOGIN SIPERUM</h1>
                    <p class="auth-subtitle mb-5 fs-5">
                        Selamat Datang di SIPERUM Silahakan
                        Login untuk melanjutkan
                    </p>
                    <form action="{{ route('login.store') }}" method="POST">
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
                            <input type="password" name="password" class="form-control form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-6">
                        <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}"
                                class="font-bold">Sign
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
