<div class="card">
    <div class="card-header">
        <h3>Recaudación de la Semana</h3>
    </div>
    <div class="card-body">
        <h4 class="font-weight-bold mb-2 d-flex align-items-center">Total <?php echo '€ ' . number_format((float) $chartWeek['total'], 2, ".", ','); ?></h4>
        <div id="chartWeek"></div>
    </div>
</div>
<script>
    var optionChartWeek = {
        series: [{
            name: 'Recaudación',
            data: [
                <?php echo $chartWeek['mon']; ?>,
                <?php echo $chartWeek['tue']; ?>,
                <?php echo $chartWeek['wed']; ?>,
                <?php echo $chartWeek['thu']; ?>,
                <?php echo $chartWeek['fri']; ?>,
                <?php echo $chartWeek['sat']; ?>,
                <?php echo $chartWeek['sun']; ?>
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
            categories: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
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

    var chartWeek = new ApexCharts(document.querySelector("#chartWeek"), optionChartWeek);
    chartWeek.render();
</script>