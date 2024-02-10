@extends('backend.layouts')
@section('content')
    <style>
        #map {
            height: 400px;
        }
    </style>
    <div id="app">
        <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
        @include('backend.components.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Profile Dan Berkas</h3>
                <p class="text-subtitle text-muted">Lengkapi Persyaratan Dan Profile Pemetaan Wilayah Perumahan.</p>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="map">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-info">
                                    Status Pemetaan : 
                                    @if ($data->status == "pending")
                                        <span class="text-uppercase badge bg-warning">Pending</span>
                                    @elseif($data->status == "accepted")
                                        <span class="text-uppercase badge bg-success">Di Setujui</span>
                                    @else
                                        <span class="text-uppercase badge bg-danger">Ditolak</span>
                                    @endif
                                </div>
                                
                                @if ($data->note != null)
                                    <div class="alert alert-info">
                                        CATATAN BERKAS : {{$data->note}}
                                    </div>
                                @endif
                                <form action="{{ route('master-pemetaan.update',$data->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Nama Perumahaan</label>
                                                <input type="text" value="{{$data->nama_perumahan}}" required placeholder="Nama Perumahaan" name="nama_perumahan" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Alamat Perumahaan</label>
                                                <textarea  required name="alamat_perumahan" class="form-control" placeholder="Alamat Perumahaan">{{$data->alamat_perumahan}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Deskripsi Perumahaan</label>
                                                <textarea required name="deskripsi" class="form-control" placeholder="Deskripsi">{{$data->deskripsi}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Latitude</label>
                                                <input type="text" placeholder="Latitude" value="{{$data->latitude}}" name="latitude" id="lat"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Longitude</label>
                                                <input type="text" name="longitude" value="{{$data->longitude}}" placeholder="Longitude" id="long"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <small class="bg-info text-white p-2 rounded">Longitude Dan Latitude Bisa Di Isi
                                                Secara Manual</small>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Luas Lahan (Meter)</label>
                                                <input type="number" id="luas" value="{{$data->luas_lahan}}" name="luas_lahan" placeholder="Luas Lahan"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Document PDF</th>
                                                <th scope="col">File Input</th>
                                                <th scope="col">Download File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($syarat as $label => $name)
                                            <tr>
                                                <th scope="row">{{$loop->index+=1}}</th>
                                                <td>{{$label}}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control" type="file" name="{{$name}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="btn btn-info" href="{{asset($data->$name)}}" target="_blank">Download</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if (!Auth::check())
                                        <div class="form-group">
                                            <label>Catatan Berkas</label>
                                            <textarea name="note" class="form-control" placeholder="Catatan Berkas">
                                                {{$data->note}}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Persetujuan</label>
                                            <select name="status" id="status" class="form-control">
                                                <option selected disabled>Pilih Status</option>
                                                <option  {{$data->status == 'accepted' ? 'selected' : ''}} value="accepted">Disetujui</option>
                                                <option  {{$data->status == 'pending' ? 'selected' : ''}} value="pending">Pending</option>
                                                <option  {{$data->status == 'rejected' ? 'selected' : ''}} value="rejected">Ditolak</option>
                                            </select>
                                        </div>
                                    @endif  
                                    <button class="btn btn-primary">UBAH DATA</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/leaflet/leaflet.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/axios.min.js') }}"></script>
    <script>
        var map = L.map('map').setView([0.556174, 123.058548], 13);
        let lat = document.getElementById('lat')
        let long = document.getElementById('long')
        let luas = document.getElementById('luas')
        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);
        L.marker([lat.value,long.value]).addTo(map)
        .bindPopup("{{$data->nama_perumahan}}")
        .openPopup();
          radius = Math.sqrt(document.getElementById("luas").value * Math.PI)
          L.circle([lat.value,long.value], radius, {
          color: "red",
          fillColor: "",    
          fillOpacity: 0.5,
          radius: radius
        }).addTo(map);

        const markerWithRadius = (data) => {
            console.log(data.luas_lahan);
            let radius = Math.sqrt(data.luas_lahan * Math.PI)
            L.circle([data.latitude, data.longitude], radius, {
                color: "red",
                fillColor: "",
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }
        const fetchData = async () => {
            try {
                const response = await axios.get("{{ Route('map') }}");
                const {
                    data
                } = response.data
                data.map((data, index) => {
                    L.marker([data.latitude, data.longitude], {
                        icon: L.icon({
                            iconUrl: `{{ asset('assets/image/house.png') }}`,
                            iconSize: [20,
                                20
                            ], // size of the icon
                        })
                    }).addTo(map).bindPopup(`Nama Perumahaan : ${data.nama_perumahan}`).openPopup()
                    markerWithRadius(data)
                })
            } catch (error) {
                console.log(error);
            }
        }
        fetchData();
        function onMapClick(e) {
            var popup = L.popup()
                .setLatLng([0, 0])
                .setContent('Posisi Sekarang')
                .openOn(map);
            popup
                .setLatLng(e.latlng)
                .setContent('Koordinat Posisi yang anda Klik' + e.latlng.toString())
                .openOn(map);

            lat.value = e.latlng.lat
            long.value = e.latlng.lng
        }
        map.on('click', onMapClick);
    </script>
    @include('backend.components.flash')
@endsection
