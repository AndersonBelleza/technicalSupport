
$(document).ready(function(){

  function addNewProductRow() {
    const table = document
      .getElementById("detalle-pedido-table")
      .getElementsByTagName("tbody")[0];

    const newRow = document.createElement("tr");
    newRow.innerHTML = `
      <td>
        <div class="input-group">
          <input type="text" name="producto_codigo[]" class="form-control producto-codigo" readonly placeholder="Código Producto" style="border: none; background-color: none; color: black;" data-idProducto="">
        </div>
      </td>
      <td>
        <input name="stock[]" class="form-control stock-producto" placeholder="Stock" readonly style="border: none; background-color: none; color: black;">
      </td>
      <td>
        <input name="precio[]" class="form-control precio-producto" placeholder="Precio" readonly style="border: none; background-color: none; color: black;">
      </td>
      <td>
        <input type="number" name="cantidad[]" class="form-control cantidad-producto" placeholder="Cantidad" min="1" value="1">
      </td>
      <td>
        <input name="igv[]" class="form-control igv-producto" placeholder="Igv" readonly style="border: none; background-color: none; color: black;">
      </td>
      <td>
        <input name="total[]" class="form-control total-producto" placeholder="Total" readonly style="border: none; background-color: none; color: black;">
      </td>
      <td>
        <button type="button" class="btn btn-danger remove-row-btn">X</button>
      </td>
    `;
    
    table.appendChild(newRow);

    newRow.querySelector(".remove-row-btn").addEventListener("click", function() {
        table.removeChild(newRow);
        calculateTotalsTables();
    });

    return newRow;
  }
  
  $(document).on("click", "#searchButton", function () {
      const selectedProductCode = $("#productoSeleccionado").val();

      if (selectedProductCode == "") {
          mostrarAlerta("warning", "¡Seleccione un producto para buscar!");
          return;
      }

      const datas = {
          op: "searchProduct",
          codigo: selectedProductCode,
      };

      let verifyProducto = getTableData();      
      
      $.ajax({
          url: "controllers/Product.controller.php",
          type: "GET",
          data: datas,
          success: function (response) {
            const data = JSON.parse(response);

            const existsProduct = verifyProducto.find(( val ) => val?.idProducto == data[0]?.idProducto)
            if (existsProduct) {
                mostrarAlerta("warning", "El producto ya está seleccionado.");
                return;
            }

              if (data.length > 0) {
                  const newRow = addNewProductRow();

                  const precio = parseFloat(data[0].precio);
                  const cantidad = 1;
                  const igv = calculateIgv(precio, cantidad);
                  const total = calculateTotal(precio, igv, cantidad);

                  newRow.querySelector('.producto-codigo').setAttribute('data-codigo', data[0]?.codigo); // Cambiado a 'codigo'
                  newRow.querySelector('.producto-codigo').setAttribute('data-idProducto', data[0]?._id); // Cambiado a 'codigo'
                  newRow.querySelector('input[name="producto_codigo[]"]').value = data[0]?.nombre;
                  newRow.querySelector('input[name="stock[]"]').value = data[0]?.stock;
                  newRow.querySelector('input[name="cantidad[]"]').value = cantidad;
                  newRow.querySelector('input[name="precio[]"]').value = precio.toFixed(2);
                  newRow.querySelector('input[name="igv[]"]').value = igv.toFixed(2);
                  newRow.querySelector('input[name="total[]"]').value = total.toFixed(2);

                  calculateTotalsTables();
              } else {
                  mostrarAlerta("info", "El producto no existe. Ingrese otro código.");
              }
          },
          error: function () {
              alert("Error al buscar el producto");
          },
      });
  });

  $(document).on("input", ".cantidad-producto", function () {
    const row = $(this).closest("tr");

    let precio = parseFloat(row.find('input[name="precio[]"]').val()) || 0;
    let cantidad = parseFloat(row.find('input[name="cantidad[]"]').val()) || 0;
    let stock = parseFloat(row.find('input[name="stock[]"]').val());

    if(cantidad > stock) {
      mostrarAlerta("warning", "La cantidad no puede ser superior al stock.");
      let cantidad = parseFloat(row.find('input[name="cantidad[]"]').val(stock)) || 0;
      cantidad = stock;
    }
    let igv = calculateIgv(precio, cantidad);
    let total = calculateTotal(precio, igv, cantidad);

    row.find('input[name="igv[]"]').val(igv.toFixed(2));
    row.find('input[name="total[]"]').val(total.toFixed(2));

    calculateTotalsTables();
  });

  function calculateIgv(precio, cantidad) {
    return precio * 0.18 * cantidad;
  };

  function calculateTotal(precio, igv, cantidad) {
    return precio * cantidad + igv;
  };

  function calculateTotalsTables() {
    let totalSum = 0;
    let totalIgv = 0;

    $('input[name="total[]"]').each(function () {
      let totalValue = parseFloat($(this).val()) || 0;
      totalSum += totalValue;
    });

    $('input[name="igv[]"]').each(function () {
      let totalValue = parseFloat($(this).val()) || 0;
      totalIgv += totalValue;
    });

    $("#totalTables").text("Total: " + totalSum.toFixed(2));
    $("#totalIgv").text("IGV: " + totalIgv.toFixed(2));

    return totalSum.toFixed(2);
  }

  function getTableData() {
    const rows = document.querySelectorAll('table tbody tr'); // Select all rows in the table
    const data = [];

    rows.forEach(row => {
        const productoCodigoInput = row.querySelector('.producto-codigo');
        const productoCodigo = productoCodigoInput.value;
        const idProducto = productoCodigoInput.getAttribute('data-idProducto'); // Get the data-idProducto attribute
        const precio = row.querySelector('.precio-producto').value;
        const cantidad = row.querySelector('.cantidad-producto').value;
        const igv = row.querySelector('.igv-producto').value;
        const total = row.querySelector('.total-producto').value;
        const stock = row.querySelector('.stock-producto').value;
        if(stock == 0) {
          mostrarAlerta("warning", "Uno de los productos no tiene stock.");
          return [];
        }
        data.push({
            nombre: productoCodigo,
            idProducto: idProducto,
            precio: precio,
            cantidad: cantidad,
            igv: igv,
            total: total
        });
    });

    return data;
  };

  $(document).on("click", "#register", function () {
    let tipoCliente = $("#tipoCliente").val();
    let nombre = $("#cliente").val();
    let fechaEmision = $("#fechaEmision").val();
    let tipoDocumento = $("#tipoDocumento").val();
    let medioPago = $("#medioPago").val();

    const tableData = getTableData();

    if(tableData.length == 0) {
      mostrarAlerta("warning", "Uno de los productos no tiene stock.");
      return;
    }
    
    if (tipoCliente == "" || nombre == "" || fechaEmision == "" || tipoDocumento == "" || medioPago == "") {
      mostrarAlerta("warning", "¡Completar los campos necesarios!");
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
            op: "registerVenta",
            tipoCliente,
            nombre,
            fechaEmision,
            tipoDocumento,
            medioPago,
            tipo : 'Venta',
            montoFinal : calculateTotalsTables()
          }
        
          $.ajax({
            url: "controllers/Venta.controller.php",
            type: "GET",
            data: datos,
            success: function (e) {
              var response = JSON.parse(e);
              console.log(e)
              tableData.map(( val ) => {
                var data = {
                  op: 'registerDetalleVenta',
                  ...val, 
                  total: val?.total,
                  idVenta: response[0]?.inserted_id
                };

                registerDetalleVenta(data);

                getProduct(data);
              })
              mostrarAlerta("success", "¡Registrado con éxito!");
            },
          });
        }
      });
    }

  });

  function registerDetalleVenta (datos) {
    $.ajax({
      url: "controllers/DetalleVenta.controller.php",
      type: "GET",
      data: datos,
      success: function (e) {
        $("#formVenta")[0].reset();
        $("#totalIgv").text("IGV: 0.00");
        $("#totalTables").text("Total: 0.00");
        $("#detalle-pedido-table tbody").empty();
      },
    });
  };

  function setTodayAsDefault() {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
    const dd = String(today.getDate()).padStart(2, '0');
    const formattedToday = `${yyyy}-${mm}-${dd}`;
    
    document.getElementById('fechaEmision').value = formattedToday;
  }

  function updateProductStock(idProducto, cantidad) {
    var datos = {
      'op': 'updateProductStock',
      idProducto: idProducto,
      stock: cantidad
    };
    
    $.ajax({
      url: "controllers/Product.controller.php",
      type: "GET",
      data: datos,
      success: function (e) {
        console.log("updateProductStock", e);
      },
    });
  }

  function registerStock(data) {
    var datos = {
      'op': 'registerKardex',
      ...data
    };
    
    $.ajax({
      url: "controllers/Kardex.controller.php",
      type: "GET",
      data: datos,
      success: function (e) {
        console.log("e", e)
      },
    });
  }

  function getProduct (data) {
    const { cantidad: cantidadRegistrada, idProducto, idVenta } = data;
    
    var datos = {
      'op': 'getProduct',
      idProducto: idProducto
    };

    console.log("datos", datos)
    
    $.ajax({
      url: "controllers/Product.controller.php",
      type: "GET",
      data: datos,
      success: function (e) {
        var result = JSON.parse(e);
        console.log("result", result);

        let idProducto = result[0]?.idProducto;
        var newCantidad = parseFloat(parseFloat(result[0]?.stock) - parseFloat(cantidadRegistrada));

        if(newCantidad <= result[0]?.stockMin){
          mostrarAlerta("info", `¡Solo te quedan ${newCantidad}, ya llegó al stock mínimo!`);
        }

        var dataKardex = {
          idProducto,
          idVenta,
          nombreProducto: result[0]?.nombre,
          tipo: 'Venta',
          cantidad: cantidadRegistrada,
          stockActual: newCantidad
        };

        registerStock(dataKardex)
        updateProductStock(idProducto, newCantidad);
      },
    });
  }

  function loadSelectProduct () {
    var datos = {
      'op': 'selectProduct',
    };
    
    $.ajax({
      url: "controllers/Product.controller.php",
      type: "GET",
      data: datos,
      success: function (e) {
        $("#productoSeleccionado").html(e);
      },
    });
  }

  loadSelectProduct();
  
  setTodayAsDefault();
});