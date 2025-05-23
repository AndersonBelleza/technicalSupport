<?php

require_once '../core/model.master.php';

class Usuario extends ModelMaster{

    public function login(array $data){
        try{
        return parent::execProcedureLogin($data, "spu_usuarios_login", true);
        } catch (Exception $error){
        die($error->getMessage());
        }
    }

    public function registrarUsuario(array $data){
        try{
            parent::execProcedure($data, "spu_usuarios_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarUsuariosActivos(){
        try{
            return parent::getRows("spu_usuarios_listarActivo");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarUsuariosAll(){
        try{
            return parent::getRows("spu_usuarios_list");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function actualizarClave(array $data){
        try {
          parent::execProcedureLogin($data, "spu_usuarios_actualizarclave", false);
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    
    public function eliminarUsuario(array $data){
        try{
            parent::execProcedure($data, "spu_usuarios_eliminar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function reactivarUsuario(array $data){
        try{
            parent::execProcedure($data, "spu_usuarios_reactivar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
    
    public function modificarUsuario(array $data){
        try{
            parent::execProcedure($data, "spu_usuarios_modificar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function getUsuario(array $data){
        try{
            return parent::execProcedure($data, "spu_usuarios_getdata", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function nombreusuarioYaRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_nombreusuario_registrado", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function codigoespecialistaYaRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_codespecialista_registrado", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function codverificacion(array $data){
        try{
            parent::execProcedure($data, "spu_usuario_codverificacion", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function eliminarCodverificacion(array $data){
        try{
            parent::execProcedure($data, "spu_usuario_eliminarcodverificacion", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
}
?>