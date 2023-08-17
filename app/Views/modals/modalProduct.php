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
                <div class="row">
                    <div class="col-12 mt-2">
                        <label for="txt-name">Artículo</label>
                        <input id="txt-name" type="text" class="form-control modal-required focus" value="<?php echo @$product[0]->name; ?>">
                        <p id="msg-txt-name" class="text-danger text-end"></p>
                    </div>
                    <div class="col-6">
                        <label for="txt-code">Código</label>
                        <input id="txt-code" type="text" class="form-control modal-required focus" value="<?php echo @$product[0]->code; ?>">
                        <p id="msg-txt-code" class="text-danger text-end"></p>
                    </div>
                    <div class="col-6">
                        <label for="txt-price">Precio</label>
                        <input id="txt-price" type="text" class="form-control modal-required focus decimal" value="<?php echo @$product[0]->price; ?>">
                        <p id="msg-txt-price" class="text-danger text-end"></p>
                    </div>
                </div>
            </div>
            <?php echo view('modals/modalFooter'); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#btn-modal-submit').on('click', function() {
            let result = checkRequiredValues('modal-required');
            if (result == 0) {
                $('#btn-modal-submit').attr('disabled', true);
                let action = '<?php echo $action; ?>';
                let url = '';
                let msg = '';
                if(action == 'create') {
                    url = "<?php echo base_url('TPV/createProduct'); ?>";
                    msg = 'Artículo Creado!';
                }
                else {
                    url = "<?php echo base_url('TPV/updateProduct'); ?>";
                    msg = 'Artículo Actualizado!';
                }
                $.ajax({
                    type: "post",
                    url: url,
                    url: url,
                    data: {
                        'name': $('#txt-name').val(),
                        'code': $('#txt-code').val(),
                        'price': $('#txt-price').val(),
                        'id': '<?php echo @$product[0]->id; ?>'
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                dtArticle.draw();
                                showToast('success', msg);
                                closeModal();
                                break;
                            case 1:
                                showToast('error', 'Ha ocurrido un error!');
                                break;
                            case 2:
                                window.location.href = "<?php echo base_url('Authentication?session=expired'); ?>";
                                break;
                            case 3:
                                showToast('error', 'Ya existe un artículo con ese código!');
                                $('#txt-code').addClass('is-invalid');
                                $('#msg-txt-code').html('Ya existe un artículo con ese código');
                                $('#btn-modal-submit').removeAttr('disabled');
                                break;
                        }
                    },
                    error: function(error) {
                        showToast('error', 'Ha ocurrido un error!');
                    }
                });
            } else
                showToast('error', 'Todos los campos son requeridos!');
        });
    });
</script>