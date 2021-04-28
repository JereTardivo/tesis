<?php
include("Conexion.php");
include("navegacion.php");

$fecha = $_POST['fecha'];

//CONSULTA PARA TABLA
if ($fecha == '1') {
	$consulta = "SELECT DISTINCT fecha , valor  FROM registros WHERE nombre = 'GAS' ORDER BY FECHA DESC";
	$consulta1 = "SELECT DISTINCT UNIX_TIMESTAMP(FECHA)  as fecha , valor FROM registros WHERE nombre = 'GAS' ORDER BY FECHA";
}
if ($fecha == '2') {
	$consulta = "SELECT DISTINCT fecha,valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = curdate() AND nombre = 'GAS' ORDER BY FECHA DESC";
	$consulta1 = "SELECT DISTINCT UNIX_TIMESTAMP(FECHA)  as fecha , valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = curdate() AND nombre = 'GAS' ORDER BY FECHA";
}
if ($fecha == '3') {
	$consulta = "SELECT DISTINCT fecha,valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 7 DAY)  and curdate() AND nombre = 'GAS' ORDER BY FECHA DESC";
	$consulta1 = "SELECT DISTINCT UNIX_TIMESTAMP(FECHA)  as fecha , valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 7 DAY)  and curdate() AND nombre = 'GAS' ORDER BY FECHA";
}
if ($fecha == '4') {
	$consulta = "SELECT DISTINCT fecha,valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 15 DAY) and curdate()  AND nombre = 'GAS' ORDER BY FECHA DESC";
	$consulta1 = "SELECT DISTINCT UNIX_TIMESTAMP(FECHA)  as fecha , valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 15 DAY) and curdate()  AND nombre = 'GAS' ORDER BY FECHA";
}
if ($fecha == '5') {
	$consulta = "SELECT DISTINCT fecha,valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 30 DAY)  and curdate() AND nombre = 'GAS' ORDER BY FECHA DESC";
	$consulta1 = "SELECT DISTINCT UNIX_TIMESTAMP(FECHA)  as fecha , valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 30 DAY)  and curdate() AND nombre = 'GAS' ORDER BY FECHA";
}

?>
<!DOCTYPE html>
<html>

<head>
	<script src="js/highcharts.js"></script>
	<script src="js/data.js"></script>
	<script src="js/exporting.js"></script>
	<script src="js/export-data.js"></script>
	<script src="js/accessibility.js"></script>

	<title>Registros Gas</title>
</head>

<body>
	<div class="container border" style="align-items:center">
		<form name="formulario" method="post">
			<select name="fecha">
				<option value="1">Todas las Fechas</option>
				<option value="2">Hoy</option>
				<option value="3">Ultimos 7 días</option>
				<option value="4">Ultimos 15 días</option>
				<option value="5">Ultimos 30 días</option>
			</select>
			<input type="submit" class="btn btn-primary" value="Consultar" />
		</form>
	</div>
	<br>
	<div style="text-align:center;">
		<table border="1" class="table table-bordered table-striped" style="width:85%;margin: 0 auto;">
			<h4>Registros</h4>
			<tr align="center">
				<th>Fecha</th>
				<th>Valor</th>
			</tr>
			<?php
			$resultado = mysqli_query($conexion, $consulta);

			while ($filas = mysqli_fetch_assoc($resultado)) {
			?>

				<tr align="center">
					<td><?php echo $filas["fecha"] ?></td>
					<td><?php echo $filas["valor"] ?></td>
				</tr>
			<?php
			}

			?>
		</table>
		<br>
		<br>
		<div id="containerGraph" style="text-align:center;"></div>
	</div>

</body>

<script type="text/javascript">
	Highcharts.chart('containerGraph', {
		chart: {
			zoomType: 'x'
		},
		title: {
			text: 'Resgistros de Gases en el Tiempo'
		},
		subtitle: {
			text: document.ontouchstart === undefined ?
				'Haga clic y arrastre en el área de trazado para acercar' : 'Pellizca el gráfico para acercarlo'
		},
		xAxis: {
			title: {
				enabled: true,
				text: 'Tiempo'
			},
			type: 'datetime'			
		},
		yAxis: {
			title: {
				text: 'Gases'
			}
		},
		legend: {
			enabled: false
		},
		plotOptions: {
			area: {
				fillColor: {
					linearGradient: {
						x1: 0,
						y1: 0,
						x2: 0,
						y2: 1
					},
					stops: [
						[0, Highcharts.getOptions().colors[0]],
						[1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
					]
				},
				marker: {
					radius: 2
				},
				lineWidth: 1,
				states: {
					hover: {
						lineWidth: 1
					}
				},
				threshold: null
			}
		},

		series: [{
			type: 'area',
			name: 'Gas',
			data: [
				<?php
				$resultado2 = mysqli_query($conexion, $consulta1);
				while ($filas1 = mysqli_fetch_assoc($resultado2)) {
				?> {
						x: <?php echo $filas1["fecha"] * 1000 - 10800000; ?>,
						y: <?php echo $filas1["valor"]; ?>
					},
				<?php } ?>
			]
		}]
	});
</script>



</html>