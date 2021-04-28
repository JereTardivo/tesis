<?php
include("Conexion.php");
include("navegacion.php");

$fecha = $_POST['fecha'];

$consulta = "SELECT i.id, i.chipid, ub.ubicacion, i.fecha, i.UID, us.usuario FROM ingresos i
             INNER JOIN ubicacion ub on ub.chipid = i.chipid
             INNER JOIN usuarios us on us.UID=i.UID  
             WHERE DATE_FORMAT(i.fecha, '%Y-%m-%d') = '$fecha'";
if ($fecha == null) {
	$consulta = "SELECT i.id, i.chipid, ub.ubicacion, i.fecha, i.UID, us.usuario FROM ingresos i
				INNER JOIN ubicacion ub on ub.chipid = i.chipid
				INNER JOIN usuarios us on us.UID=i.UID
	 			WHERE 1";
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Datos ingreso</title>
</head>

<body>

	<div class="container border" style="align-items:center">
		<form name="formulario" method="post">
			*Fecha: <input type="date" name="fecha" value="">
			<input type="submit" class="btn btn-primary" value="Consultar" />
		</form>
		<label>*Dejar la fecha en blanco si desea ver todos los ingresos</label>
	</div>
	<br>
	<div style="text-align:center;">
		<table border="1" class="table table-bordered table-striped" style="width:85%;margin: 0 auto;">
			<h4>Registros</h4>
			<tr align="center">
				<th>Id</th>
				<th>ChipId</th>
				<th>Lugar</th>
				<th>Fecha</th>
				<th>UID</th>
				<th>Nombre</th>
			</tr>
			<?php
			$resultado = mysqli_query($conexion, $consulta);
			while ($filas = mysqli_fetch_assoc($resultado)) { ?>
				<tr align="center">
					<td><?php echo $filas["id"] ?></td>
					<td><?php echo $filas["chipid"] ?></td>
					<td><?php echo $filas["ubicacion"] ?></td>
					<td><?php echo $filas["fecha"] ?></td>
					<td><?php echo $filas["UID"] ?></td>
					<td><?php echo $filas["usuario"] ?></td>
				</tr>
			<?php
			}
			?>
		</table>

	</div>










</body>

</html>