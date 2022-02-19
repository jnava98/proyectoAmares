<?php
include('conexion.php');
$cliente = $_GET['cliente'];
if($cliente==" "||$cliente==""){
    return false;
}else{
    $consulta = "SELECT id_cliente, nombre, apellido_paterno, apellido_materno FROM clientes WHERE nombre LIKE '%$empleadoBuscado%' OR clave_emp LIKE '%$empleadoBuscado%' AND direccion LIKE '02' "; 
    $resultado=mysqli_query(conectar(),$consulta);
    desconectar();
    while($row=mysqli_fetch_assoc($resultado)){
        $id_cliente= $row['id_cliente'];
        $nombre= $row['nombre'];
        $nombre.= $row['apellido_paterno'];
        $nombre.= $row['apellido_materno'];
        echo '<tr id="trcliente_buscado"  onclick="seleccionar_cliente('.$id_cliente.','.$nombre.')">';
            echo '<td id="tdcliente_buscado">'.($id_cliente.'-'.$nombre).'</td>';
        echo '</tr>';
    }//fin del while
    //mysqli_free_result($resultado);//Liberamos el resultado
}//fin del else
?>