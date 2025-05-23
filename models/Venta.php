<?php

require_once '../core/model.master.php';

class Venta extends ModelMaster{

    public function registerVenta(array $data){
        try{
            return parent::execProcedure($data, "spu_venta_registro", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    
    public function listVenta(array $data){
        try{
            return parent::execProcedure($data, "spu_venta_lista", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}
?>