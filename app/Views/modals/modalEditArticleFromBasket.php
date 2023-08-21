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
                    <div class="col-3">
                        <label for="txt-price">Precio</label>
                        <input id="txt-price" type="text" class="form-control modal-required focus decimal" value="<?php echo number_format($dataEdit[0]->amount, 2, ".", ','); ?>">
                        <p id="msg-txt-price" class="text-danger text-end"></p>
                    </div>
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
                $('#btn-modal-submit').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('TPV/updateArticlePriceFromBasket'); ?>",
                    data: {
                        'amount': $('#txt-price').val(),
                        'id': '<?php echo $dataEdit[0]->id; ?>'
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                dtBasket();
                                showToast('success', 'Precio del artículo actualizado en la cesta!');
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
                        showToast('error', 'Todos los campos son requeridos!');
                    }
                });
            } else
                showToast('error', 'Todos los campos son requeridos!');
        });
    });
</script>