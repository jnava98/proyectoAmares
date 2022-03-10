<?php
/*
Función: busca_cliente.php
Invocada por: js/clientes/busca_cliente()
Objetivo: Trae los clientes según se ingresen los caracteres en el buscador
*/


include('../conexion.php');
$cliente = $_GET['cliente'];
if($cliente==" "||$cliente==""){
    return false;
}else{
    $consulta = "SELECT id_cliente, nombre, apellido_paterno, apellido_materno FROM clientes WHERE nombre LIKE '%$cliente%' OR apellido_paterno LIKE '%$cliente%' OR apellido_materno LIKE '%$cliente%'"; 
    $resultado=mysqli_query(conectar(),$consulta);
    desconectar();
    while($row=mysqli_fetch_assoc($resultado)){
        $id_cliente= $row['id_cliente'];
        $nombre= $row['apellido_paterno']." ";
        $nombre.= $row['apellido_materno']." ";
        $nombre.= $row['nombre'];
        echo '<tr id="'.$id_cliente.'&'.$nombre.'" onclick="seleccionar_cliente(this.id)">';
            echo '<td id="tdcliente_buscado">'.($id_cliente.' - '.$nombre).'</td>';
        echo '</tr>';
    }//fin del while
}//fin del else
?>