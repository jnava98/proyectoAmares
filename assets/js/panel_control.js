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

function cargar_grafica_lotes_vendidos(){
    $.ajax({
        url:"assets/php/panel_control/cargar_grafica_lotes_vendidos.php",
        dataType:"json",//Formato en como se manda la información
        type:"get",
        data:{//Información a enviar o cadena a enviar
        },
        success:function(respuesta){
            $(document).ready(function(){
                if(respuesta.valor=="ok"){
                    console.log(respuesta);
                    new ApexCharts(document.querySelector("#div_grafica_lote"), {
                        series: [{
                            name: 'Premium',
                            data: [respuesta.Premium[0],respuesta.Premium[1],respuesta.Premium[2],respuesta.Premium[3],respuesta.Premium[4],respuesta.Premium[5],]
                        }, {
                            name: 'Estándar',
                            data: [respuesta.Estandar[0],respuesta.Estandar[1],respuesta.Estandar[2],respuesta.Estandar[3],respuesta.Estandar[4],respuesta.Estandar[5],]
                        }, {
                            name: 'Plus',
                            data: [respuesta.Plus[0],respuesta.Plus[1],respuesta.Plus[2],respuesta.Plus[3],respuesta.Plus[4],respuesta.Plus[5],]
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                            show: false
                            },
                        },
                        markers: {
                            size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                            type: "gradient",
                            gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        xaxis: {
                            type: 'date',
                            categories: ["Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio"]
                        },
                        tooltip: {
                            x: {
                                format: 'dd/MM/yy'
                            },
                        },
                        toolbar: {
                            show: true,
                            offsetX: 0,
                            offsetY: 0,
                            tools: {
                            download: true,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true | '<img src="/static/icons/reset.png" width="20">',
                            customIcons: []
                            },
                            export: {
                                csv: {
                                    filename: undefined,
                                    columnDelimiter: ',',
                                    headerCategory: 'category',
                                    headerValue: 'value',
                                    dateFormatter(timestamp) {
                                    return new Date(timestamp).toDateString()
                                    }
                                },
                                svg: {
                                    filename: undefined,
                                },
                                png: {
                                    filename: undefined,
                                }
                            },
                            autoSelected: 'zoom' 
                        },
                    }).render();
                }//fin del if
            });	
        },
        error:function(respuesta){//Si surge un error
            console.log(respuesta);
        }//fin de error
    });//fin de ajax
}//fin de funcion carga tabla notificaciones