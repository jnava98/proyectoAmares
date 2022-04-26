<?php

$data = json_decode(file_get_contents('php://input'));
include('../conexion.php');


$sql = "DELETE FROM lotes WHERE id_lote = $data";
$resultado=mysqli_query(conectar(),$sql);
desconectar();

$msj = "El lote se actualizó correctamente";
?>