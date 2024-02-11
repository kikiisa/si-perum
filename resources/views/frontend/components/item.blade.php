<section class="row justify-content-start container">
    <h3 class="text-center mb-4">Informasi Perumahan</h3>
        @forelse ($data as $item)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-content">
                        <img class="card-img-bottom img-fluid" src="{{asset($item->profile)}}" alt="Card image cap"
                            style="height: 20rem; object-fit: cover;">
                        <div class="card-body">
                            <h4 class="card-title">{{$item->nama_perumahan}}</h4>
                            <p class="card-text">
                               {{$item->deskripsi}}
                            </p>
                            <a href="#" class="card-link"><small><i class="bi bi-geo-alt"></i> {{$item->alamat_perumahan}}</small></a>
                            <a href="{{Route('detail', $item->uuid)}}" class="btn btn-primary mt-3 ">Lihat Lokasi Perumahaan</a>
                        
                        </div>
                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-lg-4">
                <div class="alert alert-danger text-center"><strong>Tidak Ada Data Perumahan 😢</strong></div>
            </div>
        @endforelse
        {{ $data->links() }}
    </div>
</section>

