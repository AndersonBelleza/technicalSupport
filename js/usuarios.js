$(document).ready(function() {
  function registrarUsuarios() {
    let nombres = $("#nombres").val();
    let apellidos = $("#apellidos").val();
    let nombreusuario = $("#nombreusuario").val();
    let nombrerol = $("#nombrerol").val();
    let clave = $("#clave").val();
    if(nombres == "" || apellidos == "" || nombreusuario == "" || nombrerol == "" || clave == ""){
        mostrarAlerta("warning", "¡Completar los campos necesarios!");
    }else{
        Swal.fire({
            icon:'question',
            title:'¿Está seguro de registrar?',
            showCancelButton: true,
            cancelButtonText:'Cancelar',
            confirmButtonText:'Aceptar'
        }).then((result) =>{
            if(result.isConfirmed){
                var datos = {
                    'op'            : 'registrarUsuario',
                    'nombres'       : nombres,
                    'apellidos'     : apellidos, 
                    'nombreusuario' : nombreusuario,
                    'nombrerol'     : nombrerol,
                    'clave'         : clave
                };

                $.ajax({
                    url: 'controllers/Usuario.controller.php',
                    type:'GET',
                    data: datos,
                    success:function(e){
                        mostrarAlerta("success", "¡Registrado con éxito!");
                        $("#formularioUsuario")[0].reset();
                    }
                });
            }
        });
    }
  }

  $("#register").click(registrarUsuarios);

})