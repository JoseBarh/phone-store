<?php
    include_once '../../db/database.php';

    // iniciamos sesion
    session_start();
    //creamos variables y se insertan los datos guardados en las $SESSION 
    $IDUsuario = $_SESSION['IDUsuario'];
    $NombreUsuario = $_SESSION['NombreUsuario'];
    //verificamos SINO existe rol o si el rol es distinto a 2 lo reenviamos a login
    if(!isset($_SESSION['IDRol'])){
        header('location: ../../modulo_user_control/login.php');
    }else{
        if($_SESSION['IDRol'] != 1){
            header('location: ../../index.php');
        }
    }
    
    $IDTipoPago=$_REQUEST['IDTipoPago'];

    $db = new Database();
    $consulta = $db->connect()->prepare("SELECT * FROM t_tipo_pago WHERE IDTipoPago='$IDTipoPago'");
    $consulta->execute();
    $row=$consulta->fetch();
    
    if($IDTipoPago==false){
        echo'<script type="text/javascript">
        alert("Error al obtener ID para modificar. Intente de nuevo.");
        window.location.href="TipoPago.php";
        </script>';
    }
        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-Cell admin</title>

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <!-- styles para tabledata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">        
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.min.css">
    
    <!-- style header -->
    <link rel="stylesheet" href="../../styles/css/modulo_admin/header.css">
    
    <!-- style body -->
    <link rel="stylesheet" href="../../styles/css/modulo_admin/modulos/body_modulos.css">
    
    <!-- iconos en boxicon -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>

<header>
    
    <nav class="navbar-top">

        <ul class="navbar-top-ul">

            <li class="navbar-top-item">
                <a href="Tipo_Pago.php">
                    <i class='navbar-top-links bx bx-arrow-back'></i>
                </a>
            </li>

            <li class="navbar-top-item">
                <a href="../modulo_usuario/logout.php" class="navbar-top-links"><i class='bx bx-exit'></i></a>
            </li>

        </ul>

    </nav>

</header>

<body class="body">

    <div class="my-container">
        <form action="Actualizar_tipo_pago.php?IDTipoPago=<?php echo $row['IDTipoPago'];?>" method="POST" id="form">

            <!-- titulo -->
            <p class="Titulo">Modificar tipo de pago</p>

            <!-- fila contenedor de campos -->
            <div class="row justify-content-md-center">
                <!-- primer fila -->
                <div class="col-md-6 col-sm-3 columna">
                    <input  onkeypress="return soloLetras(event)" type="text" name="TipoPago" placeholder="Ingrese el tipo de pago" value="<?php echo $row['TipoPago'];?>">Ingrese el tipo de pago
                </div>
            </div>
  
            <!-- fila de botones -->
            <div class="row justify-content-md-center">
                <div class="col-md-6 col-sm-3 columna">
                    <a style="cursor: pointer;" class="btn_registrar" onclick="document.forms['form'].submit()">Actualizar</a>                
                </div>
                <div class="col-md-6 col-sm-3 columna">
                    <a style="cursor: pointer;" class="btn_registrar" href="Tipo_Pago.php">Cancelar</a>
                </div>
            </div>
            

		</form>


    </div>

</body>

<!-- Validaciones  -->
<script src="../../styles/js/modulo_admin/Validaciones.js"></script>

</html>