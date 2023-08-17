<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-6 mt-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3>Artículos</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="table-responsive">
                                <table id="dt-articleTPV" class="table" style="width: 100%;">
                                    <thead>
                                        <th><strong>Artículo<strong></th>
                                        <th><strong>Código<strong></th>
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
        <div class="col-12 col-lg-6 mt-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3>Cesta de Compra</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="table-responsive">
                                <table id="dt-basket" class="table" style="width: 100%;">
                                    <thead>
                                        <th><strong>Artículo<strong></th>
                                        <th><strong>Precio<strong></th>
                                        <th></th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var dtArticleTPV = $('#dt-articleTPV').DataTable({
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
            url: "<?php echo base_url('TPV/dtProcessingProductsTPV'); ?>",
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
            },
            {
                data: 'action',
                class: 'text-end',
                orderable: false,
                searchable: false
            }
        ],
    });

    dtArticleTPV.on('click', '.btn-add-product', function () {
        let productID = $(this).data('id'); console.log(productID);
    });
</script>