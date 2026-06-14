@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Kelompok /</span> Edit Kelompok</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('kelompok.update', $data->IDKelompok) }}" method="POST" id="form-submit">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama_kelompok" class="form-label">
                            Nama Kelompok<span class="ms-1 text-danger">*</span>
                        </label>
                        <input type="text" value="{{ $data->NamaKelompok }}" class="form-control" name="nama_kelompok"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">
                            Keterangan<span class="ms-1 text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="keterangan" rows="3" required>{{ $data->Keterangan }}</textarea>
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
