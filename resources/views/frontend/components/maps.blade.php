<style>
    #map {
        height: 400px;
    }
</style>
<link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
<section class="map mt-4 py-4">
    <div class="row justify-content-center">
        <h3 class="text-center">Pemetaan Wilayah Perumahan</h3>
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('vendor/leaflet/leaflet.js') }}" type="text/javascript"></script>

<script src="{{asset('vendor/axios.min.js')}}"></script>

<script>
    var map = L.map('map').setView([0.556174, 123.058548], 15);
    let lat = document.getElementById('lat')
    let long = document.getElementById('long')
    let luas = document.getElementById('luas')
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: 'PERKIM - GORONTALO',
    }).addTo(map);

    const markerWithRadius = (data) => 
    {
        console.log(data.luas_lahan);
        let radius = Math.sqrt(data.luas_lahan * Math.PI)
        L.circle([data.latitude,data.longitude], radius, {
          color: "red",
          fillColor: "",    
          fillOpacity: 0.5,
          radius: radius
        }).addTo(map);
    }
    const fetchData = async () => {
        try
        {
            const response = await axios.get("{{Route('map')}}");
            const data = response.data.data
            
            data.map((data,index) => {
                L.marker([data.latitude, data.longitude], {
                        icon: L.icon({
                            iconUrl: `assets/image/house.png`,
                            iconSize: [20,
                                20
                            ], // size of the icon
                        })
                }).addTo(map).bindPopup(`Nama Perumahaan : ${data.nama_perumahan}`)
                markerWithRadius(data)
            })
        }catch(error)
        {
            console.log(error);
        }
    }

    fetchData();
</script>
