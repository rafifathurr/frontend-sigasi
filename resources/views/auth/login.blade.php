<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Sigasi Web Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= asset('assets/images/favicon.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('assets/vendors/toastify/toastify.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/vendors/fonts/boxicons.css') ?>" />
    <link rel="stylesheet" href="<?= asset('assets/vendors/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= asset('assets/vendors/css/theme-default.css') ?>"
        class="template-customizer-theme-css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            padding: 25px;
            border-radius: 16px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            color: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="pt-3 pb-1">
            <img class="mb-2" src="<?= asset('assets/images/sigasi-logo.png') ?>" alt="Logo Sigasi"
                style="width: 250px;">
            <p class="fw-normal text-black">Harap login terlebih dahulu.</p>
        </div>
        <form action="<?= route('auth') ?>" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="email_or_username" value="<?= old('username') ?>"
                    placeholder="Username" required>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                    required>
                <span id="eye" class="input-group-text cursor-pointer"><i class="bx bx-show"></i></span>
            </div>
            <button type="submit"
                class="d-flex align-items-center justify-content-center mb-4 btn btn-block w-100 btn-primary"
                id="btnSubmit">Login</button>
            <div class="my-3">
                <p class="fw-normal text-secondary mb-0">Copyright © <?= date('Y') ?> SIGASI.</p>
                <p class="fw-normal text-secondary">All Rights Reserved.</p>
            </div>
        </form>
    </div>
    <script src="<?= asset('assets/vendors/js/bootstrap.js') ?>"></script>
    <script src="<?= asset('assets/vendors/toastify/toastify.js') ?>"></script>
    <script src="<?= asset('assets/vendors/jquery/jquery.min.js') ?>"></script>
    <script>
        $('form').on('submit', function(e) {
            $(this).find(':input[type="submit"]').attr('disabled', true).html(
                '<div class="spinner-border me-2"></div><span>Loading</span>');
        });

        $('#eye').on('click', function() {
            if ($('#password').attr('type') == 'password') {
                $('#eye').find('.bx-show').removeClass('bx-show').addClass('bx-hide');
                $('#password').attr('type', 'text');
            } else {
                $('#eye').find('.bx-hide').removeClass('bx-hide').addClass('bx-show');
                $('#password').attr('type', 'password');
            }
        });
    </script>
    @if (session()->has('error'))
        <script>
            Toastify({
                text: "<i class='bx bxs-x-circle me-2'></i><span class='me-2'>{{ session('error') }}</span>",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#dc3545",
            }).showToast();
        </script>
    @elseif (session()->has('success'))
        <script>
            Toastify({
                text: "<i class='bx bx-check-circle me-2'></i><span class='me-2'>{{ session('success') }}</span>",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#28a745",
            }).showToast();
        </script>
    @elseif (session()->has('warning'))
        <script>
            Toastify({
                text: "<i class='bx bxs-error-circle me-2'></i><span class='me-2'>{{ session('warning') }}</span>",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#ffc107",
            }).showToast();
        </script>
    @elseif (session()->has('info'))
        <script>
            Toastify({
                text: "<i class='bx bx-info-circle me-2'></i><span class='me-2'>{{ session('info') }}</span>",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#007bff",
            }).showToast();
        </script>
    @endif
</body>

</html>
