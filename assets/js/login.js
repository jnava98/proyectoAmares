function login_usuario(){
    if((!(document.getElementById("usuario").value.length<="0"))&&(!(document.getElementById("password").value.length<="0"))){
        $(document).ready(function(){
            //Defino las variables
            var usuario=$('#usuario').val();
            var password=$('#password').val();
            //Función de Ajax
            $.ajax({
                url:"assets/php/comprobar_usuario.php",
                dataType:"json",//Formato en como se manda la información
                type:"get",
                data:{//Información a enviar o cadena a enviar
                    usuario:usuario, password:password
                    },
                beforeSend:function(){//Se ejecuta antes/durante de realizar la petición
                    $('#aviso').html("Cargando");
                }, 
                success:function(respuesta){
                    if(respuesta.valor=="1"){
                        document.getElementById("iniciar_sesion").action ="?page=clientes";
                        document.forms["iniciar_sesion"].submit();
                    }else{
                        $('#comprobar').show().html("¡Comprobar nombre de usuario o contraseña!");
                    }//Fin del else
                },
                error:function(respuesta){//Si surge un error
                    console.log(respuesta);
                }
            });//Fin de ajax
        });        
    }else{
        $(document).ready(function(){
            swal({
                text:'¡Es necesario ingresar un nombre de usuario y un password!',
                type:'error'
            });
        });
    }//Fin del else...
}//Fin de login_usuario...  