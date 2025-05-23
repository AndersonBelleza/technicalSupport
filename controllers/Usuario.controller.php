<?php
session_start();

require_once '../models/Usuario.php';

if (isset($_GET['op'])){

  $usuario = new Usuario();
  $operacion = $_GET['op'];

  if ($operacion == 'login'){

    //Array asociativo
    $datos = ["nombreusuario" => $_GET['nombreusuario']];
    $resultado = $usuario->login($datos);
    
    if ($resultado){
    
      $registro = $resultado[0];

      //Sabemos que el usuario existe, entonces verificamos que su clave es CORRECTA
      $claveValidar = $_GET['clave'];

      //Validando la contraseña
      if (password_verify($claveValidar, $registro['clave'])){

        $_SESSION['acceso'] = true;

        //La clave es correcta...
        $_SESSION['idusuario'] = $registro['idusuario'];
        $_SESSION['apellidos'] = $registro['apellidos'];
        $_SESSION['nombres'] = $registro['nombres'];
        $_SESSION['nombreusuario'] = $registro['nombreusuario'];
        $_SESSION['clave'] = $registro['clave'];
        $_SESSION['nombrerol'] = $registro['nombrerol'];

        if($_SESSION['nombrerol'] == 'Vendedor'){
          echo "1";
        }else if($_SESSION['nombrerol'] == 'Administrador'){
          echo "2";
        }else if($_SESSION['nombrerol'] == 'Gerente'){
          echo "3";
        }else{
          echo "4";
        }
        
      }else{

        $_SESSION['acceso'] = false;
        $_SESSION['idusuario'] = '';
        $_SESSION['apellidos'] = '';
        $_SESSION['nombres'] = '';
        $_SESSION['nombreusuario'] = '';
        $_SESSION['clave'] = '';
        $_SESSION['nombrerol'] = '';

        // echo "La clave es incorrecta";
        echo "10";

      }

    }else{
      
      //No se puede acceder, usuario NO existe
      $_SESSION['acceso'] = false;
      $_SESSION['idusuario'] = '';
      $_SESSION['apellidos'] = '';
      $_SESSION['nombres'] = '';
      $_SESSION['nombreusuario'] = '';
      $_SESSION['clave'] = '';
      $_SESSION['nombrerol'] = '';

      echo"9";
      // echo "El usuario no existe";
    }
  }

  if ($operacion == 'cerrar-sesion'){
    session_destroy();
    session_unset();
    header('Location:../');
  }

  if ($operacion == 'registrarUsuario'){
    $usuario->registrarUsuario([
      "nombres"       => $_GET["nombres"],
      "apellidos"       => $_GET["apellidos"],
      "nombreusuario"          => $_GET["nombreusuario"],
      "nombrerol"          => $_GET["nombrerol"],
      "clave"     => password_hash($_GET["clave"], PASSWORD_BCRYPT),
    ]);
  }

  if ($operacion == 'listaUsuariosAll') {
    $data = $usuario->listarUsuariosAll();

    if (!empty($data)) {
        foreach($data as $fila) {
            echo "
              <tr>
                <td class='text-center text-sm'>{$fila->nombres}</td>
                <td class='text-center text-sm'>{$fila->apellidos}</td>
                <td class='text-center text-sm'>{$fila->nombreusuario}</td>
                <td class='text-center text-sm'>{$fila->fechacreacion}</td>
              </tr>
            ";
        }
    }
}
  
}
?>