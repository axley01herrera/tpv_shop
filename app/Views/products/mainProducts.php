<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="text-muted">Artículos</h3>
                </div>
                <div class="col-6 text-end">
                    <button id="btn-createProduct" class="btn btn-sm btn-primary">Añadir Artículo</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mt-2">
                    <div class="table-responsive">
                        <table id="dt-article" class="table" style="width: 100%;">
                            <thead>
                                <th><strong>Artículo<strong></th>
                                <th><strong>Código<strong></th>
                                <th><strong>Precio de Venta<strong></th>
                                <th><strong>Estado<strong></th>
                                <th></th>
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

    var dtArticle = $('#dt-article').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        responsive: true,
        bAutoWidth: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        language: {
            url: '<?php echo base_url('assets/libs/dataTable/es.json'); ?>'
        },
        ajax: {
            url: "<?php echo base_url('TPV/dtProcessingProducts'); ?>",
            type: "POST"
        },
        order: [
            [0, 'asc']
        ],
        columns: [{
                data: 'name'
            },
            {
                data: 'code'
            },
            {
                data: 'price',
                searchable: false
            },
            {
                data: 'status',
                searchable: false
            },
            {
                data: 'switch',
                orderable: false,
                searchable: false
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ],
    });

    dtArticle.on('click', '.switch', function() {
        let status = $(this).attr('data-status');
        let newStatus = '';
        let id = $(this).attr('data-id');
        let msg = '';

        if (status == 0) {
            newStatus = 1;
            msg = 'Artículo activado!';
        } else if (status == 1) {
            newStatus = 0;
            msg = 'Artículo desactivado!';
        }

        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/changeProductStatus'); ?>",
            data: {
                'id': id,
                'status': newStatus
            },
            dataType: "json",
            success: function(response) {
                switch (response.error) {
                    case 0:
                        dtArticle.draw();
                        showToast('success', msg);
                        break;
                    case 1:
                        showToast('error', 'Ha ocurrido un error!');
                        break;
                    case 2:
                        window.location.href = "<?php echo base_url('Authentication?session=expired'); ?>";
                        break;
                }
            },
            error: function() {
                showToast('error', 'Ha ocurrido un error!');
            }
        });
    });

    dtArticle.on('click', '.btn-edit-product', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/showModalProduct'); ?>",
            data: {
                'id': $(this).attr('data-id'),
                'action': 'update',
            },
            dataType: "html",
            success: function(response) {
                $('#main-modal').html(response);
            },
            error: function() {
                showToast('error', 'Ha ocurrido un error!');
            }
        });
    });

    dtArticle.on('click', '.btn-print-code', function() {
        let id = $(this).attr('data-id')
        let url = "<?php echo base_url('TPV/printBarCode'); ?>" + '/' + id;
        window.open(url, 'blank');
    })
</script>