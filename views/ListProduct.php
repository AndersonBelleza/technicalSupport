<?php
    require_once 'datatable.php';
?>

<div class="row justify-content-center">
  <div class="col-md-10">
    <div class=" card card-outline card-info">
      <div class="card-header">
        <div class="row">
          <div class="col-md-12">
            <label class="card-title" style="font-size: 22px">Lista de Productos</label>
          </div>
        </div>
      </div>

      <div class="card-body table-responsive">
          <table class="table" id="tablaProduct">
              <thead>
                  <tr>
                      <th class="text-center">Código</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Precio</th>
                      <th class="text-center">Stock Minímo</th>
                      <th class="text-center">Stock</th>
                      <th class="text-center">Acción</th>
                    </tr>
              </thead>
              <tbody class="table" id="listProduct">
                  <!-- Se carga de manera dinamica -->
              </tbody>
          </table>
      </div>

      <!-- <div class="card-footer text-right">
        <button type="button" class="btn bg-gradient-secondary " id="cancel">Cancelar</button>
        <button type="button" class="btn bg-gradient-info" id="register">Registrar</button>
      </div> -->
    </div>
  </div>
</div>

<script src="js/product.js"></script>