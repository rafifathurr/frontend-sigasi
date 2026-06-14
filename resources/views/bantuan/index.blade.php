@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Beranda /</span> Daftar Bantuan</h4>
        <div class="card shadow-sm border-0 w-100">
            <div class="card-body p-3">
                @if ($access['can_create'])
                    <div class="row pt-2 pb-4 align-items-end">
                        <div class="col-lg-3">
                            <a href="{{ route('bantuan.create') }}" class="btn btn-primary ms-auto"><i
                                    class="fa fa-plus me-2"></i>Tambah</a>
                        </div>
                    </div>
                @endif
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>Donatur</th>
                            <th>Tangal Bantuan</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->donatur->NamaPerusahaan }}</td>
                                <td>{{ $item->TanggalBantuan }}</td>
                                <td>
                                    <div class="btn-group dropstart">
                                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('bantuan.show', $item->IDBantuan) }}">
                                                    View
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('bantuan.edit', $item->IDBantuan) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{ $item->IDBantuan }}" href="#">
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <div class="modal fade" id="delete-{{ $item->IDBantuan }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin untuk hapus data?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tidak</button>
                                                <form action="{{ route('bantuan.destroy', $item->IDBantuan) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="sumbit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!--end::Container-->
    @push('javascript')
    @endpush
@endsection
