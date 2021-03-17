<?php
include("Conexion.php");

$chipid = $_POST['chipid'];
$UID = $_POST['UID'];
$consulta = "SELECT usuario FROM usuarios WHERE UID = '$UID'";
$resultado = mysqli_query($conexion, $consulta);
$comparativo = mysqli_fetch_assoc($resultado);


if ($comparativo) {

	$insertar = "INSERT INTO ingresos (id, chipid, fecha, UID) VALUES (NULL, '$chipid', current_timestamp(), '$UID');";
	$resultado = mysqli_query($conexion, $insertar);
	echo "1";
} else {
	echo "0";
}
