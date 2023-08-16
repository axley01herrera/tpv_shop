<div class="container">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Artículos</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <button id="btn-createProduct" class="btn btn-primary"><i class="mdi mdi-plus"></i> Artículo</button>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="dt-article" class="table">
                            <thead>
                                <th><strong>Artículo<strong></th>
                                <th><strong>Código<strong></th>
                                <th><strong>Estado<strong></th>
                                <th><strong>Precio de Venta<strong></th>
                                <th></th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-createProduct').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/showModalProduct'); ?>",
            data: {
                action: 'create',
            },
            dataType: "html",
            success: function(htmlResponse) {
                $('#main-modal').html(htmlResponse);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error!');
            }
        });
    });
</script>