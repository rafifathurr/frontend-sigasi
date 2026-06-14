@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Posko /</span> Tambah Posko</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('posko.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-12">
                            <label for="idUser" class="form-label">
                                User<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="idUser" required>
                                @if (empty($users))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Pengguna --</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="location" class="form-label">
                                Lokasi<span class="ms-1 text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="location" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="problem" class="form-label">
                                Masalah<span class="ms-1 text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="problem" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="solution" class="form-label">
                                Solusi<span class="ms-1 text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="solution" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('posko.index') }}">
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
