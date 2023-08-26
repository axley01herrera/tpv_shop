
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-6  mt-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="text-muted">Artículos</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="table-responsive">
                                <table id="dt-articleTPV" class="table" style="width: 100%;">
                                    <thead>
                                        <th class="text-muted"><strong>Artículo<strong></th>
                                        <th class="text-muted"><strong>Código<strong></th>
                                        <th class="text-muted"><strong>Precio de Venta<strong></th>
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
            <div id="main-basket"></div>
        </div>
    </div>
</div>

<script>
    var basketID = '<?php echo $basketID; ?>';
    dtBasket();

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

    dtArticleTPV.on('click', '.btn-add-product', function() {
        let productID = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/addProductToBasket'); ?>",
            data: {
                'basketID': basketID,
                'productID': productID
            },
            dataType: "json",
            success: function(response) {
                switch (response.error) {
                    case 0:
                        dtBasket();
                        showToast('success', 'Artículo añadido a la cesta de compra!');
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
    });

    function dtBasket() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/dtBasket'); ?>",
            data: {
                'basketID': basketID,
            },
            dataType: "html",
            success: function(response) {
                $('#main-basket').html(response);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error!');
            }
        });
    }
</script>