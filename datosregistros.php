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
	<title>Datos ingreso</title>
</head>

<body>

	<div class="container border" style="align-items:center">
		<?php $resultado = mysqli_query($conexion, "SELECT distinct nombre FROM registros"); ?>
		<form name="formulario" method="post">
			<select name="nombre">
				<option value="1">Todo</option>
				<?php while ($filas = mysqli_fetch_assoc($resultado)) { ?>
					<option value='<?php echo $filas["nombre"]; ?>'><?php echo $filas["nombre"]; ?></option>
				<?php } ?>


			</select>
			*Fecha: <input type="date" name="fecha" value="">
			<input type="submit" class="btn btn-primary" value="Consultar" />
		</form>
		<label>*Dejar la fecha en blanco si desea ver todos los registros</label>
	</div>
	<br>
	<div style="text-align:center;">
		<table border="1" class="table table-bordered table-striped" style="width:85%;margin: 0 auto;">
			<h4>Registros</h4>
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

	</div>

</body>

</html>