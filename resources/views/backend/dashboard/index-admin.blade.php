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
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  </div>
</div>
@include('backend.components.flash')
@endsection
