<?php

require_once '../core/model.master.php';

class Kardex extends ModelMaster{

    public function registerKardex(array $data){
        try{
            return parent::execProcedure($data, "spu_kardex_registro", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listKardex(){
        try{
            return parent::getRows("spu_kardex_lista");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function stockValorizado(){
        try{
            return parent::getRows("spu_stockValorizado_list");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

}
?>