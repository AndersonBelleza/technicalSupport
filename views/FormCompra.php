<div class="row justify-content-center">
  <div class="col-md-10">
    <div class=" card card-outline card-info">
      <div class="card-header">
      <div class="row">
          <div class="col-md-6">
            <label class="card-title" style="font-size: 22px">Registrar compra</label>
          </div>
          <div class="col-md-6 justify-right">
            <a href="main.php?view=ListCompra">
              <button style="font-size: 16px; color: gray" type="button"
                class="btn botones-card float-right "><i class="fas fa-folder-open"></i> &nbsp;Ver compras</button>
            </a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <form action="" id="formVenta">
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label for="tipoCliente">Tipo de proveedor</label>
                <select id="tipoCliente" class="form-control form-control-border">
                  <option value="persona" selected>Persona</option>
                  <option value="empresa">Empresa</option>
                </select>
              </div>
              <div class="col-md-3">
                  <label for="documento">Documento</label>
                  <input type="text" id="documento" class="form-control form-control-border" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
              </div>
              <div class="col-md-7">
                <label for="cliente">Proveedor</label>
                <input id="cliente" type="text" class="form-control form-control-border"></input>
              </div>
              <div class="col-md-4 mt-2">
                <label for="fechaEmision">Fecha de Emisión</label>
                <input id="fechaEmision" type="date" class="form-control form-control-border">
              </div>

              <div class="col-md-4 mt-2">
                <label for="tipoDocumento">Tipo de Documento</label>
                <select id="tipoDocumento" class="form-control form-control-border">
                  <option value="factura">Factura</option>
                  <option value="boleta" selected>Boleta</option>
                </select>
              </div>

              <div class="col-md-4 mt-2">
                <label for="medioPago">Medios de Pago</label>
                <select id="medioPago" class="form-control form-control-border">
                  <option value="Efectivo" selected>Efectivo</option>
                  <option value="Yape">Yape</option>
                  <option value="Plin">Plin</option>
                  <option value="Transferencia">Transferencia</option>
                </select>
              </div>

              <!-- <div class="col-md-4 mt-3">
                <label for="stockMin">Buscar producto:</label>
                <div class="input-group mb-3">
                  <input id="codigoSearch" type="text" class="form-control" placeholder="Escribe el código...">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary producto-codigo" type="button" id="searchButton">Buscar</button>
                  </div>
                </div>
              </div> -->

              <div class="col-md-4 mt-2">
                <label for="productoSeleccionado">Buscar producto:</label>
                <div class="input-group">
                  <select id="productoSeleccionado" class="form-control form-control-border">
                      <option value="">Seleccionar</option>
                  </select>

                  <div class="input-group-prepend">
                      <button class="btn btn-outline-secondary producto-codigo" type="button" id="searchButton">Agregar</button>
                  </div>
                </div>
                
              </div>
            </div>
          </div>

          <div class="table-responsive text-center">
            <table class="table table-sm" id="detalle-pedido-table">
              <thead class="w-full">
                <tr>
                  <th class="w-25">Producto</th>
                  <th class="w-20">Precio</th>
                  <th class="w-15">Cantidad</th>
                  <th class="w-15">Igv</th>
                  <th class="w-15">Total</th>
                  <th class="w-10">Acción</th>
                </tr>
              </thead>
              <tbody>
                <!-- Rows will be dynamically added here -->
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3" class="text-right">
                    
                  </td>
                  <td class="text-center">
                    <label for="" id="totalIgv"> IGV: 0.00 </label>
                  </td>
                  <td class="text-center">
                    <label for="" id="totalTables"> Total: 0.00 </label>
                  </td>
                </tr>
              </tfoot>
            </table>
            <hr>
          </div>
        </form>
      </div>
      
      <div class="card-footer text-right">
        <button type="button" class="btn bg-gradient-secondary " id="cancel">Cancelar</button>
        <button type="button" class="btn bg-gradient-info" id="register">Registrar</button>
      </div>
    </div>
  </div>
</div>

<script src="js/api.js"></script>
<script src="js/compra.js"></script>