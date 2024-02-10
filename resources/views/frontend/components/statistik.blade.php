<section class="mt-4">
    <div class="row justify-content-center">
        <div class="col-6 col-lg-2 text-center col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Persebaran</h6>
                            <h6 class="font-extrabold mb-0">{{$totalData}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-2 text-center col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                            <div class="stats-icon green mb-2">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Persebaran Disetujui</h6>
                            <h6 class="font-extrabold mb-0">{{$diterima}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-2 text-center col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                            <div class="stats-icon red mb-2">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Persebaran Ditolak</h6>
                            <h6 class="font-extrabold mb-0">{{$ditolak}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-2 text-center col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                            <div class="stats-icon info mb-2">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Persebaran Pending</h6>
                            <h6 class="font-extrabold mb-0">{{$pending}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
