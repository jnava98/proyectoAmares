<?php
function conectar(){
	$conexion=mysqli_connect("localhost","root", "");
	mysqli_select_db($conexion,"cobranza_amares")or die ("ninguna BD seleccionada");
	$conexion->set_charset("utf8");
	return $conexion;
}//fin funcion conectar

function desconectar(){
	mysqli_close(conectar());
}//fin de funcion desconectar

?>