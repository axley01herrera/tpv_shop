<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="dt-report-table" class="table" style="width: 100%;">
                <thead>
                    <th class="text-muted"><strong>Fecha</strong></th>
                    <th class="text-muted text-end"><strong>Efectivo</strong></th>
                    <th class="text-muted text-end"><strong>Tarjeta</strong></th>
                    <th class="text-muted text-end"><strong>Total</strong></th>
                </thead>
                <tbody>
                    <?php foreach ($dtReport as $row) : ?>
                        <tr>
                            <td><?php echo $row['date']; ?></td>
                            <td class="text-end"><strong><?php echo $row['cash']; ?></strong></td>
                            <td class="text-end"><strong><?php echo $row['card']; ?></strong></td>
                            <td class="text-end"><strong><?php echo $row['total']; ?></strong></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div id="main-collection"></div>
    </div>
</div>
<script>
    getCollectionReport();
    var groupColumn = 0;
    var table = $('#dt-report-table').DataTable({
        info: false,
        paging: false,
        searching: false,
        ordering: false,
        columnDefs: [{
            visible: false,
            targets: groupColumn
        }],
        language: {
            url: '<?php echo base_url('assets/libs/dataTable/es.json'); ?>'
        },
        drawCallback: function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api.column(groupColumn, {
                    page: 'current'
                })
                .data()
                .each(function(group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr style="background-color: #f2f3fe;" class="group fs-5 text-danger"><td colspan="3">' +
                                group +
                                '</td></tr>'
                            );

                        last = group;
                    }
                });
        }
    });
</script>