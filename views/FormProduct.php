<div class="row justify-content-center">
  <div class="col-md-10">
    <div class=" card card-outline card-info">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6">
            <label class="card-title" style="font-size: 22px">Registrar Productos</label>
          </div>
          <div class="col-md-6 justify-right">
            <a href="main.php?view=ListProduct">
              <button style="font-size: 16px; color: gray" type="button"
                class="btn botones-card float-right"><i class="fas fa-folder-open"></i> &nbsp;Ver Productos</button>
            </a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <form action="" id="formProduct">
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="codigo">Código</label>
                <input id="codigo" class="form-control form-control-border"></input>
              </div>
              <div class="col-md-6">
                <label for="nombre">Nombre</label>
                <input id="nombre" class="form-control form-control-border"></input>
              </div>
              <div class="col-md-4 mt-3">
                <label for="precio">Precio Unitario</label>
                <input id="precio" type="number" class="form-control form-control-border"></input>
              </div>
              <div class="col-md-4 mt-3">
                <label for="stockMin">Stock Minímo</label>
                <input id="stockMin" type="number" class="form-control form-control-border"></input>
              </div>
              <div class="col-md-4 mt-3">
                <label for="stock">Stock</label>
                <input id="stock" type="number" class="form-control form-control-border"></input>
              </div>
            </div>
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

<script src="js/product.js"></script>