@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Bantuan /</span> Detail Bantuan</h4>
        <div class="card shadow-sm border-0 w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <table>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Nama Perusahaan
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ $bantuan->donatur->NamaPerusahaan }}
                                </td>
                            </tr>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Alamat Perusahaan
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ $bantuan->donatur->Alamat }}
                                </td>
                            </tr>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Nomor Perusahaan
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ $bantuan->donatur->NomorKontak }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Tanggal Bantuan
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ date('d F Y', strtotime($bantuan->TanggalBantuan)) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-12 border-top mt-4 mb-3">
                    <h5 class="pt-4">Daftar Barang</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">NO</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bantuan->bantuan_detail as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->barang->NamaBarang }}
                                        </td>
                                        <td>
                                            {{ $item->Jumlah }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                <a class="btn btn-secondary text-white" href="{{ route('bantuan.index') }}">
                    <i class="fa fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
