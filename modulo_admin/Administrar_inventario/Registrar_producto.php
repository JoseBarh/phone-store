<?php
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-Cell admin</title>

    <!-- styles para tabledata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">    

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
                <a href="../menu.php">
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

        <form action="Guardar_producto.php" method="POST" id="form">

            <!-- titulo -->
            <p class="Titulo">Registrar producto</p>

            <!-- fila contenedor de campos -->
            <div class="row justify-content-md-center">

                <!-- primer fila -->
                <div class="col-md-4 col-sm-3 columna">
                    <select name="IDProvedor" id="">
                        <option value="">Selecciona un proveedor</option>
                        <?php 
                            include_once '../../db/database.php';

                            $db = new Database();
                            $consultaSelect1 = $db->connect()->prepare('SELECT IDProvedores, Empresa FROM t_provedor');
                            $consultaSelect1->execute();
                            while($row=$consultaSelect1->fetch()){
                                ?>
                                    <!-- Imprime la informacion obtenida en el select -->
                                    <option value="<?php echo $row['IDProvedores']?>"><?php echo $row['Empresa']?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <select name="IDTipoProducto" id="">
                        <option value="">Selecciona tipo producto</option>
                        <?php 
                            include_once '../../db/database.php';

                            $db = new Database();
                            $consultaSelect2 = $db->connect()->prepare('SELECT IDTipoProducto, TipoProducto FROM t_tipo_producto');
                            $consultaSelect2->execute();
                            while($row=$consultaSelect2->fetch()){
                                ?>
                                <!-- Imprime la informacion obtenida en el select -->
                                    <option value="<?php echo $row['IDTipoProducto']?>"><?php echo $row['TipoProducto']?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <select name="IDMarca" id="">
                        <option value="">Selecciona una marca</option>
                        <?php 
                            include_once '../../db/database.php';

                            $db = new Database();
                            $consultaSelect2 = $db->connect()->prepare('SELECT IDMarca, Marca FROM t_tipo_marca');
                            $consultaSelect2->execute();
                            while($row=$consultaSelect2->fetch()){
                                ?>
                                <!-- Imprime la informacion obtenida en el select -->
                                    <option value="<?php echo $row['IDMarca']?>"><?php echo $row['Marca']?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <!-- Segunda fila -->

                <div class="col-md-4 col-sm-3 columna">
                    <input type="text" name="Producto" placeholder="Nombre del producto">Producto
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <input type="text" name="PrecioCosto" placeholder="Precio costo del producto" onkeypress="return soloNumeros(event)">Precio costo
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <input type="text" name="PrecioVenta" placeholder="Precio venta del producto" onkeypress="return soloNumeros(event)">Precio venta
                </div>

                <!-- Tercer fila -->

                <div class="col-md-6 col-sm-3 columna">
                    <input type="text" name="Existencias" placeholder="Existencias del producto" onkeypress="return soloNumeros(event)">Existencias
                </div>

                <div class="col-md-6 col-sm-3 columna">
                    <input type="text" name="Detalles" placeholder="Detalles del producto">Detalles
                </div>

            </div>

            <!-- fila de botones -->
            <div class="row justify-content-md-center">
                <a style="cursor: pointer;" class="btn_registrar" onclick="document.forms['form'].submit()">Registrar</a>
            </div>

		</form>


    </div>

</body>

<!-- Validaciones -->
<script src="../../styles/js/modulo_admin/Validaciones.js"></script>

</html>