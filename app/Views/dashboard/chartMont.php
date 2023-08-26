<div class="card">
    <div class="card-header">
        <h3 class="text-muted">Recaudación Mensual</h3>
    </div>
    <div class="card-body">
        <h4 class="font-weight-bold mb-2 d-flex align-items-center">Total:&nbsp;<span class="text-primary"><?php echo '€ ' . number_format((float) $chartMont['total'], 2, ".", ','); ?></span></h4>
        <div id="chartMont"></div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-2">
                <select id="sel-year" class="form-select">
                    <?php

                    $start = $currentYear - 10;
                    while ($start <= $currentYear) {

                    ?>
                        <option <?php if ($start == $year) echo 'selected'; ?> value="<?php echo $start; ?>"><?php echo $start; ?></option>
                    <?php
                        $start = $start + 1;
                    } ?>
                </select>
            </div>
        </div>
    </div>
</div>

<script>
    var optionChartMont = {
        series: [{
            name: 'Recaudación',
            data: [
                <?php echo $chartMont[1]; ?>,
                <?php echo $chartMont[2]; ?>,
                <?php echo $chartMont[3]; ?>,
                <?php echo $chartMont[4]; ?>,
                <?php echo $chartMont[5]; ?>,
                <?php echo $chartMont[6]; ?>,
                <?php echo $chartMont[7]; ?>,
                <?php echo $chartMont[8]; ?>,
                <?php echo $chartMont[9]; ?>,
                <?php echo $chartMont[10]; ?>,
                <?php echo $chartMont[11]; ?>,
                <?php echo $chartMont[12]; ?>
            ],
        }],
        annotations: {
            points: [{
                x: 'Recaudación',
                seriesIndex: 0,
                label: {
                    borderColor: '#775DD0',
                    offsetY: 0,
                    style: {
                        color: '#fff',
                        background: '#775DD0',
                    },
                    text: 'Mejor Recaudación',
                }
            }]
        },
        chart: {
            height: 200,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 0,
                columnWidth: '15%',
            }
        },
        dataLabels: {
            enabled: false,
        },
        grid: {
            row: {
                colors: ['#fff', '#f2f2f2']
            }
        },
        xaxis: {
            labels: {
                rotate: -45,
            },
            categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
        yaxis: {
            title: {
                text: '',
            },
            labels: {
                formatter: (value) => {
                    return '€ ' + value.toFixed(2);
                },
            },
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
        }
    };

    var chart3 = new ApexCharts(document.querySelector("#chartMont"), optionChartMont);
    chart3.render();

    $('#sel-year').on('change', function() {

        let value = $(this).val();
        chartMont(value);

    });
</script>