<?php
function mostrar_tabla_usuarios(){
    $html="";
    $sql="SELECT * FROM cuentas_usuario order by usuario";
    $result_usuarios=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result_usuarios);
    if ($num>0){
        $i=0;
        $html.="<h4>Tabla de usuarios</h4>"; 
        $html.="<table id='tabla_usuarios' class='table.table-striped table-bordered table-hover table-condensed'>";
            $html.="<thead>";
                $html.="<tr>";
                    $html.="<th style='text-align:center'>#</th>";
                    $html.="<th style='text-align:center'>Usuario</th>";
                    $html.="<th style='text-align:center'>Contraseña</th>";
                    $html.="<th style='text-align:center'>Nombre</th>";
                    $html.="<th style='text-align:center'>Acciones</th>";
                $html.="</tr>";
            $html.="</thead>";
            $html.="<tbody>";
            while($col_usuarios=mysqli_fetch_array($result_usuarios)){
                $i+=1;
                $html.="<tr>";
                    $html.="<td style='text-align:center'>".$i."</td>";
                    $html.="<td><input disabled='disabled' class='form-control' name='input_usuario&".$i."' id='input_usuario&".$i."' value='".$col_usuarios['usuario']."'></input></td>";
                    $html.="<td><input disabled='disabled' class='form-control' name='input_password&".$i."' id='input_password&".$i."' value='".$col_usuarios['password']."'></input></td>";
                    $html.="<td><input disabled='disabled' class='form-control' name='input_nombre&".$i."' id='input_nombre&".$i."' value='".$col_usuarios['nombre']."'></input></td>";
                    $html.="<td>";
                        $html.="<button id='".$col_usuarios['id_usuario']."' onclick='editar_usuario(this.id);return false;'><span class='glyphicon glyphicon-edit' style='font-size:15px'></span></button>";
                        $html.="&nbsp;&nbsp;<button id='".$col_usuarios['id_usuario']."' onclick='actualizar_usuario(this.id);return false;'><span class='glyphicon glyphicon-floppy-saved' style='font-size:15px'></span></button>";
                        $html.="&nbsp;&nbsp;<button id='".$col_usuarios['id_usuario']."' onclick='eliminar_usuario(this.id);return false;'><span class='glyphicon glyphicon-trash' style='font-size:15px'></span></button>";
                    $html.="</td>";
                $html.="</tr>";
            }//Fin del while
            $html.="<input type='hidden' id='total_usuarios' name='total_usuarios' value='".$i."'>";
            $html.="</tbody>";    
            $html.="</table>";
    }//Fin del if..
    return $html;
}//fin de mostrar tabla usuarios



?>