@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Pengguna /</span> Edit Pengguna</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('user-management.update', $data->user->id) }}" method="POST" id="form-submit">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="name" class="form-label">
                                Nama<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" value="{{ $data->user->name }}" required>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="email" class="form-label">
                                Email<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="mail" class="form-control" name="email" value="{{ $data->user->email }}" required>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="username" class="form-label">
                                Username<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="username" value="{{ $data->user->username }}" required>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="phone" class="form-label">
                                No. Telepon<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" name="phone" value="{{ $data->user->phone }}" required>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="role" class="form-label">
                                Role<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="role" required>
                                @if (empty($data->roles))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Role --</option>
                                    @foreach ($data->roles as $item)
                                        <option value="{{ $item->id }}" {{ $item->name == $data->user_role ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="password" class="form-label">
                                Password
                            </label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password
                            </label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="address" class="form-label">
                                Alamat Lengkap<span class="ms-1 text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="address" rows="3" required>{{ $data->user->address }}</textarea>
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
