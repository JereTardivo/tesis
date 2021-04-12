<?php
include("Conexion.php");
include("navegacion.php");

$fecha = $_POST['fecha'];


if ($fecha == '1') {
	$consulta = "SELECT fecha, valor  FROM registros WHERE nombre = 'Humedad' ORDER BY FECHA DESC";
}
if ($fecha == '2') {
	$consulta = "SELECT fecha,valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = curdate() AND nombre = 'Humedad' ORDER BY FECHA DESC";
}
if ($fecha == '3') {
	$consulta = "SELECT fecha,valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 7 DAY)  and curdate() AND nombre = 'Humedad' ORDER BY FECHA DESC";
}
if ($fecha == '4') {
	$consulta = "SELECT fecha,valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 15 DAY) and curdate()  AND nombre = 'Humedad' ORDER BY FECHA DESC";
}
if ($fecha == '5') {
	$consulta = "SELECT fecha,valor FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') between (curdate()- INTERVAL 30 DAY)  and curdate() AND nombre = 'Humedad' ORDER BY FECHA DESC";
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Registros Humedad</title>
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
	</div>
</body>



</html>