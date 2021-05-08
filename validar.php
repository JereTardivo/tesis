<?php

include("Conexion.php");

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];


$consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_fetch_assoc($resultado);


if ($filas > 0) :
	session_start();
	$_SESSION['usuario'] = $filas["usuario"];
	$_SESSION['nivel'] = $filas["nivel"];
	echo json_encode(array('error' => false));
else :
	echo json_encode(array('error' => true));
endif;

mysqli_free_result($resultado);
mysqli_close($conexion);
