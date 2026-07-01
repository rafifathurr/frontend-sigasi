@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Penduduk /</span> Edit Penduduk</h4>
        <div class="card shadow-sm border-0 w-100">

            <form action="{{ route('penduduk.update', $penduduk->IDPenduduk) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="ktp" class="form-label">Nomor KTP<span class="ms-1 text-danger">*</span></label>
                            <input type="number" value="{{ $penduduk->KTP }}" class="form-control" name="ktp"
                                id="ktp" required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="nama" class="form-label">Nama Lengkap<span
                                    class="ms-1 text-danger">*</span></label>
                            <input type="text" value="{{ $penduduk->Nama }}" class="form-control" name="nama"
                                id="nama" required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin<span
                                    class="ms-1 text-danger">*</span></label>
                            <select class="w-100 select2" name="jenis_kelamin" required>
                                <option hidden value="">-- Pilih Jenis Kelamin --</option>
                                <option value="0" {{ $penduduk->JenisKelamin == 0 ? 'selected' : '' }}>Laki
                                    - Laki</option>
                                <option value="1" {{ $penduduk->JenisKelamin == 1 ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="kelompok" class="form-label">Kelompok<span class="ms-1 text-danger">*</span></label>
                            <select class="w-100 select2" name="kelompok" required>
                                @if (empty($kelompoks))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Kelompok --</option>
                                    @foreach ($kelompoks as $item)
                                        <option value="{{ $item->IDKelompok }}"
                                            {{ $item->IDKelompok == $penduduk->kelompok->IDKelompok ? 'selected' : '' }}>
                                            {{ $item->NamaKelompok }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir<span
                                    class="ms-1 text-danger">*</span></label>
                            <input type="date"
                                value="{{ \Carbon\Carbon::parse($penduduk->TanggalLahir)->format('Y-m-d') }}"
                                class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="desa" class="form-label">Desa<span class="ms-1 text-danger">*</span></label>
                            <input type="text" value="{{ $penduduk->Desa }}" class="form-control" name="desa"
                                id="desa" required>
                        </div>
                    </div>
                    <div class="form-group mb-3 col-12">
                        <label for="alamat" class="form-label">Alamat Lengkap<span
                                class="ms-1 text-danger">*</span></label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ $penduduk->Alamat }}</textarea>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('penduduk.index') }}">
                        <i class="fa fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                    <button type="button" onclick="formSubmit('form-submit')"
                        class="btn btn-primary d-flex justify-content-center align-items-center">
                        <i class="fa fa-check me-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
