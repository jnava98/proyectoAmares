<?php
	
	if(isset($_GET["page"])){

	$pagina=$_GET["page"];
	if($pagina=="login") include "assets/pages/login.php";
    if($pagina=="usuarios") include "assets/pages/usuarios.php";
    if($pagina=="clientes") include "assets/pages/clientes.php";
	if($pagina=="control") include "assets/pages/control.php";
	if($pagina=="pagos") include "assets/pages/pagos.php";
	if($pagina=="reportes") include "assets/pages/reportes.php";
	if($pagina=="crear_excel") include "assets/php/reportes/crear_excel.php";
	if($pagina=="lotes") include "assets/pages/lotes.php";
	if ($pagina=="descuentos") include "assets/pages/descuentos.php";
	if($pagina=="impresion_contrato") include "assets/pages/impresion_contrato.php";
	}else{
		$pagina="login";
		include "assets/pages/login.php";
	}//Fin del else...

?>