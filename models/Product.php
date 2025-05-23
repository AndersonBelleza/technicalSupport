<?php

require_once '../core/model.master.php';

class Product extends ModelMaster{

    public function registerProduct(array $data){
        try{
            parent::execProcedure($data, "spu_producto_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function updateProductStock(array $data){
        try{
            parent::execProcedure($data, "spu_producto_actualizarStock", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listProduct(){
        try{
            return parent::getRows("spu_producto_lista");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function searchProduct(array $data){
        try{
            return parent::execProcedure($data, "spu_producto_buscar", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function deleteProduct(array $data){
        try{
            return parent::execProcedure($data, "spu_producto_eliminar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function getProduct(array $data){
        try{
            return parent::execProcedure($data, "spu_producto_id", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}
?>