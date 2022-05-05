<?php

session_start();
include '../conexion.php';

//Recibimos los valores de login.js/login_usuario()
if(empty($_GET["usuario"])){
	$usuario="0";
}else{
	$usuario=$_GET["usuario"];
}//Fin del else..

if(empty($_GET["password"])){
	$password="0";
}else{
	$password=$_GET["password"];
}//Fin del else..

//Declaramos la respuesta que devolveremos a login.js/login_usuario()
$respuesta=Array();

$sql="SELECT usuario, password, id_usuario FROM cuentas_usuario WHERE usuario LIKE '$usuario' AND password LIKE '$password'";
$result=mysqli_query(conectar(),$sql);
desconectar();
$num_rows=mysqli_num_rows($result);
if($num_rows>0){
	$respuesta['valor'] = "1";
	
	//Asignamos valores a las variables de sesión
	$col=mysqli_fetch_array($result);
	$_SESSION["usuario"]=$col[0];
	$_SESSION["password"]=$col[1];
	$_SESSION["id"]=$col['id_usuario'];
	$_SESSION["ultimoAcceso"]=date("Y-n-j H:i:s");
	//$_SESSION["autentificado"]="SI";
}else{
	$respuesta['valor'] = "0";
}
//Respondemos a la función login.js/login_usuario()
echo json_encode($respuesta);



/*
CODIGO CESAR

if(!isset($_SESSION['nombre_user'])){
	$sql="SELECT usuario, password, id_usuario FROM cuentas_usuario WHERE usuario LIKE '".$usuario."' AND PASSWORD LIKE '".$password."'";
	$result=mysqli_query(conectar(),$sql);
	desconectar();
	$num_rows=mysqli_num_rows($result);
	if($num_rows>0){
		$_SESSION["autentificado"]="SI";
		//Defino fecha y hora...
		$_SESSION["ultimoAcceso"]=date("Y-n-j H:i:s");
		$fechaGuardada=$_SESSION["ultimoAcceso"];
		$ahora=date("Y-n-j H:i:s");
		$tiempo_transcurrido=(strtotime($ahora)-strtotime($fechaGuardada));
		//Comparo el tiempo transcurrido....
		if($tiempo_transcurrido>=600){
			session_destroy();//Destruyo la sesion
			header("Location:?page=login");
		}else{
			$_SESSION["ultimoAcceso"]=$ahora;
		}//Fin del else...
		$col=mysqli_fetch_array($result);
		$_SESSION["nombre_user"]=$col[0];
		$_SESSION["password"]=$col[1];
		$_SESSION["id"]=$col['id_usuario'];
		//$respuesta="1";
		$respuesta['valor'] = "1";
	}else{
		session_destroy(); 
		$respuesta['valor'] = "0";
	}//Fin del else...
}//Fin de la validación del usuario...
echo json_encode($respuesta);

*/
?>