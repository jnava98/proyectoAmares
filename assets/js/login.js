function login_usuario(){
    if((!(document.getElementById("usuario").value==""))&&(!(document.getElementById("password").value==""))){
        $(document).ready(function(){
            //Defino las variables
            var usuario=$('#usuario').val();
            var password=$('#password').val();
            //Función de Ajax
            $.ajax({
                url: "assets/php/login/comprobar_usuario.php",
                type: "get",
                dataType:"json",//Formato en como se manda la información
                data:{//Información a enviar o cadena a enviar
                    usuario:usuario,
                    password:password
                },
                success:function(respuesta){
                    if(respuesta.valor=="1"){
                        window.location.replace("?page=control"); 
                        //document.getElementById("iniciar_sesion").action="?page=clientes";
                        //document.getElementById("iniciar_sesion").submit();
                    }else{
                        $(document).ready(function(){
                            console.log(respuesta.valor);
                            swal({
                                text:'¡Usuario o Contraseña invalidos!',
                                type:'error'
                            });
                        });
                    }//Fin del else
                    
                },
                error:function(respuesta,jqXHR, exception){//Si surge un error
                    swal({
                        text:'Error en consulta',
                        type:'error'
                    });
                    //console.log(respuesta,jqXHR,exception);
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

//FUNCIONES POR EJECUTAR AL CARGAR LA PAGINA
$( document ).ready(function() {

    //Event.listener para la tecla enter
    document.getElementById("password").addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            login_usuario();
        }
    });






});//Fin document.ready




