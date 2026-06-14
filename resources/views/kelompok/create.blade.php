@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Kelompok /</span> Tambah Kelompok</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('kelompok.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama_kelompok" class="form-label">
                            Nama Kelompok<span class="ms-1 text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="nama_kelompok" required>
                        <div class="warning-feedback form-text text-danger">Maksimal 20 karakter</div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="keterangan" class="form-label">
                            Keterangan<span class="ms-1 text-danger">*
                        </label>
                        <textarea class="form-control" name="keterangan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('kelompok.index') }}">
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
