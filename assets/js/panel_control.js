function carga_tabla_notificaciones(){
    $.ajax({
        url:"assets/php/panel_control/tabla_notificaciones.php",
        dataType:"json",//Formato en como se manda la información
        type:"get",
        data:{//Información a enviar o cadena a enviar
        },
        success:function(respuesta){
            $(document).ready(function(){
                if(respuesta.valor=="ok"){
                    $('#div_tabla_notificaciones').html(respuesta.formato);//En donde quiero mostrar la información
				    $('#tabla_clientes_notificaciones').DataTable();
                }else{
                    $('#div_tabla_notificaciones').html(respuesta.formato);//En donde quiero mostrar la información
                    console.log(respuesta);		
                }//fin del else
            });	
        },
        error:function(respuesta){//Si surge un error
            console.log(respuesta);
        }//fin de error
    });//fin de ajax
}//fin de funcion carga tabla notificaciones