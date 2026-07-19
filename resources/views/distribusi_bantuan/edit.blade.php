@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Distribusi Bantuan /</span> Edit Distribusi Bantuan</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('distribusi-bantuan.update', $data->distribusi_bantuan->IDDistribusiBantuan) }}"
                method="POST" id="form-submit">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-4">
                            <label for="idPosko" class="form-label">
                                Posko<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="idPosko" required>
                                @if (empty($data->poskos))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Posko --</option>
                                    @foreach ($data->poskos as $item)
                                        <option value="{{ $item->IDPosko }}"
                                            {{ $item->IDPosko == $data->distribusi_bantuan->IDPosko ? 'selected' : '' }}>
                                            {{ $item->user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="idBantuan" class="form-label">
                                Tanggal Distribusi<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="tanggalDistribusi"
                                value="{{ date('Y-m-d', strtotime($data->distribusi_bantuan->TanggalDistribusi)) }}" max="{{ date('Y-m-d') }}"
                                required>
                        </div>
                        <div class="form-group mb-3 col-4">
                            <label for="idBantuan" class="form-label">
                                Bantuan<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="idBantuan" id="idBantuan" required>
                                @if (empty($data->bantuans))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Bantuan --</option>
                                    @foreach ($data->bantuans as $item)
                                        <option value="{{ $item->IDBantuan }}"
                                            {{ $item->IDBantuan == $data->distribusi_bantuan->IDBantuan ? 'selected' : '' }}>
                                            {{ $item->donatur->NamaPerusahaan }} -
                                            {{ date('d F Y', strtotime($item->TanggalBantuan)) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="alamat" class="form-label">
                                Deskripsi
                            </label>
                            <textarea class="form-control" name="deskripsi" rows="3">{{ $data->distribusi_bantuan->Deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 border-top mt-4 mb-3">
                        <div class="d-flex flex-row justify-content-between my-4">
                            <h5 class="fw-medium">Daftar Detail Bantuan</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="productTable">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th width="10%">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="productBody">
                                    @foreach ($data->distribusi_bantuan->bantuan->bantuan_detail as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->barang->NamaBarang }}</td>
                                            <td>{{ $item->barang->jenis_barang->JenisBarang }}</td>
                                            <td align="right">{{ $item->Jumlah }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('distribusi-bantuan.index') }}">
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
    @push('javascript')
        <script>
            $(function() {
                $('#idBantuan').on('change', function() {
                    const idBantuan = $(this).val();
                    if (idBantuan) {
                        $.ajax({
                            url: "{{ route('distribusi-bantuan.bantuan') }}",
                            type: "POST",
                            data: {
                                bantuan_id: idBantuan,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                $('#productBody').empty();
                                response.bantuan_detail.forEach(function(item, index) {
                                    const $row = $('<tr>');
                                    $row.append($('<td>').text(index + 1));
                                    $row.append($('<td>').text(item.barang.NamaBarang));
                                    $row.append($('<td>').text(item.barang.jenis_barang
                                        .JenisBarang));
                                    $row.append($('<td align+="right">').text(item.Jumlah));
                                    $('#productBody').append($row);
                                });
                            },
                            error: function(xhr, status, error) {
                                errorAlert('Internal Server Error');
                            }
                        });
                    } else {
                        $('#productBody').empty();
                    }
                });
            });
        </script>
    @endpush
@endsection
