<?php
session_start();
include('menu.php');
if(!(empty($_SESSION["usuario"]))){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Amares Cobranza - Lotes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <script type="text/javascript" src="assets/js/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="assets/js/clientes.js"></script>  
  <!--<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css">
  <script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.min.js"></script>
  
</head>

<body>

  <?=menu();?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Lotes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?page=control">Inicio</a></li>
          <li class="breadcrumb-item">Lotes</li>
          <li class="breadcrumb-item active">Gestión de Lotes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!-- div_lote -->
    <section class="section">
      <div id="div_lote" class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Consulta de Lotes <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Opciones para consultar el inventario de lotes."></span></h5>
              <div class="row">
                <div class="col-lg-4">
                  <select id="select_principal" class="form-control" aria-label="Selecciona la fase de los lotes que deseas consultar">
                    <option value="0" selected>Todos</option>
                    <option value="-1">Lotes reservados</option>
                    <option value="-2">Lotes disponibles</option>
                  </select>
                </div>
              </div> 
              <br>
              <div class="row">
                <div class="col-sm-8 mt-2">
                  <button class="btn boton_uno" id="btn_confirmar">Consultar</button>
                  <button class="btn boton_dos" data-bs-toggle='modal' data-bs-target='#modal2' id="btn_actualizar">Actualización de precios</button>
                </div>
              </div> 
          </div>
        </div>
      </div>
      <div class="col-lg-12" id="div_card_lotes" style="display: none;">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Lotes Consultados</h5>
            <div class="table-responsive" id="div_tabla_lotes">
              
              </div>
          </div>
        </div>
      </div>
      <!-- modal1 -->
      <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edición Lote</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="form_modal">
              <div class="mb-3">
                <label for="form_fase" class="form-label">Fase</label>
                <input type="number" class="form-control" id="form_fase" >
              </div>
              <div class="mb-3">
                <label for="form_super_manzana" class="form-label">Super Manzana</label>
                <input type="number" class="form-control" id="form_super_manzana" >
              </div>
              <div class="mb-3">
                <label for="form_manzana" class="form-label">Manzana</label>
                <input type="number" class="form-control" id="form_manzana" >
              </div>
              <div class="mb-3">
                <label for="form_lote" class="form-label">Lote</label>
                <input type="number" class="form-control" id="form_lote" >
              </div>
              <div class="mb-3">
                <label for="form_m2" class="form-label">m2</label>
                <input type="number" class="form-control" id="form_m2" >
              </div>
              <div class="mb-3">
                <label for="form_cos" class="form-label">cos</label>
                <input type="number" class="form-control" id="form_cos" >
              </div>
              <div class="mb-3">
                <label for="form_cus" class="form-label">cus</label>
                <input type="number" class="form-control" id="form_cus" >
              </div>
              <div class="mb-3">
                <label for="form_precio_lista" class="form-label">Precio de Lista</label>
                <input type="number" class="form-control" id="form_precio_lista" >
              </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
              <button type="button" class="btn btn-primary" onclick="update_datos_lote()">Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal2 -->
      <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Actualización vía Excel.</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal2" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h5>En este módulo podrá actualizar los lotes que no se encuentren en proceso de compra. <br> Para realizar la actualización, siga los siguientes pasos: </h5>
              <hr>
              <ol>
                <li>Descargue el <button class="btn btn-success">Archivo csv.</button> y abralo.</li>
                <li>Eliminar las filas que contengan lotes que no desea modificar.</li>
                <li>Actualizar los datos que desee sobre los lotes.</li>
                <li>Guarde el archivo que modificó.</li>
                <li>Introduzca el archivo con los datos actualizados.
                  <input class="form-control" type="file" accept=".csv" id="formFile">
                </li>
                <li>Presione el botón "Actualizar Datos" en la esquina inferior.</li>
                <li>No cierre el explorador hasta que reciba un mensaje de confirmación de actualización.</li>
                <p style="color: red;">NOTA: Todos los datos que cambie en el excel incluidas fases, supermanzana, lotes, precios, medidas, etc. Serán actualizados en la base de datos, así que debe revisar CUIDADOSAMENTE los datos que desea modificar.</p> 
              </ol>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Salir</button>
              <button type="button" class="btn btn-primary" onclick="update_datos_lote()">Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- Script para el toggle de los "?"-->
  <script>
  
  //Elementos
  var btn_confirmar = document.getElementById("btn_confirmar");
  var select_principal = document.getElementById("select_principal");
  var tabla_lotes_body = document.getElementById("tabla_lotes_body");
  var div_lotes = document.getElementById("div_card_lotes");
  var tabla_lotes = document.getElementById("tabla_lotes");
  var div_tabla_lotes = document.getElementById("div_tabla_lotes");
  var form_fase = document.getElementById("form_fase");
  var form_super_manzana = document.getElementById("form_super_manzana");
  var form_manzana = document.getElementById("form_manzana");
  var form_lote = document.getElementById("form_lote");
  var form_m2 = document.getElementById("form_m2");
  var form_cos = document.getElementById("form_cos");
  var form_cus = document.getElementById("form_cus");
  var form_precio_lista = document.getElementById("form_precio_lista");
  var form_modal = document.getElementById("form_modal");
  var modal = document.getElementById("modal");


  //Event listeners.
  btn_confirmar.addEventListener("click",function(){
    consultaLotes(select_principal.value)},true);
  


  window.onload = function(){
    traeFasesLotes();
  };

  document.r
  



  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })



  //Funciones asincronas


  //Funciones
  async function traeFasesLotes(){
    try{
      let response = await fetch('./assets/php/lotes/traeFasesLotes.php');
      let fases = await response.json();
      select_principal.innerHTML += fases.html;
    }catch(error){
      Swal.fire('Ups! Ha ocurrido un error','Verificar la consola','error');
      console.log("ERROR: "+error);
    }
  }

  async function consultaLotes(option){
    try {
      let response = await fetch('./assets/php/lotes/consultaLotes.php',{method: 'POST', body: JSON.stringify(option)}); 
      let json = await response.json(); 
      div_tabla_lotes.innerHTML = json.html;
      div_lotes.style.display = 'block';
      var table = $('#tabla_lotes').DataTable({
        dom: 'Bfrtip',
        buttons: ['csv', 'excel', 'pdf', 'print']
      });
      //table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
      
    } catch (error) {
      Swal.fire('Ups! Ha ocurrido un error','Verificar la consola: ',error);
      console.log("ERROR: "+error);
    }
  }

  function modal_editar(json_datos_lote){
    form_fase.value = json_datos_lote.fase
    form_super_manzana.value = json_datos_lote.super_manzana
    form_manzana.value = json_datos_lote.mza
    form_lote.value = json_datos_lote.lote
    form_m2.value = json_datos_lote.m2
    form_cos.value = json_datos_lote.cos
    form_cus.value = json_datos_lote.cus
    form_precio_lista.value = json_datos_lote.precio_lista
    form_modal.value = json_datos_lote.id_lote
  }

  async function update_datos_lote(){

      //Validaciones de los inputs
      if(form_fase.value==0||form_fase.value=="") return Swal.fire('Datos incompletos','Fase','warning'); 
      if(form_super_manzana.value==0||form_super_manzana.value=="") return Swal.fire('Datos incompletos','Super Manzana','warning'); 
      if(form_manzana.value==0||form_manzana.value=="") return Swal.fire('Datos incompletos','Manzana','warning'); 
      if(form_lote.value==0||form_lote.value=="") return Swal.fire('Datos incompletos','Lote','warning'); 
      if(form_m2.value==0||form_m2.value=="") return Swal.fire('Datos incompletos','m2','warning'); 
      if(form_cos.value==0||form_cos.value=="") return Swal.fire('Datos incompletos','Cos','warning'); 
      if(form_cus.value==0||form_cus.value=="") return Swal.fire('Datos incompletos','Cus','warning'); 
      if(form_precio_lista.value==0||form_precio_lista.value=="") return Swal.fire('Datos incompletos','Cus','warning'); 
      var datos_lote ={
        id_lote : form_modal.value,
        fase : form_fase.value,
        super_manzana : form_super_manzana.value,
        manzana : form_manzana.value,
        lote : form_lote.value,
        m2 : form_m2.value,
        cos : form_cos.value,
        cus : form_cus.value,
        precio_lista : form_precio_lista.value
      }
        let response = await fetch('./assets/php/lotes/update_datos_lote.php',{method: 'POST', body: JSON.stringify(datos_lote)});
        let json = await response.json();
        Swal.fire('Datos Actualizados!','Los datos del lote se actualizaron correctamente','success');
        consultaLotes(select_principal.value); 
        //select_principal.innerHTML += fases.html;

  };

  function EliminarLoteModal(id_lote){
    Swal.fire({
      title: 'Seguro que deseas eliminar este lote?',
      text: "No podrás deshacer estos cambios.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {
        EliminarLote(id_lote);
        
      }
    })
  }

  async function EliminarLote(id_lote){
    try {
      let response = await fetch('./assets/php/lotes/eliminaLote.php',{method: 'POST', body: JSON.stringify(id_lote)});
      Swal.fire(
          'Eliminado!',
          'El lote que seleccionaste ha sido eliminado con exito.',
          'success'
        );
        consultaLotes(select_principal.value);
      
    } catch (error) {
      Swal.fire('Ups! Ha ocurrido un error','Verificar la consola: ',error);
      console.log("ERROR: "+error);
    }
  }
  </script>
 

</body>
<?php
}else{
	header("Location:?page=login");
}//Fin del else...
?>
</html>

