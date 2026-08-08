@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Distribusi Bantuan /</span> Detail Distribusi Bantuan</h4>
        <div class="card shadow-sm border-0 w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Tujuan Posko
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ $distribusi_bantuan->posko->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Tanggal Distribusi
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ date('d F Y', strtotime($distribusi_bantuan->TanggalDistribusi)) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 border-top mt-4 mb-3">
                    <h5 class="pt-4">Daftar Barang Bantuan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Bantuan</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th width="15%">Harga Satuan</th>
                                    <th width="10%">Jumlah Kebutuhan</th>
                                    <th width="10%">Jumlah</th>
                                    <th width="15%">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($distribusi_bantuan->distribusi_bantuan_items as $item)
                                    @php
                                        $total += intval($item->barang->HargaSatuan) * intval($item->Jumlah);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if (session('role') !== 'posko')
                                                <a href="{{ route('bantuan.show', $item->bantuan->IDBantuan) }}"
                                                    target="_blank">{{ $item->bantuan->donatur->NamaPerusahaan . ' - ' . date('d F Y', strtotime($item->bantuan->TanggalBantuan)) }}<i
                                                        class="fa fa-external-link ms-2"></i></a>
                                            @else
                                                {{ $item->bantuan->donatur->NamaPerusahaan . ' - ' . date('d F Y', strtotime($item->bantuan->TanggalBantuan)) }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->barang->NamaBarang }}
                                        </td>
                                        <td>
                                            {{ $item->barang->jenis_barang->JenisBarang }}
                                        </td>
                                        <td align="right">
                                            {{ 'Rp.' . number_format($item->HargaSatuan, 0, ',', '.') }}
                                        </td>
                                        <td align="right">
                                            {{ number_format($item->JumlahKebutuhan, 0, ',', '.') }}
                                        </td>
                                        <td align="right">
                                            {{ number_format($item->Jumlah, 0, ',', '.') }}
                                        </td>
                                        <td align="right">
                                            {{ 'Rp' . number_format(intval($item->HargaSatuan) * intval($item->Jumlah), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" align="right" class="fw-bold">Total Keseluruhan Harga</td>
                                    <td align="right" class="fw-bold"><input type="hidden" id="totalHarga">Rp.<span
                                            id="totalHargaTxt">{{ number_format($total, 0, ',', '.') }}</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                <a class="btn btn-secondary text-white" href="{{ route('distribusi-bantuan.index') }}">
                    <i class="fa fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
