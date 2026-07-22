@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Barang /</span> Tambah Barang</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('barang.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-lg-6">
                            <label for="nama_barang" class="form-label">
                                Nama Barang<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="nama_barang" required>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label for="harga_satuan" class="form-label">
                                Harga Satuan (Rp.)<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" name="harga_satuan" min="0" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenis_barang" class="form-label">
                            Jenis Barang<span class="ms-1 text-danger">*</span>
                        </label>
                        <select class="w-100 select2" name="jenis_barang" required>
                            @if (empty($jenis_barangs))
                                <option hidden value="">Data Tidak ada</option>
                            @else
                                <option hidden value="">-- Pilih Jenis Barang --</option>
                                @foreach ($jenis_barangs as $item)
                                    <option value="{{ $item->IDJenisBarang }}">{{ $item->JenisBarang }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('barang.index') }}">
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
