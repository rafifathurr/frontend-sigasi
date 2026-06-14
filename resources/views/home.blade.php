@extends('layout.main')
@section('content')
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class='bx bx-info-circle me-2'></i>
                    Selamat Datang Di Portal <span class="fw-bold">SIGASI</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="col-md-12 mb-3 order-0">
                <div class="card">
                    <div class="card-body">
                        <?php
                        $hour = date('H');
                        $greetings = $hour >= 18 ? 'Selamat Malam' : ($hour >= 12 ? 'Selamat Siang' : 'Selamat Pagi');
                        ?>
                        <h5 class="card-title text-primary"><?= $greetings ?>!</h5>
                        <h4 class="fw-bold text-dark mb-1"><?= $name ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
