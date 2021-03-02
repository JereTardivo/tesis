<?php
session_start();
include("Conexion.php");

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];


$consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);


if($filas>0){
	$_SESSION['usuario'] = $usuario;
	
	header("Location: index.php");
} else {
	echo "<script>alert('Los datos no son correctos')</script>";
	echo "<script>window.location='ingreso.php'</script>";
}
mysqli_free_result($resultado);
mysqli_close($conexion);