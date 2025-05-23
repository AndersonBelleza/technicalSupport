
$(document).ready(function(){

  function listKardex() {
    $.ajax({
      url: "controllers/Kardex.controller.php",
      type: "GET",
      data: "op=kardexValorizado",
      success: function (e) {
        var tabla = $("#tablaKardexValorizado").DataTable();
        tabla.destroy();
        $("#listKardexValorizado").html(e);
        $("#tablaKardexValorizado").DataTable({
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
          },
          columnDefs: [
            {
              visible: true,
              searchable: true,
            },
          ],
          dom: "Bfrtip",
          buttons: [],
        });
      },
    });
  }

  listKardex();
});