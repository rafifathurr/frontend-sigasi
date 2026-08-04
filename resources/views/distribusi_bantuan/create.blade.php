@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Distribusi Bantuan /</span> Tambah Distribusi Bantuan</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('distribusi-bantuan.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-lg-4">
                            <label for="idPosko" class="form-label">
                                Posko<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="idPosko" id="idPosko" required>
                                @if (empty($data->poskos))
                                    <option hidden value="">Data Tidak ada</option>
                                @else
                                    <option hidden value="">-- Pilih Posko --</option>
                                    @foreach ($data->poskos as $item)
                                        <option value="{{ $item->IDPosko }}">
                                            {{ $item->user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3 col-lg-4">
                            <label for="tanggalDistribusi" class="form-label">
                                Tanggal Distribusi<span class="ms-1 text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="tanggalDistribusi" value="{{ date('Y-m-d') }}"
                                max="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group mb-3 col-lg-4">
                            <label for="idBantuan" class="form-label">
                                Bantuan<span class="ms-1 text-danger">*</span>
                            </label>
                            <select class="w-100 select2" name="idBantuan[]" id="idBantuan" multiple="multiple" required>
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
                        <div class="form-group mb-3 col-lg-12">
                            <label for="deskripsi" class="form-label">
                                Deskripsi
                            </label>
                            <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row border-top mt-4 mb-3">
                        <div class="col-lg-5">
                            <div class="d-flex flex-row justify-content-between my-4">
                                <h5 class="fw-medium">Daftar Barang Kebutuhan Posko <span class="fw-bold"
                                        id="posko-name"></span>
                                </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="kebutuhanTable">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th width="15%">Harga Satuan</th>
                                            <th width="10%">Jumlah</th>
                                            <th width="15%">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kebutuhanBody">
                                        <tr>
                                            <td colspan="6" align="center">
                                                Harap pilih posko terlebih dahulu.
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" align="right" class="fw-bold">Total Keseluruhan Harga</td>
                                            <td align="right" class="fw-bold">Rp.<span id="totalHargaKebutuhanTxt">0</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex flex-row justify-content-between my-4">
                                <h5 class="fw-medium">Daftar Barang Bantuan</h5>
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
                                            <th width="15%">Jumlah</th>
                                            <th width="15%">Total Harga</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productBody">
                                        <tr>
                                            <td colspan="8" align="center">
                                                Harap pilih bantuan terlebih dahulu.
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" align="right" class="fw-bold">Total Keseluruhan Harga</td>
                                            <td align="right" class="fw-bold">Rp.<span id="totalHargaTxt">0</span>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
            $('#idPosko').on('change', function() {
                const idPosko = $(this).val();
                if (idPosko) {
                    $.ajax({
                        url: "{{ route('distribusi-bantuan.kebutuhan') }}",
                        type: "POST",
                        data: {
                            posko_id: idPosko,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#kebutuhanBody').empty();
                            $('#totalHargaKebutuhanTxt').text(0);
                            let totalPrice = 0;

                            if (response.length > 0) {
                                response.forEach(function(item, index) {
                                    const $row = $('<tr>');

                                    let jumlah = (item
                                        .JumlahDiterima != null ? parseInt(
                                            item.JumlahDiterima) - parseInt(
                                            item.JumlahKebutuhan) : parseInt(item
                                            .JumlahKebutuhan));

                                    totalPrice += parseInt(item
                                        .barang
                                        .HargaSatuan) * jumlah;

                                    $row.append($('<td><input type="hidden" name="kebutuhan[' +
                                        item.barang.IDBarang +
                                        '][JumlahKebutuhan]" value="' +
                                        jumlah +
                                        '">' + (index + 1) + '</td>'));
                                    $row.append($('<td>').text(item.barang.NamaBarang));
                                    $row.append($('<td>').text(item.barang.jenis_barang
                                        .JenisBarang));
                                    $row.append($(
                                        '<td align="right">Rp.' +
                                        currencyFormat(item
                                            .barang
                                            .HargaSatuan) + '</td>'));
                                    $row.append($('<td align="right">').text(jumlah));
                                    $row.append($(
                                        '<td align="right">Rp.' +
                                        currencyFormat(item
                                            .barang
                                            .HargaSatuan) + '</td>'));
                                    $('#kebutuhanBody').append($row);
                                });

                                $('#totalHargaKebutuhanTxt').text(currencyFormat(totalPrice));
                            } else {
                                const $row = $('<tr>');
                                $row.append($(
                                    '<td colspan="6" align="center">Tidak terdapat data kebutuhan pada posko.</td>'
                                ));
                                $('#kebutuhanBody').append($row);
                            }
                        },
                        error: function(xhr, status, error) {
                            errorAlert('Internal Server Error');
                        }
                    });
                } else {
                    $('#productBody').empty();
                    $row.append($(
                        '<td colspan="6" align="center">Harap pilih posko terlebih dahulu.</td>'
                    ));
                }
            });

            $('#idBantuan').on('change', function() {
                const idBantuan = $(this).val();
                if (idBantuan) {
                    $.ajax({
                        url: "{{ route('distribusi-bantuan.bantuan') }}",
                        type: "POST",
                        data: {
                            bantuans: idBantuan,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#productBody').empty();
                            $('#totalHargaTxt').text(0);
                            let totalPrice = 0;
                            let rowNum = 1;

                            if (response.length > 0) {

                                response.forEach(function(item, indexItem) {

                                    item.bantuan_detail.forEach(function(record, indexRecord) {

                                        if (record.JumlahDistribusi == null ||
                                            record.JumlahDistribusi != null &&
                                            ((parseInt(record.Jumlah) > parseInt(record
                                                .JumlahDistribusi)))) {

                                            record.Jumlah = (record.JumlahDistribusi !=
                                                null ? parseInt(
                                                    record.Jumlah) - parseInt(record
                                                    .JumlahDistribusi) : parseInt(record
                                                    .Jumlah));

                                            totalPrice += parseInt(record.barang
                                                .HargaSatuan) * parseInt(
                                                record.Jumlah);

                                            const $row = $('<tr>');

                                            $row.append($(
                                                '<td><input type="hidden" name="barang[' +
                                                (rowNum - 1) +
                                                '][IDBarang]" value="' +
                                                record.barang.IDBarang +
                                                '"><input type="hidden" name="barang[' +
                                                (rowNum - 1) +
                                                '][IDBantuan]" value="' +
                                                item.IDBantuan + '">' +
                                                rowNum + '</td>'));

                                            $row.append($('<td>').text(item.donatur
                                                .NamaPerusahaan +
                                                ' - ' +
                                                new Date(item.TanggalBantuan)
                                                .toLocaleDateString('en-GB', {
                                                    day: '2-digit',
                                                    month: 'long',
                                                    year: 'numeric'
                                                })));

                                            $row.append($('<td>').text(record.barang
                                                .NamaBarang));

                                            $row.append($('<td>').text(record.barang
                                                .jenis_barang
                                                .JenisBarang));

                                            $row.append($(
                                                '<td align="right"><input type="hidden" name="barang[' +
                                                (rowNum - 1) +
                                                '][HargaSatuan]" value="' +
                                                record.barang
                                                .HargaSatuan + '">' +
                                                'Rp.' + currencyFormat(record
                                                    .barang
                                                    .HargaSatuan) + '</td>'));

                                            $row.append($(
                                                '<td align="right"><input type="number" class="form-control text-end" name="barang[' +
                                                (rowNum - 1) +
                                                '][Jumlah]" value="' +
                                                record.Jumlah +
                                                '" min="0" style="min-wigth:100px;" oninput="adjustTotalItem(this, ' +
                                                "'" + item.IDBantuan + '-' +
                                                record.barang.IDBarang + "'" +
                                                ', ' + record.barang
                                                .HargaSatuan +
                                                ')" required></td>'
                                            ));

                                            $row.append($(
                                                '<td align="right"><input type="hidden" name="barang[' +
                                                (rowNum - 1) +
                                                '][Total]" value="' +
                                                parseInt(record
                                                    .barang
                                                    .HargaSatuan) *
                                                parseInt(
                                                    record.Jumlah) +
                                                '" id="total-barang-' +
                                                item.IDBantuan + '-' +
                                                record.barang.IDBarang +
                                                '">Rp.<span id="total-barang-' +
                                                item.IDBantuan + '-' +
                                                record.barang.IDBarang +
                                                '-text">' +
                                                currencyFormat(parseInt(record
                                                        .barang
                                                        .HargaSatuan) *
                                                    parseInt(
                                                        record.Jumlah)) +
                                                '</span></td>'));

                                            $row.append($(
                                                '<td align="center"><button class="btn btn-danger btn-icon btn-remove"><i class="fa fa-trash"></i></button></td>'
                                            ));

                                            $('#productBody').append($row);

                                            rowNum++;
                                        }
                                    });

                                    $('#totalHargaTxt').text(currencyFormat(totalPrice));
                                });

                            } else {
                                const $row = $('<tr>');
                                $row.append($(
                                    '<td colspan="8" align="center">Tidak terdapat data bantuan.</td>'
                                ));
                                $('#productBody').append($row);
                            }
                        },
                        error: function(xhr, status, error) {
                            errorAlert('Internal Server Error');
                        }
                    });
                } else {
                    $('#productBody').empty();
                    $row.append($(
                        '<td colspan="8" align="center">Harap pilih bantuan terlebih dahulu.</td>'
                    ));
                }
            });

            function reorderRows() {
                $('#productBody tr').each(function(index) {
                    const rowNum = index + 1;
                    const arrayIndex = index;

                    // Update nomor urut
                    $(this).find('td:first').contents().filter(function() {
                        return this.nodeType === 3; // text node
                    }).first().replaceWith(rowNum);

                    // Update semua name barang[index][...]
                    $(this).find('[name]').each(function() {
                        const name = $(this).attr('name');

                        if (name) {
                            $(this).attr(
                                'name',
                                name.replace(/^barang\[\d+\]/, `barang[${arrayIndex}]`)
                            );
                        }
                    });
                });
            }

            $(document).on('click', '.btn-remove', function() {
                $(this).closest('tr').remove();
                calculateAll();
                reorderRows()
            });

            function reorderRows() {
                $('#productBody tr').each(function(index) {
                    const rowNum = index + 1;
                    const arrayIndex = index;

                    $(this).find('td:first').contents().filter(function() {
                        return this.nodeType === 3;
                    }).first().replaceWith(rowNum);

                    $(this).find('[name]').each(function() {
                        const name = $(this).attr('name');

                        if (name) {
                            $(this).attr(
                                'name',
                                name.replace(/^barang\[\d+\]/, `barang[${arrayIndex}]`)
                            );
                        }
                    });
                });
            }

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

            function calculateAll() {
                let totalPrice = 0;

                $('input[name^="barang"][name$="[Total]"]').each(function() {
                    totalPrice += parseInt($(this).val());
                });

                $('#totalHargaTxt').text(currencyFormat(totalPrice));
            }
        </script>
    @endpush
@endsection
