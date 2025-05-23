<?php
session_start();

require_once '../models/Venta.php';

if (isset($_GET['op'])){
  $operacion = $_GET['op'];

  $models = new Venta();

  if ($operacion == 'registerVenta'){
    $response = $models->registerVenta([
      "nombre"       => $_GET["nombre"],
      "montoFinal"       => $_GET["montoFinal"],
      "tipoDocumento"       => $_GET["tipoDocumento"],
      "tipoCliente"       => $_GET["tipoCliente"],
      "fechaEmision"       => $_GET["fechaEmision"],
      "tipo"       => $_GET["tipo"],
      "medioPago"       => $_GET["medioPago"]
    ]);

    echo json_encode($response);
  }

  if ($operacion == 'listVenta') {
    $data = $models->listVenta([ "tipo" => $_GET["tipo"] ]);

    if (count($data) != 0) {
      $i = 1;
      $n = 1;
      foreach ($data as $fila) {
        echo "
          <tr>
            <td class='text-center text-sm'>$fila->nombre</td>
            <td class='text-center text-uppercase text-sm'>$fila->tipoDocumento</td>
            <td class='text-center text-sm'>$fila->medioPago</td>
            <td class='text-center text-sm'>$fila->fechaEmision</td>
            <td class='text-center text-sm'>S/ $fila->montoFinal</td>
          </tr>
          ";
        $i++;
        $n++;

      }
    }
  }

}
?>