<?php 
	session_start(); 
	if (isset($_SESSION['acceso'])){
		if ($_SESSION['acceso'] == true){
			header('Location:main.php');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<!-- <div class="login100-pic js-tilt" data-tilt>
					<img src="images/logo.jpg" alt="IMG">
				</div> -->

				<form class="login100-form validate-form" id="loginForm">
					<span class="login100-form-title bold">
						Qhatu Wasi
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="usuario" name="email" placeholder="Usuario">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" id="clave" name="pass" placeholder="Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="button" class="login100-form-btn" id="login" style="color:white">
							Iniciar sesión
						</button>
					</div>

					<div class="text-center p-t-12"></div>
					<div class="text-center p-t-136"></div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		$(document).ready(function () {
			function iniciarSesion() {
				const usuario = $("#usuario").val();
				const clave = $("#clave").val();

				if (usuario === "" || clave === "") {
					Swal.fire({
						icon: "warning",
						title: "Complete los campos solicitados",
						position: "bottom-end",
						timerProgressBar: true,
						timer: 1000,
						toast: true,
						showConfirmButton: false,
						didOpen: (toast) => {
							toast.addEventListener("mouseenter", Swal.stopTimer);
							toast.addEventListener("mouseleave", Swal.resumeTimer);
						},
					});
				} else {
					$.ajax({
						url: "controllers/Usuario.controller.php",
						type: "GET",
						data: {
							op: "login",
							nombreusuario: usuario,
							clave: clave,
						},
						success: function (result) {
							console.log(result);
							if ($.trim(result) != "10" || $.trim(result) != "9") {
								window.location.href = "main.php?view=FormVenta";
							} else {
								Swal.fire({
									icon: "error",
									title: "Credenciales incorrectas",
									position: "bottom-end",
									timerProgressBar: true,
									timer: 1500,
									toast: true,
									showConfirmButton: false,
								});
							}
						},
					});
				}
			}

			$("#login").click(iniciarSesion);
		});
	</script>
</body>
</html>
