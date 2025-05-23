
$(document).ready(function(){

  function listarVentas () {
    var datos = {
      'op' : 'listVenta',
      'tipo' : 'Venta'
    }
    $.ajax({
      url: "controllers/Venta.controller.php",
      type: "GET",
      data: datos,
      success: function (e) {
        var tabla = $("#tablaVenta").DataTable();
        tabla.destroy();
        $("#listVenta").html(e);
        $("#tablaVenta").DataTable({
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

  listarVentas();

});