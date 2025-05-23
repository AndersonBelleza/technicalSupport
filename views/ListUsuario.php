<?php
    require_once 'datatable.php';
?>

<div class="row justify-content-center">
  <div class="col-md-10">
    <div class=" card card-outline card-info">
      <div class="card-header">
        <div class="row">
          <div class="col-md-12">
            <label class="card-title" style="font-size: 22px">Usuarios</label>
          </div>
        </div>
      </div>

      <div class="card-body table-responsive">
          <table class="table" id="tablaUsuario">
              <thead>
                  <tr>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Apellidos</th>
                      <th class="text-center">Nombre de Usuario</th>
                      <th class="text-center">Fecha Creación</th>
                  </tr>
              </thead>
              <tbody class="table" id="listUsuario">
                  <!-- Se carga de manera dinamica -->
              </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<script src="js/ListUsuarios.js"></script>