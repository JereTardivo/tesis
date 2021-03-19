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
	
	<form name="formulario" method="post" action="ingresos.php">

		*Nombre: <input type="date" name="fecha" value="">

		<input type="submit" class="btn btn-primary" />

	</form>
	<label>*Dejar la nombre en blanco si desea ver todos los ingresos</label>

</body>

</html>