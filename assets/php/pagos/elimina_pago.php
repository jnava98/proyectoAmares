<?php

session_start();

include "../conexion.php";

$response = [];

$id_contrato = filter_input(INPUT_POST,'id_contrato',FILTER_SANITIZE_NUMBER_INT);
$id_pago = filter_input(INPUT_POST,'id_pago',FILTER_SANITIZE_NUMBER_INT);

$sql = "update pagos set habilitado=0 where id_pago = $id_pago";
$result=mysqli_query(conectar(),$sql);

$response['id_contrato'] = $id_contrato;
$response['result'] = $result;
$response['sql'] = $sql;

echo json_encode($response);