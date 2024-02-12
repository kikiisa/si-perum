<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - SIPERUM</title>
    <link rel="shortcut icon"
        href="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2033%2034'%20fill-rule='evenodd'%20stroke-linejoin='round'%20stroke-miterlimit='2'%20xmlns:v='https://vecta.io/nano'%3e%3cpath%20d='M3%2027.472c0%204.409%206.18%205.552%2013.5%205.552%207.281%200%2013.5-1.103%2013.5-5.513s-6.179-5.552-13.5-5.552c-7.281%200-13.5%201.103-13.5%205.513z'%20fill='%23435ebe'%20fill-rule='nonzero'/%3e%3ccircle%20cx='16.5'%20cy='8.8'%20r='8.8'%20fill='%2341bbdd'/%3e%3c/svg%3e"
        type="image/x-icon">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/zoomist.min.css') }}">
</head>
<style>
    #map {
        height: 400px;
    }
</style>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            @include('frontend.components.header')
            <div class="content-wrapper container">
                <nav style="mt-4 --bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    @if ($app->logo == 'default')
                                        <img src="{{ asset('assets/image/user.png') }}" class="w-100" alt=""
                                            srcset="">
                                    @else
                                        <img src="{{ asset($app->logo) }}" alt="logo" class="w-100">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h3>{{ $app->title }}</h3>
                                    <p class="text-muted">{{ $app->subtitle }}</p>
                                    <hr>
                                    <div class="content" style="text-align: justify">
                                        {!! $app->deskripsi !!}
                                    </div>
                                    <a href="" class="btn btn-success mt-2"><i class="bi bi-telephone"></i>
                                        {{ $app->phone }}</a>
                                    <a href="" class="btn btn-danger mt-2"><i class="bi bi-envelope"></i>
                                        {{ $app->email }}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="text-center">Strukture Organisasi</h3>
                                    @if ($app->strukture == 'default')
                                        <div class="row justify-content-center">
                                            <div class="col-lg-4">
                                                <div class="alert alert-danger text-center mt-4">Strukture organisasi
                                                    belum di upload !</div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="my-zoomist" data-zoomist-src="{{ asset($app->strukture) }}"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="text-center">Alamat</h3>
                                    <iframe class="w-100" height="500" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15958.306580247638!2d122.9812057!3d0.6306369!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32792e0244e5f327%3A0x7e083d31e1eda0b0!2sDinas%20Perumahan%20dan%20Kawasan%20Permukiman%20Kabupaten%20Gorontalo!5e0!3m2!1sen!2sid!4v1707720643095!5m2!1sen!2sid"   style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('vendor/zoomist.min.js') }}"></script>
    <script>
        new Zoomist('#my-zoomist', {
            zoomer: {
                disableOnBounds: false
            },
        })

    </script>
</body>

</html>
