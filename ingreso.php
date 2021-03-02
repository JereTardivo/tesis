<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.bundle.min.js"></script>
	<title>Ingreso</title>

</head>
<body>
	<div align="center" id="formulario-act">
		<form action="validar.php" method="post">
			<h1>Ingreso</h1>
			<input type="text" name="usuario" id="datos-ingreso">
			<br>
			<input type="password" name="clave" id="datos-ingreso">
			<br>
			<input type="submit" name="ingresar" value="Ingresar" class="btn btn-primary">
		</form>
		
	</div>

</body>
</html>