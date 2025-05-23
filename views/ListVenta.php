<?php
    require_once 'datatable.php';
?>

<div class="row justify-content-center">
  <div class="col-md-10">
    <div class=" card card-outline card-info">
      <div class="card-header">
        <div class="row">
          <div class="col-md-12">
            <label class="card-title" style="font-size: 22px">Ventas Realizadas</label>
          </div>
        </div>
      </div>

      <div class="card-body table-responsive">
          <table class="table" id="tablaVenta">
              <thead>
                  <tr>
                      <th class="text-center">Cliente</th>
                      <th class="text-center">Tipo</th>
                      <th class="text-center">Medio de Pago</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Monto</th>
                  </tr>
              </thead>
              <tbody class="table" id="listVenta">
                  <!-- Se carga de manera dinamica -->
              </tbody>
          </table>

  
      </div>

    </div>
  </div>
</div>

<script src="js/listVenta.js"></script>