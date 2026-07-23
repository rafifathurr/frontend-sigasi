@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Rencana Anggaran /</span> Detail Rencana Anggaran</h4>
        <div class="card shadow-sm border-0 w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Tanggal Rencana
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ date('d F Y', strtotime($rencana_anggaran->TanggalRencana)) }}
                                </td>
                            </tr>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Nilai Rencana
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ 'Rp.' . number_format($rencana_anggaran->NilaiAnggaran, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <th style="padding-top: 10px; padding-bottom: 10px;" class="text-left" scope="row">
                                    Keterangan
                                </th>
                                <td width="10%">
                                    <center>:</center>
                                </td>
                                <td>
                                    {{ $rencana_anggaran->Keterangan ?? '-' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-12 border-top mt-4 mb-3">
                    <h5 class="pt-4">Daftar Detail Barang Bantuan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="productTable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Bantuan</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th width="15%">Harga Satuan</th>
                                    <th width="10%">Jumlah</th>
                                    <th width="15%">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($rencana_anggaran->rencana_anggaran_items as $item)
                                    @php
                                        $total += intval($item->barang->HargaSatuan) * intval($item->Jumlah);
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->bantuan->donatur->NamaPerusahaan . ' - ' . date('d F Y', strtotime($item->bantuan->TanggalBantuan)) }}
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
                                    <td colspan="6" align="right" class="fw-bold">Total Keseluruhan Harga</td>
                                    <td align="right" class="fw-bold"><input type="hidden" id="totalHarga">Rp.<span
                                            id="totalHargaTxt">{{ number_format($total, 0, ',', '.') }}</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                <a class="btn btn-secondary text-white" href="{{ route('rencana-anggaran.index') }}">
                    <i class="fa fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
