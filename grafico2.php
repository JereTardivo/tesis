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

    <title>Cantidad de Registros</title>
</head>

<body>
    <div id="container"></div>
    <script type="text/javascript">
        <?php
        $resultadoNombre = mysqli_query($conexion, "SELECT distinct nombre FROM registros");
        ?>

        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'column'
            },
            title: {
                text: 'Canitdad de registros por topic'
            },
            xAxis: {
                type: 'category'
            },


            plotOptions: {
                column: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: "<b>{point.y}</b>"

                    }
                }
            },
            series: [{
                name: 'Cantidad',
                colorByPoint: true,
                data: [
                    <?php

                    while ($filas = mysqli_fetch_assoc($resultadoNombre)) {
                        $nombre = $filas["nombre"]; ?> {
                            name: '<?php echo $nombre ?>',
                            y: <?php

                                $resultado = mysqli_query($conexion, "SELECT COUNT(*) FROM registros WHERE nombre = '$nombre'");
                                $res = mysqli_fetch_array($resultado);
                                echo $res[0]; ?>,
                            drilldown: '<?php echo $nombre ?>'

                        },
                    <?php } ?>
                ]
            }]
        });
    </script>


</body>

</html>