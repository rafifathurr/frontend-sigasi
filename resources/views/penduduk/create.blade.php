@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Penduduk /</span> Tambah Penduduk</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('penduduk.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="ktp" class="form-label">
                                Nomor KTP<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" name="ktp" required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="nama" class="form-label">
                                Nama Lengkap<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="jenis_kelamin" class="form-label">
                                Jenis Kelamin<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="jenis_kelamin" required>
                                <option hidden value="">-- Pilih Jenis Kelamin --</option>
                                <option value="0">Laki Laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="kelompok" class="form-label">
                                Kelompok<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="kelompok" required>
                                @if (empty($kelompoks))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Kelompok --</option>
                                    @foreach ($kelompoks as $item)
                                        <option value="{{ $item->IDKelompok }}">{{ $item->NamaKelompok }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="tanggal_lahir" class="form-label">
                                Tanggal Lahir<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="tanggal_lahir">
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="desa" class="form-label">
                                Desa<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="desa" required>
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="alamat" class="form-label">
                                Alamat Lengkap<span class="ms-1 text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="alamat" rows="3" required></textarea>
                        </div>
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
