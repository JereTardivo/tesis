<?php
include("Conexion.php");
include("navegacion.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title>Datos ingreso</title>
</head>

<body>
	<br>
	<?php $resultado = mysqli_query($conexion, "SELECT distinct nombre FROM registros"); ?>
	<form name="formulario" method="post" action="registros.php">
		<select name="nombre">
			<option value="1">Todo</option>
			<?php while ($filas = mysqli_fetch_assoc($resultado)) { ?>
				<option value='<?php echo $filas["nombre"]; ?>'><?php echo $filas["nombre"]; ?></option>
			<?php } ?>


		</select>
		*Fecha: <input type="date" name="fecha" value="">


		<input type="submit" class="btn btn-primary" />

	</form>
	<br>
	<label>*Dejar la fecha en blanco si desea ver todos los registros</label>

</body>

</html>