<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div id="main-collection-day"></div>
            <div id="main-chart-week"></div>
            <div id="main-product-info"></div>
        </div>
        <div class="col-12 col-lg-8">
            <div id="main-chart-mont"></div>
            <div class="card">
                <div class="card-header">
                    <h3>Historial de Ventas</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dt-history" class="table" style="width: 100%;">
                            <thead>
                                <th><strong>ID</strong></th>
                                <th><strong>Fecha</th>
                                <th class="text-center"><strong>Artículos</strong></th>
                                <th class="text-center"><strong>Tipo de Pago</strong></th>
                                <th class="text-center"><strong>Monto</strong></th>
                                <th class="text-center"><strong>Acciones</strong></th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    collectionDay();
    productInfo();
    chartWeek();
    chartMont();

    var dtHistory = $('#dt-history').DataTable({
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
            url: "<?php echo base_url('TPV/dtProcessingHistory'); ?>",
            type: "POST"
        },
        order: [
            [0, 'desc']
        ],
        columns: [{
                data: 'id',
                visible: false
            },
            {
                data: 'date'
            },
            {
                data: 'articles',
                searchable: false,
                class: 'text-center'
            },
            {
                data: 'payType',
                searchable: false,
                class: 'text-center'
            },
            {
                data: 'amount',
                searchable: false,
                class: 'text-center'
            },
            {
                data: 'action',
                searchable: false,
                orderable: false,
                class: 'text-center'
            },
        ],
    });

    dtHistory.on('click', '.btn-open', function() {
        let basketID = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/reopenBasket'); ?>",
            data: {
                'basketID': basketID
            },
            dataType: "json",
            success: function(response) {
                switch (response.error) {
                    case 0:
                        window.location.href = '<?php echo base_url('TPV/tpv'); ?>';
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

    dtHistory.on('click', '.btn-del', function() {
        let basketID = $(this).attr('data-id');
        Swal.fire({ // ALERT WARNING
            title: 'Está seguro?',
            text: "Esta acción no es reversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#74788d',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Salir',
            customClass: {
                confirmButton: 'delete'
            }
        });
        $('.delete').on('click', function() { // ACTION DELETE
            $.ajax({
                type: "post",
                url: "<?php echo base_url('TPV/deleteBasket'); ?>",
                data: {
                    'basketID': basketID
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            dtHistory.draw();
                            showToast('success', 'Venta eliminada!');
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


    });

    function collectionDay() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/collectionDay'); ?>",
            data: "",
            dataType: "html",
            success: function(response) {
                $('#main-collection-day').html(response);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error!');
            }
        });
    }

    function chartWeek() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/chartWeek'); ?>",
            data: "",
            dataType: "html",
            success: function(response) {
                $('#main-chart-week').html(response);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error!');
            }
        });
    }

    function chartMont(year = '') {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/chartMont'); ?>",
            data: {
                'year': year
            },
            dataType: "html",
            success: function(response) {
                $('#main-chart-mont').html(response);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error');
            }
        });
    }

    function productInfo() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/productInfo'); ?>",
            data: "",
            dataType: "html",
            success: function(response) {
                $('#main-product-info').html(response);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error!');
            }
        });
    }
</script>