<section class="row justify-content-center container">
    <div class="col-lg-6 text-start mt-4 py-4">
        <h3>Selamat Datang Di Sistem Informasi Persebaran Perumahan</h3>
        <p class="text-muted">{{$app->subtitle}}</p>
        <a href="{{Route('register')}}" class="btn btn-primary">Registrasi Sekarang <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="col-lg-4 text-center">
        <div class="card border-0 bg-transparent">
            <div class="card-body">
                @if ($app->logo == 'default')
                    <img class="ms-4" src="{{asset('assets/image/user.png')}}" width="250" alt="logo" srcset="">
                @else
                    
                    <img class="ms-4" src="{{asset($app->logo)}}" alt="logo" srcset="">
                @endif
            </div>
        </div>
    </div>
</section>
