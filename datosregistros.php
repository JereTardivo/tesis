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
	<form name="formulario" method="post" action="registros.php">
		<select name="nombre">
			<option value="1">Todo</option>
			<option value="Temperatura">Temperatura</option>
			<option value="Conteo">Conteo</option>
			<option value="Humedad">Humedad</option>
			<option value="/R501/temperatura">/R501/temperatura</option>

		</select>
		*Fecha: <input type="date" name="fecha" value="">


		<input type="submit" class="btn btn-primary" />

	</form>
	<br>
	<label>*Dejar la fecha en blanco si desea ver todos los registros</label>

</body>

</html>