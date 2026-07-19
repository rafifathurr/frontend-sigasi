@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Bantuan /</span> Tambah Bantuan</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('bantuan.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-4">
                            <label for="donatur" class="form-label">
                                Donatur<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="donatur" required>
                                @if (empty($donaturs))
                                    <option hidden value="">Data Tidak Ada</option>
                                @else
                                    <option hidden value="">-- Pilih Donatur --</option>
                                    @foreach ($donaturs as $item)
                                        <option value="{{ $item->IDDonatur }}">{{ $item->NamaPerusahaan }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="tanggal_bantuan" class="form-label">
                                Tanggal Bantuan<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_bantuan" value="{{ date('Y-m-d') }}"
                                max="{{ date('Y-m-d') }}" class="form-control" required>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="barang" class="form-label">
                                Barang<span class="ms-1 text-danger">*</span>
                            </label>
                            <div class="d-flex flex-row gap-2">
                                <select class="w-100 select2" id="barang" name="barang">
                                    @if (empty($barangs))
                                        <option hidden value="">Data Tidak Ada</option>
                                    @else
                                        <option hidden value="">-- Pilih Barang --</option>
                                        @foreach ($barangs as $item)
                                            <option value="{{ $item->IDBarang }}">{{ $item->NamaBarang }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <a id="addItemBtn" class="btn btn-icon bg-primary text-white">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border-top mt-4 mb-3">
                        <h5 class="pt-4">Daftar Barang</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th width="5%">Action</th>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('bantuan.index') }}">
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
            $(document).ready(function() {
                $('#addItemBtn').on('click', function() {
                    const itemName = $('#barang option:selected').text();
                    const barangId = $('#barang option:selected').val();

                    if (barangId == undefined || barangId == '') {
                        alert("Silakan pilih barang terlebih dahulu!");
                        return;
                    }

                    // Check if item already exists
                    const existingRow = $(`.barang-${barangId}`);

                    if (existingRow.length > 0) {
                        // If exists, get current quantity and increment
                        const qtyInput = existingRow.find('input[name="qty[]"]');
                        const currentQty = parseInt(qtyInput.val()) || 0;
                        qtyInput.val(currentQty + 1);
                    } else {
                        // If not exists, add new row
                        $('#tableBody').append(`
                        <tr class="barang-${barangId}">
                            <td>
                                ${itemName}
                            </td>
                            <td>
                                <input type="number"
                                    class="form-control"
                                    name="barang[${barangId}][jumlah_barang]"
                                    value="1"
                                    min="1">
                                <input type="hidden"
                                    name="barang[${barangId}][id_barang]"
                                    value="${barangId}">
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-icon bg-danger btn-remove text-white">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                    }

                    // Reset barang selection
                    $('#barang').prop('selectedIndex', 0);
                });

                // Handle remove button click
                $(document).on('click', '.btn-remove', function() {
                    $(this).closest('tr').remove();
                });

                // Form submission validation
                $('form').on('submit', function(e) {
                    const rows = $('#tableBody tr').length;
                    if (rows === 0) {
                        e.preventDefault();
                        alert('Silakan tambahkan minimal satu barang!');
                        return false;
                    }

                    // Validate quantities
                    let valid = true;
                    $('input[name="qty[]"]').each(function() {
                        const qty = parseInt($(this).val());
                        if (isNaN(qty) || qty < 1) {
                            valid = false;
                            return false; // break loop
                        }
                    });

                    if (!valid) {
                        e.preventDefault();
                        alert('Jumlah barang harus valid dan minimal 1!');
                        return false;
                    }
                });
            });
        </script>
    @endpush
@endsection
