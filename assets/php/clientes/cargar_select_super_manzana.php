<?php
session_start();
include "../conexion.php";
include "../funciones.php";

if(empty($_GET["fase"])){
	$fase="0";
}else{
	$fase=$_GET["fase"];
}//Fin del else