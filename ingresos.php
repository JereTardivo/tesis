<?php
include("Conexion.php");
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
	<?php
	include("navegacion.php");
	?>
	<a href="datosingreso.php" class="btn btn-primary">Elegir nuevos datos</a>
	<table width="100%" class="table table-bordered table-striped" align="center">

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
				<td><?php echo $filas["chipid"] ?></td>
				<td><?php echo $filas["fecha"] ?></td>
				<td><a href="usuarios.php?UID=<?php echo $filas["UID"] ?>"><?php echo $filas["UID"] ?></a></td>

			</tr>
		<?php
		}
		?>

	</table>

</body>

</html>