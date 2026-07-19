@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Beranda /</span> Dashboard</h4>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body px-4">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div>
                                <span class="fw-semibold d-block mb-1">Barang</span>
                                <h3 class="card-title mb-2">{{ $barang }}</h3>
                            </div>
                            <div class="bg-label-primary p-3 rounded-circle">
                                <i class="fa fa-gift fa-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body px-4">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div>
                                <span class="fw-semibold d-block mb-1">Penduduk</span>
                                <h3 class="card-title mb-2">{{ $penduduk }}</h3>
                            </div>
                            <div class="bg-label-info p-3 rounded-circle">
                                <i class="fa fa-users fa-3x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body px-4">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div>
                                <span class="fw-semibold d-block mb-1">Bantuan</span>
                                <h3 class="card-title mb-2">{{ $bantuan }}</h3>
                            </div>
                            <div class="bg-label-success p-3 rounded-circle">
                                <i class="fa fa-handshake-o fa-3x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body px-4">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div>
                                <span class="fw-semibold d-block mb-1">Distribusi Bantuan</span>
                                <h3 class="card-title mb-2">{{ $distribusi_bantuan }}</h3>
                            </div>
                            <div class="bg-label-warning p-3 rounded-circle">
                                <i class="fa fa-truck fa-3x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
