@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Kebutuhan /</span> Edit Kebutuhan</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('kebutuhan.update', $data->kebutuhan->IDKebutuhan) }}" method="POST" id="form-submit">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3 col-lg-12">
                        <label for="idPosko" class="form-label">
                            Posko<span class="ms-1 text-danger">*</span>
                        </label>
                        <select class="w-100 {{ $data->is_posko ? 'form-control pe-none' : 'select2' }}" name="idPosko"
                            required {{ $data->is_posko ? 'readonly' : '' }}>
                            @if (empty($data->poskos))
                                <option hidden value="">Data Tidak ada</option>
                            @else
                                <option hidden value="">-- Pilih Posko --</option>
                                @foreach ($data->poskos as $item)
                                    <option value="{{ $item->IDPosko }}"
                                        {{ $data->is_posko && $data->posko->IDPosko == $item->IDPosko ? 'selected' : '' }}>
                                        {{ $item->user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-lg-4">
                            <label for="idPosko" class="form-label">
                                Barang<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="idProduct" required>
                                @if (empty($data->barang))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Posko --</option>
                                    @foreach ($data->barang as $item)
                                        <option value="{{ $item->IDBarang }}"
                                            {{ $data->kebutuhan->IDBarang == $item->IDBarang ? 'selected' : '' }}>
                                            {{ $item->NamaBarang }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-lg-4">
                            <label for="idPosko" class="form-label">
                                Jumlah Dibutuhkan<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" min="1" name="qtyRequest"
                                placeholder="Contoh: 50" value="{{ $data->kebutuhan->JumlahKebutuhan }}" />
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="idPosko" class="form-label">
                                Jumlah Diterima
                            </label>
                            <input type="number" class="form-control inp-qty" min="1" name="qtyReceived"
                                placeholder="Contoh: 50" value="{{ $data->kebutuhan->JumlahDiterima }}" />
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('kebutuhan.index') }}">
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
