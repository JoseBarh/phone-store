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
	<link rel="stylesheet" href="../styles/css/modulo_usuario/login-usuario-body.css">

	<!-- aqui comenzamos a enlazar los footers -->
    <link rel="stylesheet" href="../styles/css/stick-footer.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap">

</head>

<body>
	
<section class="section-login">

	<form class="form-box">

		<h1 class="Titulo-login">D-Cell SB</h1>

		<h1 class="Subtitulo-login">Recuperar cuenta</h1>

		<div class="inputs">

			<div class="correo">
				<input type="text" name="" placeholder="Correo electronico">
			</div>

		</div>

		<div class="botones-login">
			<a href="#" class="btn">Enviar</a>
			<p class="Link-registrarse">No tienes una cuenta? <a href="registro.php">Registrarse</a></p>
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

<script src="../../styles/js/funciones-usuario.js"></script>

</html>