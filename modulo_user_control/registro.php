<?php
    // iniciamos sesion
    session_start();
    // verificamos si existe algun IDRol para evitar mas registros con session iniciada
    if(isset($_SESSION['IDRol'])){
        if($_SESSION['IDRol'] == 2){
            header('location: ../index.php');
        }else if($_SESSION['IDRol'] == 1){
            header('location: ../modulo_admin/menu.php');
        }
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>D-Cell SB</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">

	<!-- estilo del cuerpo del login -->
	<link rel="stylesheet" type="text/css" href="../styles/css/modulo_usuario/registrar-usuario-body.css">

	<!-- aqui comenzamos a enlazar el stickfooter -->
    <link rel="stylesheet" type="text/css" href="../styles/css/modulo_usuario/stick-footer.css">

	<!-- tipografia -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap">

</head>

<body>	

	<section class="section-login">

		<form action="enviar_correo_activacion.php" method="POST" class="form-box" id="form">

			<h1 class="Titulo-login">D-Cell SB</h1>

			<h1 class="Subtitulo-login">Registrarse</h1>

			<div class="inputs">

				<div class="nombre">
					<input type="text" name="nombre-usuario" placeholder="Nombre">
				</div>

				<div class="correo">
					<input type="text" name="correo-usuario" placeholder="Correo electronico">
				</div>

				<div class="contrasenas">
					<input type="password" name="password1" placeholder="Contraseña">
					<input type="password" name="password2" placeholder="Confirmar contraseña">
				</div>		

			</div>

			<div class="botones-login" >
				<a style="cursor: pointer;" class="btn" onclick="document.forms['form'].submit()">Registrarse</a>
				<p class="Link-registrarse">Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
			</div>
		</form>
		
		<footer class="stick">
			<div class="stick-footer">
				<a href="http://">Ayuda</a>
				│
				<a href="http://">Privacidad</a>
				│
				<a href="http://">Términos</a>
			</div>
		</footer>
		
	</section>
	
</body>

</html>