<?php

$html='
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Captura un pago nuevo.</h5>

        <div class="row mb-12">
            <label for="input_concepto" class="col-sm-2 col-form-label">Concepto</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="inp_concepto">
            </div>
            <label for="inp_formpago" class="col-sm-2 col-form-label">Forma de pago</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inp_formpago">
            </div>
            <label for="inp_mensualidad" class="col-sm-2 col-form-label">Cant Mensualidad</label>
            <div class="col-sm-2">
                <input type="email" class="form-control" id="inp_mensualidad" disabled>
            </div>
        </div>

        <div class="row mb-12">
            <label for="input_fpago" class="col-sm-2 col-form-label">Fecha Pago</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" id="inp_fpago">
            </div>
            <label for="inp_recargo" class="col-sm-2 col-form-label">Recargo</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inp_recargo">
            </div>
            <label for="inp_diferencia" class="col-sm-2 col-form-label">Diferencia</label>
            <div class="col-sm-2">
                <input type="email" class="form-control" id="inp_diferencia" disabled>
            </div>
        </div>

        <div class="row mb-12">
            <label for="input_cpagada" class="col-sm-2 col-form-label">Cantidad Pagada</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="inp_cpagada">
            </div>
            <label for="inp_interes" class="col-sm-2 col-form-label">Interés</label>
            <div class="col-sm-2">
            <input type="email" class="form-control" id="inp_interes">
            </div>
            <label for="inp_totpagar" class="col-sm-2 col-form-label">Total a pagar</label>
            <div class="col-sm-2 ">
            <input type="email" class="form-control" id="inp_totpagar" disabled>
            </div>
        </div>
        <div class="row mb-12 justify-content-end">
            <label for="inp_estatus" class="col-sm-2 col-form-label">Estatus</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="inp_estatus" disabled>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-sm-4">
                <button type="button" class="btn btn-primary" onclick="guarda_pago();">Capturar Pago</button>
            </div>
        </div>
    </div>
</div>
';

    echo $html;

?>
