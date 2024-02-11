@extends('backend.layouts')

@section('content')
    <div id="app">
        @include('backend.components.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Dashboard</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info">
                            <strong>Selamat Datang Kembali, {{ Auth::guard('operators')->user()->name }}</strong>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Persebaran</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalData }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Persebaran Disetujui</h6>
                                        <h6 class="font-extrabold mb-0">{{ $diterima }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Persebaran Ditolak</h6>
                                        <h6 class="font-extrabold mb-0">{{ $ditolak }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon info mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Persebaran Pending</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pending }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <h4>Grafik Pertumbuhan Persebaran Tahun {{date('Y')}}</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            </section>
        </div>
    </div>
    </div>
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/axios.min.js') }}"></script>
    <script>
        const fetchDataBar = async () => {
            await axios.get("{{ Route('chart-pemetaan') }}").then((response) => {
                var optionsProfileVisit = {
                    annotations: {
                        position: "back",
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    chart: {
                        type: "bar",
                        height: 300,
                    },
                    fill: {
                        opacity: 1,
                    },
                    plotOptions: {},
                    series: [{
                        name: "sales",
                        data: response.data,
                    }, ],
                    colors: "#435ebe",
                    xaxis: {
                        categories: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec",
                        ],
                    },
                }

                var chartProfileVisit = new ApexCharts(
                    document.querySelector("#chart-profile-visit"),
                    optionsProfileVisit
                )
                chartProfileVisit.render()
            }).catch((error) => {
                console.log(error);
            })
        }
        fetchDataBar();
    </script>
    @include('backend.components.flash')
@endsection
