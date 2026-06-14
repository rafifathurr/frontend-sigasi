@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">Beranda /</span> Log Activity</h4>
        <div class="card shadow-sm border-0 w-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-log">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>User</th>
                                <th>Url</th>
                                <th>IP Address</th>
                                <th>Tanggal dan Waktu Akses</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div>
    @push('javascript')
        <script>
            $('#table-log').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('log-activity.index') }}",
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
                        data: 'Url'
                    },
                    {
                        data: 'IpAddress'
                    },
                    {
                        data: 'created_at'
                    },
                ]
            });
        </script>
    @endpush
@endsection
