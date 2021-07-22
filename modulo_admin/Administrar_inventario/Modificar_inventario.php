<?php
    // incluimos base de datos
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
    // Necesario para validar si existe el IDProducto para validar y ejecutar consulta
    $IDProducto=$_REQUEST['IDProducto'];
    // consultamos los datos que imprimiremos en los campos
    $db = new Database();
    $consulta = $db->connect()->prepare("SELECT Producto,PrecioCosto,PrecioVenta,Existencias,Detalles,IDProvedor, Empresa, t_tipo_producto.IDTipoProducto, TipoProducto, t_tipo_marca.IDMarca, Marca FROM t_inventario 

    INNER JOIN t_provedor ON t_provedor.IDProvedores = t_inventario.IDProvedor
    INNER JOIN t_tipo_producto ON t_tipo_producto.IDTipoProducto = t_inventario.IDTipoProducto
    INNER JOIN t_tipo_marca ON t_tipo_marca.IDMarca = t_inventario.IDMarca
    
    WHERE IDProducto='$IDProducto'");

    $consulta->execute();
    $rowCampos=$consulta->fetch();
    // validamos que exista el IDProducto para modificar
    if($IDProducto==false){
        echo'<script type="text/javascript">
        alert("Error al obtener IDProducto para modificar. Intente de nuevo.");
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
                <a href="Inventario.php">
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
        <form action="Actualizar_producto.php?IDProducto=<?php echo $IDProducto;?>" method="POST" id="form">

            <!-- titulo -->
            <p class="Titulo">Modificar producto de inventario</p>

            <!-- primer fila de campos -->
            <div class="row justify-content-md-center">
    
                <!-- primer fila -->
                <div class="col-md-4 col-sm-3 columna">
                    <select name="IDProvedor" id=""> 
                        <option value="<?php echo $rowCampos['IDProvedor'];?>">Proveedor actual -> <?php echo $rowCampos['Empresa'];?></option>
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
                        <option value="<?php echo $rowCampos['IDTipoProducto'];?>">Tipo de producto actual -> <?php echo $rowCampos['TipoProducto'];?></option>
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
                        <option value="<?php echo $rowCampos['IDMarca'];?>">Marca actual -> <?php echo $rowCampos['Marca'];?></option>
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
                    <input type="text" name="Producto" placeholder="Nombre del producto" value="<?php echo $rowCampos['Producto'];?>">Producto
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <input type="text" name="PrecioCosto" placeholder="Precio costo del producto" value="<?php echo $rowCampos['PrecioCosto'];?>">Precio costo
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <input type="text" name="PrecioVenta" placeholder="Precio venta del producto" value="<?php echo $rowCampos['PrecioVenta'];?>">Precio venta
                </div>

                <!-- Tercer fila -->

                <div class="col-md-6 col-sm-3 columna">
                    <input type="text" name="Existencias" placeholder="Existencias del producto" value="<?php echo $rowCampos['Existencias'];?>">Existencias
                </div>

                <div class="col-md-6 col-sm-3 columna">
                    <input type="text" name="Detalles" placeholder="Detalles del producto" value="<?php echo $rowCampos['Detalles'];?>">Detalles
                </div>

            </div>
            
            <!-- fila de botones -->
            <div class="row justify-content-md-center">

                <div class="col-md-6 col-sm-3 columna">
                    <a style="cursor: pointer;" class="btn_registrar" onclick="document.forms['form'].submit()">Actualizar</a>                
                </div>
    
                <div class="col-md-6 col-sm-3 columna">
                    <a style="cursor: pointer;" class="btn_registrar" href="Inventario.php">Cancelar</a>
                </div>

            </div>
            

		</form>


    </div>

</body>

</html>