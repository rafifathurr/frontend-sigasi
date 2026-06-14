<div class="modal fade" id="delete-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin untuk hapus data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa fa-arrow-left me-2"></i>Kembali</button>
                <form action="" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="sumbit" class="btn btn-danger"><i class="fa fa-trash me-2"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JS -->
<script src="<?= asset('assets/vendors/jquery/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/vendors/libs/popper/popper.js') ?>"></script>
<script src="<?= asset('assets/vendors/js/bootstrap.js') ?>"></script>
<script src="<?= asset('assets/vendors/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
<script src="<?= asset('assets/vendors/libs/apex-charts/apexcharts.js') ?>"></script>
<script src="<?= asset('assets/vendors/js/menu.js') ?>"></script>
<script src="<?= asset('assets/js/main.js') ?>"></script>
<script src="<?= asset('assets/vendors/toastify/toastify.js') ?>"></script>
<script src="<?= asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="<?= asset('assets/vendors/datatables/datatables.min.js') ?>"></script>
<script src="<?= asset('assets/vendors/select2/select2-4.0.13/dist/js/select2.min.js') ?>"></script>
<script src="<?= asset('assets/vendors/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
<script src="<?= asset('assets/js/extended-ui-perfect-scrollbar.js') ?>"></script>

<!-- Global Function -->
<script>
    // Form Submit With Confirmation
    function formSubmit(idForm) {

        let isValid = true;

        $("#" + idForm + " :required").each(function(index) {

            let input = $(this);

            if (input.hasClass("select2-hidden-accessible")) {
                let select2Box = input.next(".select2");
                select2Box.find(".select2-selection").removeClass("invalid");
                select2Box.next(".error-feedback").remove();
            } else {
                input.removeClass("invalid");

                if (input.parent().attr('class') == 'input-group') {
                    input.parent().parent().find('.error-feedback').remove();
                } else {
                    input.next(".error-feedback").remove();
                }
            }

            if (input.val() === "") {
                isValid = false;

                if (input.hasClass('select2-hidden-accessible')) {
                    let select2Box = input.next('.select2');
                    select2Box.next('.error-feedback').remove();
                    select2Box.find('.select2-selection').addClass("invalid");
                    select2Box.after(
                        '<div class="error-feedback form-text text-danger">Field Wajib Diisi!</div>');
                } else {
                    input.addClass("invalid");
                    if (input.parent().attr('class') == 'input-group') {
                        input.parent().parent().find('.error-feedback').remove();
                        input.parent().after(
                            '<div class="error-feedback form-text text-danger">Field Wajib Diisi!</div>');
                    } else {
                        input.parent().find('.error-feedback').remove();
                        input.after(
                            '<div class="error-feedback form-text text-danger">Field Wajib Diisi!</div>');
                    }
                }
            }
        });

        if (isValid) {
            confirmationAlert('Apakah Anda Yakin Untuk Submit?', function() {
                $('#' + idForm).find(':input[type="button"][onclick^="formSubmit"]').attr('disabled', true)
                    .html('<div class="spinner-border me-2"></div><span>Loading</span>');
                $('#' + idForm).unbind('submit').submit();
            });
        }

    }

    // Hit Delete Record Require String URL, Object Attribute and Boolean isCallback
    function destroy(url) {
        $('#delete-form').find('form').attr('action', url);
        $('#delete-form').modal('show');
    }
</script>

<!-- Sweet Alert JS -->
<script>
    // Question of Confirmation Alert
    function confirmationAlert(message, callback) {
        Swal.fire({
            title: "<b>Konfirmasi</b>",
            text: message,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-check me-2"></i>Ya',
            cancelButtonText: '<i class="fa fa-close me-2"></i>Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }
</script>

<!-- Alert JS with Session Logic -->
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
    @php
        session()->forget('error');
    @endphp
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
    @php
        session()->forget('success');
    @endphp
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
    @php
        session()->forget('warning');
    @endphp
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
    @php
        session()->forget('info');
    @endphp
@endif
<script>
    function errorAlert(message) {
        Toastify({
            text: '<i class="bx bxs-x-circle me-2"></i><span class="me-2">' + message + '</span>',
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "#dc3545",
        }).showToast();
    }

    function successAlert(message) {
        Toastify({
            text: '<i class="bx bx-check-circle me-2"></i><span class="me-2">' + message + '</span>',
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "#28a745",
        }).showToast();
    }

    function warningAlert(message) {
        Toastify({
            text: '<i class="bx bxs-error-circle me-2"></i><span class="me-2">' + message + '</span>',
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "#ffc107",
        }).showToast();
    }

    function infoAlert(message) {
        Toastify({
            text: '<i class="bx bx-info-circle me-2"></i><span class="me-2">' + message + '</span>',
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "#007bff",
        }).showToast();
    }
</script>

<!-- Timestamp Dashboard Logic -->
<script>
    updateTimestamp();
    setInterval(updateTimestamp, 1000);

    function updateTimestamp() {
        var now = new Date();
        var formattedTime = now.toLocaleTimeString("it-IT");
        $('#timestamp').text(formattedTime);
    }
</script>

<!-- Datatable Class -->
<script>
    $('.datatable').DataTable();
</script>

<!-- Select2 Class -->
<script>
    $('.select2').select2();
</script>

@stack('javascript')
