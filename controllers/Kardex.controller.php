<?php
session_start();

require_once '../models/Kardex.php';

if (isset($_GET['op'])){
  $operacion = $_GET['op'];

  $kardex = new Kardex();

    if ($operacion == 'registerKardex'){
      $kardex->registerKardex([
        "idProducto"       => $_GET["idProducto"],
        "idVenta"       => $_GET["idVenta"],
        "nombreProducto"       => $_GET["nombreProducto"],
        "tipo"       => $_GET["tipo"],
        "cantidad"       => $_GET["cantidad"],
        "stockActual"       => $_GET["stockActual"]
      ]);
    }

    if ($operacion == 'listKardex') {
        $data = $kardex->listKardex();
    
        if (!empty($data)) {
            foreach($data as $fila) {

              $cantidad = '';
              if ($fila->tipo === 'Venta') {
                  $cantidad = '-' . $fila->cantidad;
              } else {
                  $cantidad = '+' . $fila->cantidad;
              }


                echo "
                  <tr>
                    <td class='text-center text-sm'>{$fila->nombreProducto}</td>
                    <td class='text-center text-sm'>{$fila->tipo}</td>
                    <td class='text-center text-sm'>{$fila->fechaEmision}</td>
                    <td class='text-center text-sm'>{$cantidad}</td>
                    <td class='text-center text-sm'>{$fila->stockActual}</td>
                  </tr>
                ";
            }
        }
    }

    if ($operacion == 'kardexValorizado') {
      $data = $kardex->stockValorizado();
  
      if (!empty($data)) {
          foreach($data as $fila) {

              echo "
                <tr>
                  <td class='text-center text-sm'>{$fila->nombreProducto}</td>
                  <td class='text-center text-sm'>{$fila->fechaEmision}</td>
                  <td class='text-center text-sm'>{$fila->precio}</td>
                  <td class='text-center text-sm'>{$fila->stockActual}</td>
                  <td class='text-center text-sm'>{$fila->totalValor}</td>
                </tr>
              ";
          }
      }
    }

}
?>