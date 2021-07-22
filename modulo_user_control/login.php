<?php
//iniciamos sesion
session_start();
//incluimos base de datos
include_once '../db/database.php';
//Si existe "cerrar_sesion" se retira del sistema
if(isset($_GET['cerrar_sesion'])){
    session_unset(); 
    session_destroy(); 
}
//Si la sesion y el IDRol existe lo enviamos al sistema segun su ROL como usuario
if(isset($_SESSION['IDRol'])){
    switch($_SESSION['IDRol']){
        case 1:
            header("Location:../modulo_admin/menu.php");
        break;
        case 2:
            header("Location:../index.php");
        break;
        default:
    }
}
//Si existe correo y password mediante POST se ejecuta este codigo
if(isset($_POST['correo']) && isset($_POST['password'])){
    // almacenamos en variable los datos enviados por POST
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    // validamos que el usuario exista
    $db = new Database();
    $query = $db->connect()->prepare('SELECT * FROM t_usuarios WHERE correo = :correo AND contrasena = :password');
    $query->execute(['correo' => $correo, 'password' => $password]);
    $row = $query->fetch(PDO::FETCH_NUM);
    if($row == true){
        $active='1';
        //Validamos si el correo ya esta activado
        $db = new Database();
        //aqui debes validar el correo y el active porque el correo te sera unico.
        $query = $db->connect()->prepare('SELECT * FROM t_usuarios WHERE correo = :correo AND contrasena = :password AND active = :active');
        $query->execute(['correo' => $correo, 'password' => $password,'active' => $active]);
        $row = $query->fetch(PDO::FETCH_NUM);
        //si el correo esta activado lo redireciona a login, de lo contrario, lo envia al login
        if($row == true){
            // obtener datos de columnas
			$IDUsuario=$row[0];
            $IDRol = $row[1];
			$NombreUsuario=$row[2];
			$TelefonoUsuario=$row[3];
			$DireccionUsuario=$row[4];
			$GeneroUsuario=$row[5];
			// El correo de usuario ya lo tenemos en $correo 6
			// El password de usuario ya lo tenemos en $password 7
			// El code no lo necesitamos 8
			// El active no lo necesitamos 9

            // almacenar los datos de columnas en las $SESSION
			$_SESSION['IDUsuario'] = $IDUsuario;
            $_SESSION['NombreUsuario'] = $NombreUsuario;
			$_SESSION['IDRol'] = $IDRol;
			$_SESSION['PasswordUsuario'] = $password;
			
            switch($IDRol){
                case 1:
                    header("Location:../modulo_admin/menu.php");
                break;
                case 2:
                    header("Location:../index.php");
                break;
                default:
			}
			
            }else{
                echo'<script type="text/javascript">
                alert("Necesitas activar tu cuenta desde tu correo para iniciar sesión.");
                window.location.href="login.php";
                </script>';
            }
        }else{
            echo'<script type="text/javascript">
            alert("No se encontraron credenciales.");
            window.location.href="login.php";
            </script>';
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

	<!-- Iconos externos boxicon -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

	<!-- aqui comenzamos a enlazar los footers -->
    <link rel="stylesheet" href="../styles/css/stick-footer.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap">

</head>

<body>
	
<section class="section-login">

	<form action="login.php" method="POST" class="form-box" id="form">

		<h5 class="Titulo-login">D-Cell SB</h5>

		<h1 class="Subtitulo-login">Iniciar sesión</h1>

		<div class="inputs">

			<div class="correo">
				<input type="text" name="correo" placeholder="Correo electronico">
			</div>

			<div class="contrasena">
				<input type="password" name="password" placeholder="Contraseña">
			</div>

			<p class="Link-olvide-clave"><a href="recuperar-cuenta.php">¿Olvidaste tu contraseña?</a></p>
		</div>

		<div class="botones-login">
			<a style="cursor: pointer;" class="btn" onclick="document.forms['form'].submit()">Iniciar sesión</a>
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

</html>