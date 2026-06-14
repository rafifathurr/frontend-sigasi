@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Pengguna /</span> Tambah Pengguna</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('user-management.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="name" class="form-label">
                                Nama<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="email" class="form-label">
                                Email<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="mail" class="form-control" name="email" required>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="username" class="form-label">
                                Username<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="phone" class="form-label">
                                No. Telepon<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="role" class="form-label">
                                Role<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="role" required>
                                @if (empty($roles))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Role --</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="password" class="form-label">
                                Password<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="address" class="form-label">
                                Alamat Lengkap<span class="ms-1 text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="address" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('user-management.index') }}">
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
