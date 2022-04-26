<?php

$data = json_decode(file_get_contents('php://input'), true);
include('../conexion.php');

$response = [];
$todos = 0;
$reservados = -1;
$disponibles = -2;
//los numeros positivos equivalen a la fase que se quiere consultar.

switch ($data) {
    case $todos:
        $sql = "SELECT * FROM lotes ORDER BY fase ASC, super_manzana ASC,mza ASC,lote ASC";
        break;
    case $reservados:
        $sql = "SELECT * FROM lotes WHERE estatus = 1 ORDER BY fase ASC, super_manzana ASC, mza ASC, lote ASC";
        break;
    case $disponibles:
        $sql = "SELECT * FROM lotes WHERE estatus = 0 ORDER BY fase ASC, super_manzana ASC,mza ASC,lote ASC";
        break;
    case 1:
        $sql = "SELECT * FROM lotes where fase = 1 ORDER BY fase ASC, super_manzana ASC,mza ASC,lote ASC";
        break;
    case 2:
        $sql = "SELECT * FROM lotes where fase = 2 ORDER BY fase ASC, super_manzana ASC,mza ASC,lote ASC";
        break;
    case 3:
        $sql = "SELECT * FROM lotes where fase = 3 ORDER BY fase ASC, super_manzana ASC,mza ASC,lote ASC";
        break;
    case 4:
        $sql = "SELECT * FROM lotes where fase = 4 ORDER BY fase ASC, super_manzana ASC,mza ASC,lote ASC";
        break;
}

$resultado=mysqli_query(conectar(),$sql);
desconectar();
if($resultado!=true){
    $response['error'] = "Error en la consulta";
}else{
    //Exito en la consulta
    $response['html'] = "<table id='tabla_lotes' class='table table-responsive table-bordered table-striped table-hover table-condensed'>
                            <thead>
                                <tr>
                                    <th scope='col'>#</th>
                                    <th scope='col'>Identificador</th>
                                    <th scope='col'>Fase</th>
                                    <th scope='col'>Super Manzana</th>
                                    <th scope='col'>Manzana</th>
                                    <th scope='col'>Lote</th>
                                    <th scope='col'>m2</th>
                                    <th scope='col'>cos</th>
                                    <th scope='col'>cus</th>
                                    <th scope='col'>Uso</th>
                                    <th scope='col'>Precio de Lista</th>
                                    <th scope='col'>Estatus</th>
                                    <th scope='col'>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>";
    while($row=mysqli_fetch_assoc($resultado)){

        if($row['estatus']==1){
            $estatus = "RESERVADO";
            $disabled = "disabled";
        } 

        if($row['estatus']==0){
            $estatus = "DISPONIBLE";
            $disabled = "";
        } 

        $identificador = $row['fase']."-".$row['super_manzana']."-".$row['mza']."-".$row['lote'];

        $response['html'].= "<tr>
                                <th scope='row'>".$row['id_lote']."</th>
                                <td>".$identificador."</td>
                                <td>".$row['fase']."</td>
                                <td>".$row['super_manzana']."</td>
                                <td>".$row['mza']."</td>
                                <td>".$row['lote']."</td>
                                <td>".$row['m2']."</td>
                                <td>".$row['cos']."</td>
                                <td>".$row['cus']."</td>
                                <td>".$row['uso']."</td>
                                <td>$".$row['precio_lista']."</td>
                                <td>".$estatus."</td>
                                <td>
                                    <button  class=' btn btn-success' id='btn_confirmar' data-bs-toggle='modal' data-bs-target='#modal' onclick='modal_editar(".json_encode($row).")' $disabled >Editar</button>
                                    <button class=' btn btn-danger' id='btn_confirmar' onclick='EliminarLoteModal(".$row['id_lote'].")' $disabled >Eliminar</button>
                                </td>
                            </tr>";
    }
}


$response['html'].= "</tbody></table>";
echo json_encode($response);

?>