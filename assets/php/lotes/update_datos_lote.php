<?php

$data = json_decode(file_get_contents('php://input'));
include('../conexion.php');

$sql = "UPDATE lotes set 
    fase = $data->fase, 
    super_manzana = $data->super_manzana, 
    mza = $data->manzana, lote = $data->lote, 
    m2 = $data->m2, cos = $data->cos, 
    cus = $data->cus, 
    precio_historico = precio_lista, 
    precio_lista = $data->precio_lista 
    WHERE id_lote = $data->id_lote";
$resultado=mysqli_query(conectar(),$sql);
desconectar();

$msj = "El lote se actualizó correctamente";

echo json_encode($sql);




?>