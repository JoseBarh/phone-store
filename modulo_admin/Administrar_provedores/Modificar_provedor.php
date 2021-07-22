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
    
    $IDProvedor=$_REQUEST['IDProvedor'];

    $db = new Database();
    $consulta = $db->connect()->prepare("SELECT * FROM t_provedor WHERE IDProvedores='$IDProvedor'");
    $consulta->execute();
    $row=$consulta->fetch();
    
    if($IDProvedor==false){
        echo'<script type="text/javascript">
        alert("Error al obtener ID para modificar. Intente de nuevo.");
        window.location.href="Provedor.php";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
                <a href="Provedor.php">
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
        <form action="Actualizar_provedor.php?IDProvedor=<?php echo $row['IDProvedores'];?>" method="POST" id="form">

            <!-- titulo -->
            <p class="Titulo">Registrar provedor</p>

            <!-- primer fila de campos -->
            <div class="row justify-content-md-center">

                <div class="col-md-4 col-sm-3 columna">
                    <div class="Empresa">
                        <input type="text" name="Empresa" placeholder="Nombre de empresa" value="<?php echo $row['Empresa'];?>">
                    </div>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <div class="RTN">
                        <input type="text" name="RTN" placeholder="RTN de empresa" value="<?php echo $row['RTN'];?>">
                    </div>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <div class="Telefono">
                        <input type="text" name="Telefono" placeholder="Telefono de empresa" value="<?php echo $row['Telefono'];?>">
                    </div>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <div class="Direccion">
                        <input type="text" name="Direccion" placeholder="Direccion de empresa" value="<?php echo $row['Direccion'];?>">
                    </div>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <div class="Correo">
                        <input type="text" name="Correo" placeholder="Correo de empresa" value="<?php echo $row['Correo'];?>">
                    </div>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <div class="SitioWeb">
                        <input type="text" name="SitioWeb" placeholder="Sitio Web de empresa" value="<?php echo $row['SitioWeb'];?>">
                    </div>
                </div>

            </div>
            
            <!-- fila de botones -->
            <div class="row justify-content-md-center">

                <div class="col-md-6 col-sm-3 columna">
                    <a style="cursor: pointer;" class="btn_registrar" onclick="document.forms['form'].submit()">Actualizar</a>                
                </div>
    
                <div class="col-md-6 col-sm-3 columna">
                    <a style="cursor: pointer;" class="btn_registrar" href="Provedor.php">Cancelar</a>
                </div>

            </div>
            

		</form>


    </div>

</body>

</html>