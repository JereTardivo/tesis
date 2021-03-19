<?php
include("Conexion.php");
$uid = $_GET['UID'];
$consulta = "SELECT usuario, UID FROM usuarios WHERE UID = '$uid'";
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

			<th>usuario</th>
			<th>UID</th>
		</tr>
		<tr align="center">
			<td><?php echo $comparativo["usuario"] ?></td>
			<td><?php echo $comparativo["UID"] ?></td>
		</tr>
	</table>

</body>

</html>