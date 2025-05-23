<div class="row justify-content-center">
  <div class="col-md-10">
    <div class=" card card-outline card-info">
      <div class="card-header">
      <div class="row">
          <div class="col-md-6">
            <label class="card-title" style="font-size: 22px">Registrar usuario</label>
          </div>
          <div class="col-md-6 justify-right">
            <a href="main.php?view=ListUsuario">
              <button style="font-size: 16px; color: gray" type="button"
                class="btn botones-card float-right "><i class="fas fa-folder-open"></i> &nbsp;Lista de Usuarios</button>
            </a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <form action="" id="formularioUsuario">
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="nombres">Nombres</label>
                <input id="nombres" class="form-control form-control-border"></input>
              </div>
              <div class="col-md-6">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" class="form-control form-control-border"></input>
              </div>
              <div class="col-md-4 mt-2">
                <label for="nombreusuario">Nombre de usuario</label>
                <input id="nombreusuario" type="text" class="form-control form-control-border"></input>
              </div>
              <div class="col-md-4 mt-2">
                <label for="clave">Clave</label>
                <input id="clave" type="password" class="form-control form-control-border"></input>
              </div>

              <div class="col-md-4 mt-2">
                <label for="nombrerol">Rol</label>
                <select id="nombrerol" class="form-control form-control-border">
                  <option value="Vendedor" selected>Vendedor</option>
                  <option value="Gerente">Gerente</option>
                  <option value="Administrador">Administrador</option>
                </select>
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

<script src="js/api.js"></script>
<script src="js/usuarios.js"></script>