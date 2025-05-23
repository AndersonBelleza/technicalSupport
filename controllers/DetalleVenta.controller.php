<?php
session_start();

require_once '../models/DetalleVenta.php';

if (isset($_GET['op'])){
  $operacion = $_GET['op'];

  $models = new DetalleVenta();

    if ($operacion == 'registerDetalleVenta'){
      $models->registerDetalleVenta([
        "idProducto"       => $_GET["idProducto"],
        "idVenta"       => $_GET["idVenta"],
        "precio"       => $_GET["precio"],
        "cantidad"       => $_GET["cantidad"],
        "igv"       => $_GET["igv"],
        "total"       => $_GET["total"]
      ]);
    }

    if ($operacion == 'graficoProductos'){
      $response = $models->graficoProductos([ "fechaEmision"       => $_GET["fechaEmision"] ]);

      echo json_encode($response);
    }

}
?>