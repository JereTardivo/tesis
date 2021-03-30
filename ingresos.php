<?php
include("Conexion.php");
include("navegacion.php");
$fecha = $_POST['fecha'];
$consulta = "SELECT * FROM ingresos WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = '$fecha'";
if ($fecha == null) {
	$consulta = "SELECT * FROM ingresos WHERE 1";
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Registros</title>
</head>

<body>
	
	<a href="datosingreso.php" class="btn btn-primary" style="float: left; margin: 50px;">Volver</a>
	<table class="table table-bordered table-striped" style="width:85%;">

		<tr align="center">

			<th>id</th>
			<th>chipid</th>
			<th>fecha</th>
			<th>UID</th>

		</tr>
		<?php
		$resultado = mysqli_query($conexion, $consulta);
		while ($filas = mysqli_fetch_assoc($resultado)) { ?>

			<tr align="center">
				<td><?php echo $filas["id"] ?></td>
				<td><a href="ubicacion.php?chipid=<?php echo $filas["chipid"] ?>"><?php echo $filas["chipid"] ?></td>
				<td><?php echo $filas["fecha"] ?></td>
				<td><a href="usuarios.php?UID=<?php echo $filas["UID"] ?>"><?php echo $filas["UID"] ?></a></td>

			</tr>
		<?php
		}
		?>

	</table>

</body>

</html>