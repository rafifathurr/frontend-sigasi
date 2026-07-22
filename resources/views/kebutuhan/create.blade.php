@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Kebutuhan /</span> Tambah Kebutuhan</h4>
        <div class="card shadow-sm border-0 w-100">
            <form action="{{ route('kebutuhan.store') }}" method="POST" id="form-submit">
                @csrf
                <div class="card-body">
                    <div class="row">
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
                    </div>
                    <div class="col-lg-12 border-top mt-4 mb-3">
                        <div class="d-flex flex-row justify-content-between my-4">
                            <h5 class="fw-medium">Daftar Barang</h5>
                            <button type="button" class="btn btn-primary" id="btnAddRow">
                                <i class="fa fa-plus me-2"></i>Tambah Barang
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="productTable">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="10%">Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="productBody">
                                </tbody>
                            </table>
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
    <div id="element-items" class="d-none">
        <table>
            <tr class="product-row">
                <td class="col-no row-num"></td>
                <td class="col-id">
                    <select class="w-100 select2" name="product[idProduct]" required>
                        @if (empty($data->barang))
                            <option hidden value="">Data Tidak ada</option>
                        @else
                            <option hidden value="">-- Pilih Posko --</option>
                            @foreach ($data->barang as $item)
                                <option value="{{ $item->IDBarang }}">
                                    {{ $item->NamaBarang }}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td class="col-qty">
                    <input type="number" class="form-control inp-qty" min="1" name="product[qty]"
                        placeholder="Contoh: 50" value="" />
                </td>
                <td class="col-del">
                    <button class="btn btn-icon btn-danger btn-del" title="Hapus Barang">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        </table>
    </div>
    @push('javascript')
        <script>
            $(function() {
                let rowCount = 0;

                /* ─── render a row ─── */
                function makeRow() {
                    rowCount++;

                    // Destroy select2 di template dulu sebelum clone
                    // agar tidak ada sisa render select2 yang ikut ter-clone
                    $('#element-items tr').find('select').each(function() {
                        if ($(this).hasClass('select2-hidden-accessible')) {
                            $(this).select2('destroy');
                        }
                    });

                    const $row = $('#element-items tr').clone();

                    // Update nomor urut
                    $row.find('.row-num').text(rowCount);

                    // Update name attribute
                    $row.find('[name]').each(function() {
                        const newName = $(this).attr('name')
                            .replace('product[', `product[${rowCount - 1}][`);
                        $(this).attr('name', newName);
                    });

                    return $row;
                }

                /* ─── re-number rows ─── */
                function renumber() {
                    $('#productBody .product-row').each(function(i) {
                        $(this).find('.row-num').text(i + 1);

                        $(this).find('[name]').each(function() {
                            const newName = $(this).attr('name')
                                .replace(/product\[\d+\]\[/, `product[${i}][`);
                            $(this).attr('name', newName);
                        });
                    });
                }

                /* ─── add row ─── */
                $('#btnAddRow').on('click', function() {
                    const $row = makeRow();
                    $('#productBody').append($row);

                    // Init select2 SETELAH append ke DOM
                    $row.find('.select2').select2({
                        placeholder: '-- Pilih Barang --',
                        width: '100%'
                    });

                    renumber();
                });

                /* ─── delete row ─── */
                $('#productBody').on('click', '.btn-del', function() {
                    $(this).closest('tr').remove();
                    renumber();
                });

                /* ─── remove invalid on input ─── */
                $('#productBody').on('input change', '.is-invalid', function() {
                    $(this).removeClass('is-invalid');
                });

            });
        </script>
    @endpush
@endsection
