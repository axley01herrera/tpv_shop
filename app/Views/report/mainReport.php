<div class="row">
    <div class="col-12 col-md-6 col-lg-6 text-center">
        <label for="txt-dateStart">
            Desde
            <input type="date" id="txt-dateStart" class="form-control focus required" />
            <p id="msg-txt-dateStart" class="text-danger text-end"></p>
        </label>
    </div>
    <div class="col-12 col-md-6 col-lg-6 text-center">
        <label for="txt-dateEnd">
            Hasta
            <input type="date" id="txt-dateEnd" class="form-control focus required" />
            <p id="msg-txt-dateEnd" class="text-danger text-end"></p>
        </label>
    </div>
    <div class="col-12 text-center">
        <button id="btn-createReport" class="btn btn-primary"><i class="mdi mdi-chart-bar-stacked"></i> Reporte de Ventas</button>
    </div>
</div>

<div id="report-content"></div>

<script>
    $('#btn-createReport').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('required');
        let dateStart = $('#txt-dateStart').val();
        let dateEnd = $('#txt-dateEnd').val();
        if (dateStart != '' && dateEnd != '') {
            const objDateStart = new Date(dateStart);
            const objDateEnd = new Date(dateEnd);
            if (objDateEnd >= objDateStart) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('TPV/returnReportContent'); ?>",
                    data: {
                        'dateStart': dateStart,
                        'dateEnd': dateEnd
                    },
                    dataType: "html",
                    success: function(response) {
                        $('#report-content').html(response);
                    },
                    error: function(error) {
                        showToast('error', 'Ha ocurrido un error!');
                    }
                });

            } else {
                $('#txt-dateStart').val('');
                $('#txt-dateEnd').val('');
                showToast('error', 'Complete los rangos de fecha correctamente!');
            }
        } else {
            showToast('error', 'Complete los rangos de fecha!');
        }
    });

    $('.focus').on('change input', function() {
        $(this).removeClass('is-invalid');
        let inputID = $(this).attr("id");
        $('#msg-' + inputID).html("");
    });
</script>