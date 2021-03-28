<?php
include("Conexion.php");
$chipid = $_GET['chipid'];
$consulta = "SELECT chipid, ubicacion FROM ubicacion WHERE chipid = '$chipid'";
$resultado = mysqli_query($conexion, $consulta);
$comparativo = mysqli_fetch_assoc($resultado);
include("navegacion.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title>Usuarios</title>
</head>

<body>
	<table class="table table-bordered table-striped" align="center" style="width: 50%; margin-top: 50px;">

		<tr align="center">

			<th>Chipid</th>
			<th>Ubicacion</th>
			<th></th>
		</tr>
		<tr align="center">
			<td><?php echo $comparativo["chipid"] ?></td>
			<td><?php echo $comparativo["ubicacion"] ?></td>
			<td><a href="datosingreso.php" class="btn btn-primary">Volver</a></td>
		</tr>
	</table>

</body>

</html>