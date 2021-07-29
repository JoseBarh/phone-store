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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">

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

        <!-- titulo -->
        <p class="Titulo">Productos en inventario</p>

        <!-- fila de tabla -->
        <div class="contenedor_tabla">

            <!-- tabla -->
            <table id="tabla" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>IDProducto</th>
                        <th>IDProveedor</th>
                        <th>IDTipoProducto</th>
                        <th>IDMarca</th>
                        <th>Producto</th>
                        <th>Fecha entrada</th>
                        <th>Precio costo</th>
                        <th>Precio venta</th>
                        <th>Existencias</th>
                        <th>Detalles</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                
                <tbody>
                    <!-- Filas para mostrar -->
                                <!-- realizamos una consulta con un while  -->
                                <?php 
                                include_once '../../db/database.php';

                                $db = new Database();
                                $consulta = $db->connect()->prepare('SELECT IDProducto, Empresa, TipoProducto, Marca, Producto, FechaEntrada, PrecioCosto, PrecioVenta, Existencias, Detalles  
                                FROM t_inventario
                                
                                INNER JOIN t_provedor ON t_provedor.IDProvedores = t_inventario.IDProvedor
                                INNER JOIN t_tipo_producto ON t_tipo_producto.IDTipoProducto = t_inventario.IDTipoProducto
                                INNER JOIN t_tipo_marca ON t_tipo_marca.IDMarca = t_inventario.IDMarca
                                WHERE Existencias>=1');
                                $consulta->execute();
                                while($row=$consulta->fetch()){
                                    ?>
                                    <!-- Imprime la informacion obtenida en la tabla -->
                                    <tr>
                                        <td><?php echo $row['IDProducto']?></td>
                                        <td><?php echo $row['Empresa']?></td>
                                        <td><?php echo $row['TipoProducto']?></td>
                                        <td><?php echo $row['Marca']?></td>
                                        <td><?php echo $row['Producto']?></td>
                                        <td><?php echo $row['FechaEntrada']?></td>
                                        <td><?php echo $row['PrecioCosto']?></td>
                                        <td><?php echo $row['PrecioVenta']?></td>
                                        <td><?php echo $row['Existencias']?></td>
                                        <td><?php echo $row['Detalles']?></td>

                                        <td><a class="btn btn-primary " href="Modificar_inventario.php?IDProducto=<?php echo $row['IDProducto'];?>">Modificar</a></td>
                                    </tr>

                                    <?php
                                }
                                ?>

                </tbody>
            </table>
        
        </div>

    </div>

</body>

<!-- script para tabledata -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        
        $('#tabla').DataTable({
            // numero de filas que mostrara en tabla
            "pageLength": 100,
            //filtrado de busqueda 
            "search": {
            // caseInsensitive coincidencia entre minusculas y mayusculas
            "caseInsensitive": true,
            // Realiza busquedas inteligente mas exactas evita la sugerencia de relaciones
            "smart": false,
            //Tratar como una expresión regular () o no 
            "regex": true,
            }
        })
    });  
</script>



</html>