
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
        <input name="precio[]" class="form-control precio-producto" placeholder="Precio">
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
  };

  $(document).on("click", "#searchButton", function () {
    const codigoProducto = $("#productoSeleccionado").val();

    if(codigoProducto == ""){
      mostrarAlerta("warning", "¡Escriba un código para buscar el producto.!");
      return;
    }

    const data = {
      op: "searchProduct",
      codigo: codigoProducto,
    };
    let verifyProducto = getTableData();      

    $.ajax({
      url: "controllers/Product.controller.php",
      type: "GET",
      data: data,
      success: function (response) {
        const data = JSON.parse(response);
        console.log(verifyProducto)
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
          newRow.querySelector('.producto-codigo').setAttribute('data-idProducto', data[0]?.idProducto);
          newRow.querySelector('input[name="producto_codigo[]"]').value =
            data[0]?.nombre;
          newRow.querySelector('input[name="cantidad[]"]').value = cantidad;
          newRow.querySelector('input[name="precio[]"]').value = 0.00; 
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

    let igv = calculateIgv(precio, cantidad);
    let total = calculateTotal(precio, igv, cantidad);

    row.find('input[name="igv[]"]').val(igv.toFixed(2));
    row.find('input[name="total[]"]').val(total.toFixed(2));

    calculateTotalsTables();
  });

  $(document).on("input", ".precio-producto", function () {
    const row = $(this).closest("tr");
    let precio = parseFloat(row.find('input[name="precio[]"]').val()) || 0;

    let cantidad = parseFloat(row.find('input[name="cantidad[]"]').val()) || 0;

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

    $('#totalTables').text("Total: " + totalSum.toFixed(2));
    $('#totalIgv').text("IGV: " +totalIgv.toFixed(2));

    return totalSum.toFixed(2);
  };

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

        // Push the values into the array as an object
        data.push({
            nombre: productoCodigo,
            idProducto: idProducto, // Include the idProducto
            precio: precio,
            cantidad: cantidad,
            igv: igv,
            total: total
        });
    });

    return data;
  };

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
    
    $.ajax({
      url: "controllers/Product.controller.php",
      type: "GET",
      data: datos,
      success: function (e) {
        var result = JSON.parse(e);

        let idProducto = result[0]?.idProducto;
        var newCantidad = parseFloat(parseFloat(result[0]?.stock) + parseFloat(cantidadRegistrada));

        var dataKardex = {
          idProducto,
          idVenta,
          nombreProducto: result[0]?.nombre,
          tipo: 'Compra',
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

  $(document).on("click", "#register", function () {
    let tipoCliente = $("#tipoCliente").val();
    let nombre = $("#cliente").val();
    let fechaEmision = $("#fechaEmision").val();
    let tipoDocumento = $("#tipoDocumento").val();
    let medioPago = $("#medioPago").val();

    const tableData = getTableData();
    
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
            tipo : 'Compra',
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

  loadSelectProduct();
  setTodayAsDefault();
});