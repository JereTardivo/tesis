<?php
include("Conexion.php");

?>

<!DOCTYPE html>
<html>
<head>
    <?php include("navegacion.php"); ?>
	<script src="js/highcharts.js"></script>
	<script src="js/exporting.js"></script>
	<script src="js/export-data.js"></script>
	<script src="js/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        
    </p>
</figure>

	<title></title>
</head>
<body>

	<script type="text/javascript">
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


    <?php 
    $resultadoNombre = mysqli_query($conexion, "SELECT distinct nombre FROM registros");
     ?>
    series: [{
        name: 'Cantidad',
        colorByPoint: true,
        data: [
                <?php 
            
                while ($filas=mysqli_fetch_assoc($resultadoNombre)) {
                    $nombre = $filas["nombre"];?>
                {
            name: '<?php echo $nombre ?>',
            y:  <?php 

                $resultado = mysqli_query($conexion, "SELECT COUNT(*) FROM registros WHERE nombre = '$nombre'");
                $res=mysqli_fetch_array($resultado);
                echo $res[0]; ?>,
            drilldown: '<?php echo $nombre ?>'
            
        }, <?php } ?>
        ]
    }]
});
</script>

<style type="text/css">
	.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: auto;
    margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


input[type="number"] {
	min-width: 50px;
}
</style>
</body>
</html>