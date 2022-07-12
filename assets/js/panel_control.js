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

function cargar_indicadores_lotes(){
    $.ajax({
        url:"assets/php/panel_control/cargar_indicadores_lotes.php",
        dataType:"json",//Formato en como se manda la información
        type:"get",
        data:{//Información a enviar o cadena a enviar
        },
        success:function(respuesta){
            $(document).ready(function(){
                if(respuesta.valor=="ok"){
                    $('#div_ingreso_lote').html(respuesta.ingreso);//En donde quiero mostrar la información
                    $('#div_lotes_vendidos').html(respuesta.lotes_vendidos);//En donde quiero mostrar la información
                }//fin del if
            });	
        },
        error:function(respuesta){//Si surge un error
            console.log(respuesta);
        }//fin de error
    });//fin de ajax
}//fin de funcion carga tabla notificaciones