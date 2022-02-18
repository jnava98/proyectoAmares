function login_usuario(){
    if((!(document.getElementById("usuario").value==""))&&(!(document.getElementById("password").value==""))){
        $(document).ready(function(){
            //Defino las variables
            var usuario=$('#usuario').val();
            alert(usuario);
            var password=$('#password').val();
            alert(password);
            //Función de Ajax
            $.ajax({
                url: "assets/php/comprobar_usuario.php",
                type: "get",
                dataType:"json",//Formato en como se manda la información
                data:{//Información a enviar o cadena a enviar
                    usuario:usuario,
                    password:password
                },
                success:function(respuesta){
                    if(respuesta.valor=="1"){
                        document.getElementById("iniciar_sesion").action ="?page=clientes";
                        document.getElementById["iniciar_sesion"].submit();
                    }else{
                        $(document).ready(function(){
                            swal({
                                text:'¡Usuario o Contraseña invalidos!',
                                type:'error'
                            });
                        });
                    }//Fin del else
                    
                },
                error:function(respuesta,jqXHR, exception){//Si surge un error
                    console.log("error en ajax");
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