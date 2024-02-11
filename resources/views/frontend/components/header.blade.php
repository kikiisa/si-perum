<header class="mb-2">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container text-center">
            <a class="navbar-brand" href="#"><strong><i class="bi bi-geo-alt"></i>
                    SI-PERUM</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Route("login")}}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{Route("register")}}">Register</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" name="q" type="search" placeholder="Cari perumahan"
                        aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </nav>
</header>