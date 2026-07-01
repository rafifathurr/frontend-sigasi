@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Jenis Barang /</span> Edit Jenis Barang</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('donatur.update', $data->IDDonatur) }}" method="POST" id="form-submit">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="nama_perusahaan" class="form-label">
                                Nama Donatur<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="nama_perusahaan"
                                value={{ $data->NamaPerusahaan }} required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="nomor_kontak" class="form-label">
                                Nomor Kontak<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" name="nomor_kontak" value={{ $data->NomorKontak }}
                                required>
                        </div>
                    </div>
                    <div class="form-group mb-3 col-12">
                        <label for="alamat" class="form-label">
                            Alamat Lengkap<span class="ms-1 text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="alamat" rows="3" required>{{ $data->Alamat }}</textarea>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('donatur.index') }}">
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
