
$(document).ready(function(){

  function listKardex() {
    $.ajax({
      url: "controllers/Kardex.controller.php",
      type: "GET",
      data: "op=listKardex",
      success: function (e) {
        var tabla = $("#tablaKardex").DataTable();
        tabla.destroy();
        $("#listKardex").html(e);
        $("#tablaKardex").DataTable({
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