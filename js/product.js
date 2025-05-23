$(document).ready(function(){
  
  function registerProduct() {
    let codigo = $("#codigo").val();
    let nombre = $("#nombre").val();
    let precio = $("#precio").val();
    let stockMin = $("#stockMin").val();
    let stock = $("#stock").val();

    if (codigo == "" || nombre == "" || stockMin == "" || stock == "") {
      console.log("warning", "¡Completar los campos necesarios!");
    } else {
      Swal.fire({
        icon: "question",
        title: "¿Está seguro de registrar?",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar",
      }).then((result) => {
        if (result.isConfirmed) {
          var datos = {
            op: "registerProduct",
            codigo: codigo,
            nombre: nombre,
            precio: precio,
            stockMin: stockMin,
            stock: stock,
          };
          $.ajax({
            url: "controllers/Product.controller.php",
            type: "GET",
            data: datos,
            success: function (e) {
              mostrarAlerta("success", "¡Registrado con éxito!");
              $("#formProduct")[0].reset();
            },
          });
        }
      });
    }
  }
  
  function listProduct() {
    $.ajax({
      url: "controllers/Product.controller.php",
      type: "GET",
      data: "op=listProduct",
      success: function (e) {
        var tabla = $("#tablaProduct").DataTable();
        tabla.destroy();
        $("#listProduct").html(e);
        $("#tablaProduct").DataTable({
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
          // buttons: ["copy", "print", "pdf", "excel"],
        });
      },
    });
  }

  //btnDeleteProduct
  $(document).on("click", "#btnDeleteProduct", function () {
    let idProducto = $(this).attr("data-id"); // Leer el atributo data-id

    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto una vez eliminado el producto.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, hacer la petición AJAX para eliminar el producto
            var datos = {
                'op': 'deleteProduct',
                idProducto: idProducto
            };

            $.ajax({
                url: "controllers/Product.controller.php",
                type: "GET",
                data: datos,
                success: function (e) {
                      listProduct(); // Actualiza la lista de productos después de eliminar
                      Swal.fire(
                          'Eliminado!',
                          'Recuerda que si el producto pertenece a una venta, no se podrá eliminar.',
                          'success'
                      );
                
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'No se pudo eliminar el producto.',
                        'error'
                    );
                }
            });
        }
    });
  });
    
  listProduct();
  $("#register").click(registerProduct);

});