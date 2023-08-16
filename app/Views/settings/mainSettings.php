<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Ajustes del Sistema</h5>
        </div>
        <div class="card-body">
            <section>
                <div class="row">
                    <h6>Datos Fiscales</h6>
                    <div class="col-12 col-lg-6 mt-2">
                        <label for="txt-name">Nombre del Negocio</label>
                        <input type="text" id="txt-name" class="form-control required focus" value="<?php echo $settings->name; ?>" />
                    </div>
                    <div class="col-12 col-lg-3 mt-2">
                        <label for="txt-cif">CIF</label>
                        <input type="text" id="txt-cif" class="form-control required focus" value="<?php echo $settings->cif; ?>" />
                    </div>
                </div>
            </section>
            <section>
                <div class="row mt-3">
                    <h6>Dirección</h6>
                    <div class="col-12 col-lg-6 mt-2">
                        <label for="txt-address1">Calle</label>
                        <input type="text" id="txt-address1" class="form-control required focus" value="<?php echo $settings->address1; ?>" />
                    </div>
                    <div class="col-12 col-lg-6 mt-2">
                        <label for="txt-address2">Número, apt, puerta etc..</label>
                        <input type="text" id="txt-address2" class="form-control required focus" value="<?php echo $settings->address2; ?>" />
                    </div>
                    <div class="col-12 col-lg-3 mt-2">
                        <label for="txt-city">Ciudad</label>
                        <input type="text" id="txt-city" class="form-control required focus" value="<?php echo $settings->city; ?>" />
                    </div>
                    <div class="col-12 col-lg-3 mt-2">
                        <label for="txt-state">Provincia</label>
                        <input type="text" id="txt-state" class="form-control required focus" value="<?php echo $settings->state; ?>" />
                    </div>
                    <div class="col-12 col-lg-3 mt-2">
                        <label for="txt-zipCode">Codigo Postal</label>
                        <input type="text" id="txt-zipCode" class="form-control required focus number" maxlength="5" value="<?php echo $settings->zipCode; ?>" />
                    </div>
                    <div class="col-12 col-lg-3 mt-2">
                        <label for="txt-country">País</label>
                        <input type="text" id="txt-country" class="form-control required focus" value="<?php echo $settings->country; ?>" />
                    </div>
                </div>
            </section>
            <section>
                <div class="row mt-3">
                    <h6>Datos de Contacto</h6>
                    <div class="col-12 col-lg-4">
                        <label for="txt-email">Correo Electrónico</label>
                        <input type="text" id="txt-email" class="form-control required focus" value="<?php echo $settings->email; ?>" />
                    </div>
                    <div class="col-12 col-lg-4">
                        <label for="txt-phone">Teléfono</label>
                        <input type="text" id="txt-phone" class="form-control required focus" value="<?php echo $settings->phone; ?>" />
                    </div>
                </div>
            </section>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button id="btn-saveSettings" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn-saveSettings').on('click', function() {
            $('#btn-saveSettings').attr('disabled', true);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('TPV/updateSettings'); ?>",
                data: {
                    'name': $('#txt-name').val(),
                    'cif': $('#txt-cif').val(),
                    'address1': $('#txt-address1').val(),
                    'address2': $('#txt-address2').val(),
                    'city': $('#txt-city').val(),
                    'state': $('#txt-state').val(),
                    'zipCode': $('#txt-zipCode').val(),
                    'country': $('#txt-country').val(),
                    'email': $('#txt-email').val(),
                    'phone': $('#txt-phone').val()
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            showToast('success', 'Datos actualizados!');
                            $('#btn-saveSettings').removeAttr('disabled');
                            break;
                        case 1:
                            showToast('success', 'Ha ocurrido un error!');
                            $('#btn-saveSettings').removeAttr('disabled');
                            break;
                        case 2:
                            window.location.href = "<?php echo base_url('Authentication?session=expired'); ?>";
                            $('#btn-saveSettings').removeAttr('disabled');
                            break;
                    }
                },
                error: function(error) {
                    showToast('success', 'Ha ocurrido un error!');
                    $('#btn-saveSettings').removeAttr('disabled');
                },
            });

        });
    });
</script>