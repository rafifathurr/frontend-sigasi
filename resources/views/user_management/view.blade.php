@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Penduduk /</span> Detail Penduduk</h4>
        <div class="card shadow-sm border-0 w-100">
            <div class="card-body">
                <div class="row">
                    <div class="form-group mb-3 col-6">
                        <label for="name" class="form-label">
                            Nama
                        </label>
                        <input type="text" class="form-control" name="name" value="{{ $data->user->name }}" readonly>
                    </div>
                    <div class="form-group mb-3 col-6">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input type="mail" class="form-control" name="email" value="{{ $data->user->email }}" readonly>
                    </div>
                    <div class="form-group mb-3 col-4">
                        <label for="username" class="form-label">
                            Username
                        </label>
                        <input type="text" class="form-control" name="username" value="{{ $data->user->username }}"
                            readonly>
                    </div>
                    <div class="form-group mb-3 col-4">
                        <label for="phone" class="form-label">
                            No. Telepon
                        </label>
                        <input type="number" class="form-control" name="phone" value="{{ $data->user->phone }}" readonly>
                    </div>
                    <div class="form-group mb-3 col-4">
                        <label for="role" class="form-label">
                            Role
                        </label>
                        <select class="form-control" name="role" id="role" readonly>
                            @if (empty($data->roles))
                                <option hidden value="">Data Tidak ada</option>
                            @else
                                <option hidden value="">-- Pilih Role --</option>
                                @foreach ($data->roles as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->name == $data->user_role ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mb-3 col-12">
                        <label for="alamat" class="form-label">
                            Alamat Lengkap
                        </label>
                        <textarea class="form-control" name="alamat" rows="3" readonly>{{ $data->user->address }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                <a class="btn btn-secondary text-white" href="{{ route('user-management.index') }}">
                    <i class="fa fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
