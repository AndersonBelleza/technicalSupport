<?php
session_start();

require_once '../models/Product.php';

if (isset($_GET['op'])){
  $operacion = $_GET['op'];

  $product = new Product();

    if ($operacion == 'registerProduct'){
      $product->registerProduct([
        "codigo"       => $_GET["codigo"],
        "nombre"       => $_GET["nombre"],
        "precio"       => $_GET["precio"],
        "stockMin"       => $_GET["stockMin"],
        "stock"       => $_GET["stock"]
      ]);
    }

    if ($operacion == 'updateProductStock'){
      $product->updateProductStock([
        "idProducto"       => $_GET["idProducto"],
        "stock"       => $_GET["stock"]
      ]);
    }

    if ($operacion == 'listProduct') {
        $data = $product->listProduct();

        if(count($data) != 0){
            $i = 1;
            $n = 1;
            foreach($data as $fila){        
                echo "
                    <tr>
                        <td class='text-center'> $fila->codigo </td>
                        <td class='text-center'> $fila->nombre </td>
                        <td class='text-center'> $fila->precio </td>
                        <td class='text-center'> $fila->stockMin </td>
                        <td class='text-center'> $fila->stock </td>
                        <td class='text-center'> 
                          <button class='btn btn-sm btn-danger' id='btnDeleteProduct' data-id='$fila->idProducto'>X</button>
                        </td>
                    </tr>
                    ";
                    $i++;
                    $n++;
                        
            }
        }
    }

    if ($operacion == 'selectProduct') {
      $data = $product->listProduct();
      echo "<option value=''>Seleccionar</option>"; 
      if (count($data) > 0) {
          foreach ($data as $fila) {
            echo "<option value='$fila->codigo'>$fila->nombre</option>";
          }
      }
    }

    if($operacion == 'deleteProduct'){
      $product->deleteProduct(['idProducto' => $_GET['idProducto']]); 
    }


    if($operacion == 'searchProduct'){
      $clave = $product->searchProduct(['codigo' => $_GET['codigo']]); 
  
      echo json_encode($clave);
    }

    if($operacion == 'getProduct'){
      $clave = $product->getProduct(['idProducto' => $_GET['idProducto']]); 
  
      echo json_encode($clave);
    }

}
?>