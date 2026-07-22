@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Penduduk /</span> Detail Penduduk</h4>
        <div class="card shadow-sm border-0 w-100">
            <div class="card-body">
                <div class="row">
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label">
                            Nomor KTP
                        </label>
                        <input type="number" disabled value="{{ $penduduk->KTP }}" class="form-control" name="ktp">
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label">
                            Nama Lengkap
                        </label>
                        <input type="text" disabled value="{{ $penduduk->Nama }}" class="form-control" name="nama">
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label">
                            Jenis Kelamin
                        </label>
                        @if ($penduduk->JenisKelamin == 0)
                            <input type="text" disabled value="Laki - Laki" class="form-control" name="nama">
                        @else
                            <input type="text" disabled value="Perempuan" class="form-control" name="nama">
                        @endif
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label">
                            Kelompok
                        </label>
                        <input type="text" disabled value="{{ $penduduk->kelompok->NamaKelompok }}" class="form-control"
                            name="tanggal_lahir">
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label">
                            Tanggal Lahir
                        </label>
                        <input type="date" disabled
                            value="{{ \Carbon\Carbon::parse($penduduk->TanggalLahir)->format('Y-m-d') }}"
                            class="form-control" name="tanggal_lahir">
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label">
                            Desa
                        </label>
                        <input type="text" disabled value="{{ $penduduk->Desa }}" class="form-control" name="desa">
                    </div>
                    <div class="form-group mb-3 col-lg-12">
                        <label class="form-label">
                            Alamat Lengkap
                        </label>
                        <textarea disabled class="form-control" name="alamat" rows="3">{{ $penduduk->Alamat }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                <a class="btn btn-secondary text-white" href="{{ route('penduduk.index') }}">
                    <i class="fa fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
