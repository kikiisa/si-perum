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
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                  </nav>
                <div class="page-content">
                   <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="map" id="map">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-img-top">
                                <img class="rounded-4 img-thumbnail" src="{{asset($data->profile)}}" alt="image" srcset="">
                            </div>
                            <div class="card-body">
                                <h3>{{$data->nama_perumahan}}</h3>
                                <p class="text-muted">Nama Perusahaan : <strong>{{$data->vendor->name}}</strong></p>
                                <div class="content" style="text-align: justify">
                                    {!! $data->deskripsi !!}
                                </div>
                                <hr>
                                <p>
                                    <i class="bi bi-geo-alt"></i><span class="ms-1">{{$data->alamat_perumahan}}</span>
                                    <i class="ms-2 bi bi-envelope"></i><span class="ms-1">{{$data->vendor->email}}</span><br>
                                </p>
                                
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
    <script src="{{ asset('vendor/leaflet/leaflet.js') }}" type="text/javascript"></script>
    <script src="{{asset('vendor/axios.min.js')}}"></script>
    <script>
        let radius;
        var map = L.map('map').setView([0.556174, 123.058548], 15);
        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: 'PERKIM - GORONTALO',
        }).addTo(map);
        L.marker([{{$data->latitude}},{{$data->longitude}}],{
            icon: L.icon({
                            iconUrl: `/assets/image/house.png`,
                            iconSize: [20,
                                20
                            ], // size of the icon
                        })
        }).addTo(map).bindPopup("{{$data->nama_perumahan}}")
        .openPopup();
        
        radius = Math.sqrt({{$data->luas_lahan}} * Math.PI)
        console.log(radius);
        L.circle([{{$data->latitude}},{{$data->longitude}}], radius, {
          color: "red",
          fillColor: "",    
          fillOpacity: 0.5,
          radius: radius
        }).addTo(map);
    </script>
</body>

</html>
