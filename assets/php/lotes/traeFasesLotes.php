<?php 

$data = json_decode(file_get_contents('php://input'), true);

$response = [];
include('../conexion.php');


    $consulta = "SELECT DISTINCT(fase) FROM lotes";
    $resultado=mysqli_query(conectar(),$consulta);
    desconectar();
    if($resultado!=true){
        echo json_encode("Error en la consulta");
    }else{
        $response['html'] = "";
        //Exito en la consulta
        while($row=mysqli_fetch_assoc($resultado)){
            $response['html'].= "<option value=".$row['fase']." selected>Fase ".$row['fase']."</option>";
        }
        echo json_encode($response);  
    }


?>