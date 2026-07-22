@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Rencana Anggaran /</span> Tambah Rencana Anggaran</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('rencana-anggaran.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-lg-4">
                            <label for="TanggalRencana" class="form-label">
                                Tanggal Rencana<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="TanggalRencana" value="{{ date('Y-m-d') }}"
                                max="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group mb-3 col-lg-4">
                            <label for="NilaiAnggaran" class="form-label">
                                Nilai Anggaran<span class="ms-1 text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="NilaiAnggaran" id="NilaiAnggaran"
                                    placeholder="Masukan Nilai Anggaran" min="0" required>
                                <button type="button" class="btn btn-primary btn-icon" title="Adjust Nilai"
                                    onclick="adjustNilai()"><i class="fa fa-edit"></i></button>
                            </div>
                        </div>
                        <div class="form-group mb-3 col-lg-4">
                            <label for="IDBantuan" class="form-label">
                                Bantuan<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="IDBantuan[]" id="IDBantuan" multiple="multiple" required>
                                @if (empty($data->bantuans))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Bantuan --</option>
                                    @foreach ($data->bantuans as $item)
                                        <option value="{{ $item->IDBantuan }}">
                                            {{ $item->donatur->NamaPerusahaan }} -
                                            {{ date('d F Y', strtotime($item->TanggalBantuan)) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-12">
                            <label for="Keterangan" class="form-label">
                                Keterangan
                            </label>
                            <textarea class="form-control" name="Keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12 border-top mt-4 mb-3">
                        <div class="d-flex flex-row justify-content-between my-4">
                            <h5 class="fw-medium">Daftar Detail Barang Bantuan</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="productTable">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Bantuan</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th width="15%">Harga Satuan</th>
                                        <th width="10%">Jumlah</th>
                                        <th width="15%">Total Harga</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="productBody">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" align="right" class="fw-bold">Total Keseluruhan Harga</td>
                                        <td align="right" class="fw-bold"><input type="hidden" id="totalHarga">Rp.<span
                                                id="totalHargaTxt">0</span></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-end align-items-center gap-2 pb-3 pt-0">
                    <a class="btn btn-secondary text-white" href="{{ route('rencana-anggaran.index') }}">
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
            let listTable;

            $('#IDBantuan').on('change', function() {
                const idBantuan = $(this).val();

                if (idBantuan.length > 0) {

                    $.ajax({
                        url: "{{ route('rencana-anggaran.bantuan') }}",
                        type: "POST",
                        data: {
                            bantuans: idBantuan,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#productBody').empty();
                            let totalPrice = 0;
                            let rowNum = 1;

                            response.forEach(function(record, indexRecord) {

                                record.bantuan_detail.forEach(function(item, index) {

                                    totalPrice += parseInt(item.barang
                                        .HargaSatuan) * parseInt(
                                        item.Jumlah);

                                    const $row = $('<tr>');

                                    $row.append($(
                                        '<td><input type="hidden" name="barang[' +
                                        (rowNum - 1) +
                                        '][IDBarang]" value="' +
                                        item.barang.IDBarang +
                                        '"><input type="hidden" name="barang[' +
                                        (rowNum - 1) +
                                        '][IDBantuan]" value="' +
                                        record.IDBantuan + '">' +
                                        rowNum + '</td>'));

                                    $row.append($('<td>').text(record.donatur
                                        .NamaPerusahaan + ' - ' +
                                        new Date(record.TanggalBantuan)
                                        .toLocaleDateString('en-GB', {
                                            day: '2-digit',
                                            month: 'long',
                                            year: 'numeric'
                                        })));

                                    $row.append($('<td>').text(item.barang
                                        .NamaBarang));

                                    $row.append($('<td>').text(item.barang
                                        .jenis_barang
                                        .JenisBarang));

                                    $row.append($(
                                        '<td align="right"><input type="hidden" name="barang[' +
                                        (rowNum - 1) +
                                        '][HargaSatuan]" value="' +
                                        item.barang
                                        .HargaSatuan + '">' +
                                        'Rp.' + currencyFormat(item
                                            .barang
                                            .HargaSatuan) + '</td>'));

                                    $row.append($(
                                        '<td align="right"><input type="number" class="form-control text-end" name="barang[' +
                                        (rowNum - 1) +
                                        '][Jumlah]" value="' +
                                        item.Jumlah +
                                        '" min="0" style="min-wigth:50px;" oninput="adjustTotalItem(this, ' +
                                        "'" + record.IDBantuan + '-' +
                                        item.barang.IDBarang + "'" +
                                        ', ' + item.barang
                                        .HargaSatuan +
                                        ')" required></td>'
                                    ));

                                    $row.append($(
                                        '<td align="right"><input type="hidden" name="barang[' +
                                        (rowNum - 1) +
                                        '][Total]" value="' +
                                        parseInt(item
                                            .barang
                                            .HargaSatuan) *
                                        parseInt(
                                            item.Jumlah) +
                                        '" id="total-barang-' +
                                        record.IDBantuan + '-' +
                                        item.barang.IDBarang +
                                        '">Rp.<span id="total-barang-' +
                                        record.IDBantuan + '-' +
                                        item.barang.IDBarang +
                                        '-text">' +
                                        currencyFormat(parseInt(item
                                                .barang
                                                .HargaSatuan) *
                                            parseInt(
                                                item.Jumlah)) +
                                        '</span></td>'));

                                    $row.append($(
                                        '<td align="center"><button class="btn btn-danger btn-icon btn-remove"><i class="fa fa-trash"></i></button></td>'));

                                    $('#productBody').append($row);

                                    rowNum++;
                                });
                            });

                            $('#totalHarga').val(totalPrice);
                            $('#totalHargaTxt').text(currencyFormat(totalPrice));
                            validationCalculate();
                        },
                        error: function(xhr, status, error) {
                            errorAlert('Internal Server Error');
                        }
                    });
                } else {
                    $('#productBody').empty();
                }
            });

            $('#NilaiAnggaran').on('change', function() {
                validationCalculate();
            });

            $(document).on('click', '.btn-remove', function() {
                $(this).closest('tr').remove();
                calculateAll();
            });

            function currencyFormat(value) {
                return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            }

            function adjustTotalItem(e, key, price) {
                const qty = e.value;
                const totalPrice = parseInt(qty) * parseInt(price);

                $('#total-barang-' + key).val(totalPrice);
                $('#total-barang-' + key + '-text').html(currencyFormat(totalPrice));

                calculateAll();
            }

            function adjustNilai() {
                $('#NilaiAnggaran').val($('#totalHarga').val());
            }

            function calculateAll() {
                let totalPrice = 0;

                $('input[name^="barang"][name$="[Total]"]').each(function() {
                    totalPrice += parseInt($(this).val());
                });

                $('#totalHarga').val(totalPrice);
                $('#totalHargaTxt').text(currencyFormat(totalPrice));
                
                validationCalculate();
            }

            function validationCalculate() {
                const nilaiAnggaran = $('#NilaiAnggaran').val();
                const totalHarga = $('#totalHarga').val();

                if (nilaiAnggaran != '' && totalHarga != '' && (parseInt(totalHarga) > parseInt(nilaiAnggaran))) {
                    errorAlert(
                        'Total nilai barang bantuan melebihi nilai rencana anggaran, Harap sesuaikan nilai barang bantuan / nilai rencana anggaran kembali!'
                    );
                }
            }
        </script>
    @endpush
@endsection
