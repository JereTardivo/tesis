<?php
include("Conexion.php");
include("navegacion.php");
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$consulta = "SELECT * FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '$fecha' AND nombre = '$nombre'";
if ($nombre == "1") {
	$consulta = "SELECT * FROM registros WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '2021-03-12' AND 1";
}
if ($fecha == null) {
	$consulta = "SELECT * FROM registros WHERE nombre = '$nombre' AND 1";
}
if ($nombre == "1" && $fecha == null) {
	$consulta = "SELECT * FROM registros WHERE 1";
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Registros</title>
</head>

<body>
	
	<a href="datosregistros.php" class="btn btn-primary" style="float: left; margin: 50px;">Volver</a>
	<table class="table table-bordered table-striped" style="width:85%;">

		<tr align="center">

			<th>idRegistro</th>
			<th>Nombre</th>
			<th>Valor</th>
			<th>Fecha</th>



		</tr>
		<?php
		$resultado = mysqli_query($conexion, $consulta);
		while ($filas = mysqli_fetch_assoc($resultado)) { ?>

			<tr align="center">
				<td><?php echo $filas["idRegistro"] ?></td>
				<td><?php echo $filas["nombre"] ?></td>
				<td><?php echo $filas["valor"] ?></td>
				<td><?php echo $filas["fecha"] ?></td>

			</tr>
		<?php
		}
		?>

	</table>
	
	

</body>

</html>