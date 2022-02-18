<?php

	if(isset($_GET["page"])){

		$pagina=$_GET["page"];
		if($pagina=="login") include "assets/pages/login.php";
    if($pagina=="usuarios") include "assets/pages/usuarios.php";
    if($pagina=="clientes") include "assets/pages/clientes.php";

	}else{
		$pagina="login";
		include "assets/pages/login.php";
	}//Fin del else...

?>