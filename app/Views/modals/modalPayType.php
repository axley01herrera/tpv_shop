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
                    <div class="col-6 text-center">
                        <input id="radio-e" type="radio" class="radio-payType" name="radio-payType" value="1" /> <label for="radio-e">Efectivo</label>
                    </div>
                    <div class="col-6 text-center">
                        <input id="radio-t" type="radio" class="radio-payType" name="radio-payType" value="2" /> <label for="radio-t">Tarjeta</label>
                    </div>

                </div>
            </div>
            <?php echo view('modals/modalFooter'); ?>
        </div>
    </div>
</div>

<script>
    var payType = '<?php echo @$payType; ?>';

    $('.radio-payType').on('click', function() {
        payType = $(this).val();
    });

    $('#btn-modal-submit').on('click', function() {
        if (payType != '') {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('TPV/charge'); ?>",
                data: {
                    'payType': payType,
                    'basketID': '<?php echo $basketID; ?>'
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            setTimeout(() => {
                                window.location.reload();
                            }, "1000");
                            showToast('success', 'Cesta cobrada!');
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
        } else
            showToast('error', 'Debe seleccionar un tipo de pago!');
    });
</script>