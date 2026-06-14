@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Pengungsi /</span> Tambah Pengungsi</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('pengungsi.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
                        @if (session('role') == 'posko-utama')
                            <div class="form-group mb-3 col-12">
                                <label for="idPosko" class="form-label">
                                    Posko<span class="ms-1 text-danger">*</span>
                                </label>
                                <select class="w-100 select2" name="idPosko" required>
                                    @if (empty($data->posko))
                                        <option hidden value="">Data Tidak ada</option>
                                    @else
                                        <option hidden value="">-- Pilih Posko --</option>
                                        @foreach ($data->posko as $item)
                                            <option value="{{ $item->IDPosko }}">{{ $item->user->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        <div class="form-group mb-3 col-12">
                            <label for="idPenduduk" class="form-label">
                                Penduduk<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="idPenduduk" required>
                                @if (empty($data->penduduk))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Penduduk --</option>
                                    @foreach ($data->penduduk as $item)
                                        <option value="{{ $item->IDPenduduk }}">{{ $item->Nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="condition" class="form-label">
                                Kondisi<span class="ms-1 text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="condition" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('pengungsi.index') }}">
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
