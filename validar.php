<?php

include("Conexion.php");

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];


$consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_fetch_assoc($resultado);


if ($filas > 0) {
	session_start();
	$_SESSION['usuario'] = $filas["usuario"];
	$_SESSION['nivel'] = $filas["nivel"];
	header("Location: general.php");
} else {
	echo "<script>alert('Los datos no son correctos')</script>";
	echo "<script>window.location='ingreso.php'</script>";
}
mysqli_free_result($resultado);
mysqli_close($conexion);
