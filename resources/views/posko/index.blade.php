@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Beranda /</span> Daftar Posko</h4>
        <div class="card shadow-sm border-0 w-100">
            <div class="card-body">
                @if ($access['can_create'])
                    <div class="row pt-2 pb-4 align-items-end">
                        <div class="col-lg-3">
                            <a href="{{ route('posko.create') }}" class="btn btn-primary ms-auto"><i
                                    class="fa fa-plus me-2"></i>Tambah</a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-posko">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Pengguna</th>
                                <th>Lokasi</th>
                                <th>Masalah</th>
                                <th>Solusi</th>
                                @if ($access['can_edit'] && $access['can_create'])
                                    <th width="10%">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div>
    @push('javascript')
        @if ($access['can_edit'] && $access['can_create'])
            <script>
                $('#table-posko').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('posko.index') }}",
                        error: function(xhr, error, code) {
                            errorAlert(xhr.statusText);
                        }
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.settings._iDisplayStart + meta.row + 1;
                            }
                        },
                        {
                            data: 'user.name'
                        },
                        {
                            data: 'Lokasi'
                        },
                        {
                            data: 'Masalah'
                        },
                        {
                            data: 'SolusiMasalah'
                        },
                        {
                            data: 'IDPosko',
                            orderable: false,
                            searchable: false,
                            className: 'dt-center',
                            render: function(data, type, row) {
                                let baseUrl = `{{ url('posko') }}`;
                                return `
                    <div class="btn-group">
                        <button type="button"
                            class="btn btn-icon text-primary rounded-pill dropdown-toggle hide-arrow"
                            data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item"
                                   href="${baseUrl}/${data}/edit">
                                    <i class="fa fa-edit me-2"></i>Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" onclick="destroy('${baseUrl}/${data}')">
                                    <i class="fa fa-trash me-2"></i>Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                `;
                            }
                        }
                    ]
                });
            </script>
        @else
            <script>
                $('#table-posko').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('posko.index') }}",
                        error: function(xhr, error, code) {
                            errorAlert(xhr.statusText);
                        }
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.settings._iDisplayStart + meta.row + 1;
                            }
                        },
                        {
                            data: 'user.name'
                        },
                        {
                            data: 'Lokasi'
                        },
                        {
                            data: 'Masalah'
                        },
                        {
                            data: 'SolusiMasalah'
                        },
                    ]
                });
            </script>
        @endif
    @endpush
@endsection
