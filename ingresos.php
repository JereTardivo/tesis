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
	
	
	<table class="table table-bordered table-striped" style="width:100%;">

		<tr align="center">

			<th>id</th>
			<th>chipid</th>
			<th>lugar</th>
			<th>fecha</th>
			<th>UID</th>
			<th>Nombre</th>

		</tr>
		<?php
		$resultado = mysqli_query($conexion, $consulta);
		while ($filas = mysqli_fetch_assoc($resultado)) { ?>

			<tr align="center">
				<td><?php echo $filas["id"] ?></td>
				<td><?php echo $filas["chipid"] ?></td>
					<td>
					<?php 
					$ubi = $filas["chipid"];
					$consulta1 = "SELECT ubicacion FROM ubicacion WHERE chipid = '$ubi'";
					$resultado1 = mysqli_query($conexion,$consulta1);
					$dev = mysqli_fetch_row($resultado1);
					echo $dev[0]; 
					?>
					</td>
					
				<td><?php echo $filas["fecha"] ?></td>
				<td><?php echo $filas["UID"] ?></td>
					<td>
					<?php 
					$us = $filas["UID"];
					$consulta1 = "SELECT usuario FROM usuarios WHERE UID = '$us'";
					$resultado1 = mysqli_query($conexion,$consulta1);
					$dev = mysqli_fetch_row($resultado1);
					echo $dev[0]; 
					?>
					</td>

			</tr>
		<?php
		}
		?>

	</table>

</body>

</html>