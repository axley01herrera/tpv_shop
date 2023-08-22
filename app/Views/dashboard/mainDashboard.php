<div class="container-fluid">
    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-8">
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
                                <th><strong>Total de Artículos</strong></th>
                                <th class="text-end"><strong>Monto</strong></th>
                            </thead>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
            [0, 'asc']
        ],
        columns: [{
                data: 'id',
            },
            {
                data: 'date'
            },
            {
                data: 'articles',
                searchable: false
            },
            {
                data: 'amount',
                searchable: false,
                class: 'text_end'
            },
        ],
    });
</script>