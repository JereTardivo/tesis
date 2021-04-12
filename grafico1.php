<?php
include("Conexion.php");
include("navegacion.php");
?>

<!DOCTYPE html>
<html>

<head>

    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/export-data.js"></script>
    <script src="js/accessibility.js"></script>
    <link href="css/highcharts.css" rel="stylesheet">

    <title>Cantidad de Ingresos</title>
</head>

<body>
    <div id="container"></div>
    <script type="text/javascript">
        <?php
        $resultadoUID = mysqli_query($conexion, "SELECT distinct UID, usuario FROM usuarios");
        ?>
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Canitdad de ingresos por usuario'
            },

            xAxis: {
                title: {
                    text: 'category'
                }
            },

            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },

            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: "<b>{point.name}</b>: {point.percentage:.1f} %"

                    },
                    showInLegend: true
                }
            },

            series: [{
                name: 'Cantidad',
                colorByPoint: true,
                data: [
                    <?php while ($filas = mysqli_fetch_assoc($resultadoUID)) {
                        $UID = $filas["UID"];
                        $usuario = $filas["usuario"]; ?> {
                            name: '<?php echo ucfirst($usuario) ?>',
                            y: <?php

                                $resultado = mysqli_query($conexion, "SELECT COUNT(*) FROM ingresos WHERE UID = '$UID'");
                                $res = mysqli_fetch_array($resultado);
                                echo $res[0]; ?>,
                            drilldown: '<?php echo ucfirst($usuario) ?>'

                        },
                    <?php } ?>
                ]
            }]

        });
    </script>


</body>

</html>