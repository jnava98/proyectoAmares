<?php

function conectar(){
	/*$conexion=mysqli_connect("localhost","root", ""); //LOCAL
	mysqli_select_db($conexion,"cobranza_amares")or die ("ninguna BD seleccionada");*/
	$conexion=mysqli_connect("condorconsultoria.com","condorc2_test","123456789");
	mysqli_select_db($conexion,"condorc2_cobranza_amares")or die ("ninguna BD seleccionada");


	$conexion->set_charset("utf8");
	return $conexion;
}//fin funcion conectar

function desconectar(){
	mysqli_close(conectar());
}//fin de funcion desconectar


/*
//DATOS DE INICIO DE SESION EN LINEA.
mysql://
b64207390e8bf7
:
708d1f71
@
us-cdbr-east-05.cleardb.net
/heroku_3d71280996bd50e?reconnect=true
*/


?>