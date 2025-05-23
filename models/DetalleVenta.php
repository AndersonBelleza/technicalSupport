<?php

require_once '../core/model.master.php';

class DetalleVenta extends ModelMaster{

    public function registerDetalleVenta(array $data){
        try{
            return parent::execProcedure($data, "spu_detalleVenta_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function graficoProductos(array $data){
        try{
            return parent::execProcedure($data, "spu_filtrarProductosPorTipoVenta", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}
?>