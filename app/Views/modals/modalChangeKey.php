<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <!-- TITLE -->
                <h5 class="modal-title" id="staticBackdropLabel"><?php echo $title; ?></h5>
                <!-- CLOSE -->
                <button type="button" class="btn-close closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <label for="txt-newPassword">Nueva Clave</label>
                    <input id="txt-newPassword" type="password" class="form-control modal-required focus" />
                    <p id="msg-txt-newPassword" class="text-danger text-end"></p>
                </div>
                <div class="col-12">
                    <label for="txt-repeatNewPassword">Repita su Clave</label>
                    <input id="txt-repeatNewPassword" type="password" class="form-control modal-required focus" />
                    <p id="msg-txt-repeatNewPassword" class="text-danger text-end"></p>
                </div>
            </div>
            <?php echo view('modals/modalFooter'); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn-modal-submit').on('click', function() {
            let result = checkRequiredValues('modal-required');
            if (result == 0) {
                let password = $('#txt-newPassword').val();
                let repeatPassword = $('#txt-repeatNewPassword').val();
                if (password == repeatPassword) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('TPV/updatePassword') ?>",
                        data: {
                            'password': password
                        },
                        dataType: "json",
                        success: function(response) {
                            switch (response.error) {
                                case 0:
                                    showToast('success', 'Clave de acceso actualizada!');
                                    closeModal();
                                    break;
                                case 1:
                                    showToast('error', 'Ha ocurrido un error!');
                                    break;
                                case 2:
                                    window.location.href = "<?php echo base_url('Authentication?session=expired'); ?>";
                                    break;
                            }
                        },
                        error: function(error) {
                            showToast('error', 'Ha ocurrido un error!');
                        }
                    });
                } else {
                    showToast('error', 'Las claves no coinciden!');
                    $('#txt-repeatNewPassword').addClass('is-invalid');
                    $('#msg-txt-repeatNewPassword').html('Las claves no coinciden!');
                }

            } else
                showToast('error', 'Todos los campos son requeridos!');
        });
    });
</script>