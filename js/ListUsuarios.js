
$(document).ready(function(){

  function listarUsuarios () {
    var datos = {
      'op' : 'listaUsuariosAll',
    }
    $.ajax({
      url: "controllers/Usuario.controller.php",
      type: "GET",
      data: datos,
      success: function (e) {
        var tabla = $("#tablaUsuario").DataTable();
        tabla.destroy();
        $("#listUsuario").html(e);
        $("#tablaUsuario").DataTable({
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
          },
          columnDefs: [
            { targets: 0, width: "40%" },
            { targets: 1, width: "20%" },
            { targets: 2, width: "20%" },
            { targets: 3, width: "20%" },
          ],
          // dom: "Bfrtip",
          buttons: [],
        });
      },
    });
  }

  listarUsuarios();

});