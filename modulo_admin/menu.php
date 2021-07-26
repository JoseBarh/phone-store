<?php
    // iniciamos sesion
    session_start();
    //creamos variables y se insertan los datos guardados en las $SESSION 
    $IDUsuario = $_SESSION['IDUsuario'];
    $NombreUsuario = $_SESSION['NombreUsuario'];
    //verificamos SINO existe rol o si el rol es distinto a 2 lo reenviamos a login
    if(!isset($_SESSION['IDRol'])){
        echo $_SESSION['IDRol'];
        header('location: ../modulo_user_control/login.php');
    }else{
        if($_SESSION['IDRol'] != 1){
            header('location: ../index.php');
        }
    }
    // Enlazamos base de datos para la recopilacion de datos
    include_once '../db/database.php';
    $db = new Database();

    //TOTAL VENDIDO 
    $consulta1 = $db->connect()->prepare('SELECT SUM(TotalVenta) AS R_TotalVenta FROM t_registro_venta');
    $consulta1->execute();

    //TOTAL GANANCIA
    $consulta2 = $db->connect()->prepare('SELECT SUM(Ganancia) AS R_TotalGanancia FROM t_registro_venta');
    $consulta2->execute();

    //TotalVentaSmartPhones
    $consulta13= $db->connect()->prepare('SELECT SUM(TotalVenta) AS TotalVentaSmartPhone FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE TipoProducto = "SmartPhone" OR TipoProducto= "Tablet"');
    $consulta13->execute();
    //TotalGananciaSmartPhones
    $consulta14= $db->connect()->prepare('SELECT SUM(Ganancia) AS TotalGananciaSmartPhones FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE TipoProducto = "SmartPhone" OR TipoProducto= "Tablet"');
    $consulta14->execute();

    //TotalVentaAccesorios
    $consulta15= $db->connect()->prepare('SELECT SUM(TotalVenta) AS TotalVentaAccesorios FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE TipoProducto = "Accesorio"');
    $consulta15->execute();
    //TotalGananciaAccesorios
    $consulta16= $db->connect()->prepare('SELECT SUM(Ganancia) AS TotalGananciaAccesorios FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE TipoProducto = "Accesorio"');
    $consulta16->execute();



    //Clientes registrados
    $consulta3 = $db->connect()->prepare('SELECT COUNT(*) AS R_TotalUsuarios FROM t_usuarios WHERE IDRol="2"');
    $consulta3->execute();

    //Producto mas vendido
    $consulta4 = $db->connect()->prepare('SELECT Producto,COUNT(*) AS cantidad FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        GROUP BY Producto
        ORDER BY cantidad desc
        LIMIT 1');
    $consulta4->execute();

    //Mejor cliente
    $consulta5 = $db->connect()->prepare('SELECT t_usuarios.IDUsuarios,t_roles.IDRol,Nombre,SUM(Ganancia) AS TotalVenta FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE t_roles.IDRol=2
        GROUP BY t_usuarios.IDUsuarios
        ORDER BY Ganancia ASC
        LIMIT 1');
    $consulta5->execute();

    //Mejor empleado
    $consulta6 = $db->connect()->prepare('SELECT t_usuarios.IDUsuarios,t_roles.IDRol,Nombre,SUM(Ganancia) AS TotalVenta FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE t_roles.IDRol=1
        GROUP BY t_usuarios.IDUsuarios
        ORDER BY Ganancia ASC
        LIMIT 1');
    $consulta6->execute();

    //Grafico de marcas mas vendidas
    $consulta7 = $db->connect()->prepare('SELECT Marca, SUM(CantidadVendida) AS CantidadVendida, TipoProducto FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE TipoProducto = "SmartPhone"
        GROUP BY Marca');
    $consulta7->execute();
    $ChartMarcasVendidas = '';
    while($row=$consulta7->fetch()){
        $ChartMarcasVendidas .= '{label:"'.$row["Marca"].'",value:'.$row["CantidadVendida"]."}, ";        
    }
    $ChartMarcasVendidas = substr($ChartMarcasVendidas, 0);

    //Grafico de productos mas vendidos
    $consulta8 = $db->connect()->prepare('SELECT Producto, SUM(CantidadVendida) AS CantidadVendida, TipoProducto FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE TipoProducto = "SmartPhone"
        GROUP BY Producto');
    $consulta8->execute();
    $ChartProductoVendido = '';
    while($row=$consulta8->fetch()){
        $ChartProductoVendido .= '{label:"'.$row["Producto"].'",value:'.$row["CantidadVendida"]."}, ";        
    }
    $ChartProductoVendido = substr($ChartProductoVendido, 0);

    //Grafico de marcas en inventario
    $consulta9 = $db->connect()->prepare('SELECT Marca, SUM(Existencias) AS Existencias, TipoProducto FROM t_inventario 
        INNER JOIN t_tipo_marca ON t_tipo_marca.IDMarca = t_inventario.IDMarca
        INNER JOIN t_tipo_producto ON t_tipo_producto.IDTipoProducto = t_inventario.IDTipoProducto
        WHERE TipoProducto="SmartPhone"
        GROUP BY Marca');
    $consulta9->execute();
    $ChartMarcasInventario = '';
    while($row=$consulta9->fetch()){
        $ChartMarcasInventario .= '{label:"'.$row["Marca"].'",value:'.$row["Existencias"]."}, ";        
    }
    $ChartMarcasInventario = substr($ChartMarcasInventario, 0);

    //Grafico de productos en inventario
    $consulta10 = $db->connect()->prepare('SELECT Producto, SUM(Existencias) AS Existencias, TipoProducto FROM t_inventario 
        INNER JOIN t_tipo_producto ON t_tipo_producto.IDTipoProducto = t_inventario.IDTipoProducto
        WHERE TipoProducto = "SmartPhone"
        GROUP BY Producto');
    $consulta10->execute();
    $ChartProductoInventario = '';
    while($row=$consulta10->fetch()){
        $ChartProductoInventario .= '{label:"'.$row["Producto"].'",value:'.$row["Existencias"]."}, ";        
    }
    $ChartProductoInventario = substr($ChartProductoInventario, 0);

    //Grafico de productividad mensual
    $consulta11 = $db->connect()->prepare('SELECT FechaSalida, SUM(TotalVenta) AS TotalVenta, SUM(Ganancia) AS Ganancia FROM t_registro_venta
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        GROUP BY FechaSalida
        ORDER BY FechaSalida ASC
        LIMIT 31');
    $consulta11->execute();
    $ChartProductividadMensual = '';
    while($row=$consulta11->fetch()){
        $ChartProductividadMensual .= '{y:"'.$row["FechaSalida"].'",a:'.$row["TotalVenta"].",b: $row[Ganancia]}, ";  
    }
    $ChartProductividadMensual = substr($ChartProductividadMensual, 0);

    //Ventas del dia es necesario capturar la fecha de america, se uso El Salvador de referencia
    date_default_timezone_set('America/El_Salvador');
    $FechaActual = date("d"); 
    $consulta12 = $db->connect()->prepare('SELECT Nombre,Producto, PrecioVendido, Ganancia FROM t_registro_venta 
        INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
        INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
        INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
        INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
        INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
        INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
        INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago
        WHERE DAY(FechaSalida) = '.$FechaActual.'');
    $consulta12->execute();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Title -->
        <title>Dashboard | D-Cell</title>
        <!-- meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- iconos font awesome y box-icon-->
        <script src="https://kit.fontawesome.com/45e211e073.js" crossorigin="anonymous"></script>
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <!-- Required Fremwork bootstrap 4 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Template -->
        <link rel="stylesheet" href="../styles/css/modulo_admin/graindashboard.css">
        <!-- graficos morris css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <!-- graficos morris js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    </head>

    <body class="has-sidebar has-fixed-sidebar-and-header">

        <!-- Header -->
        <header class="header bg-body">

            <nav class="navbar flex-nowrap p-0">
                <!-- logo PC y mobile -->
                <div class="navbar-brand-wrapper d-flex align-items-center col-auto">
                    <!-- Logo para Mobile  -->
                    <a class="navbar-brand navbar-brand-mobile" href="">
                        <img class="img-fluid w-100" src="../src/logo/D-Cell1280x1280.png" alt="Graindashboard">
                    </a>
                    <!-- End Logo For Mobile View -->

                    <!-- Logo For Desktop View -->
                    <a class="navbar-brand navbar-brand-desktop" href="/">
                        <img class="side-nav-show-on-closed" src="../src/logo/D-Cell1280x1280.png" alt="Graindashboard" style="width: auto; height: 33px;">
                        <img class="side-nav-hide-on-closed" src="../src/logo/D-Cell-Horizontal.png" alt="Graindashboard" style="width: auto; height: 33px;">
                    </a>
                    <!-- End Logo For Desktop View -->
                </div>

                <div class="header-content col px-md-3">
                    <div class="d-flex align-items-center">

                        <!-- Activar y desactivar barra de navegacion Toggle -->
                        <a  class="js-side-nav header-invoker d-flex mr-md-2" href="#"
                            data-close-invoker="#sidebarClose"
                            data-target="#sidebar"
                            data-target-wrapper="body">
                            <!-- <i class='bx bx-menu-alt-left' style="font-size: 30px;"></i> -->
                            <i class='bx bx-menu' style="font-size: 30px;"></i>
                        </a>
                        <!-- fin -->

                        <!-- User Avatar -->
                        <div class="dropdown ml-auto mx-2">
                        
                            <a id="profileMenuInvoker" class="header-complex-invoker" href="#" aria-controls="profileMenu" aria-haspopup="true" aria-expanded="false" data-unfold-event="" data-unfold-target="#profileMenu" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                                <!-- <img class="avatar rounded-circle mr-md-2" src="public/img/D-Cell1280x1280.png"> -->
                                <!-- <span class="mr-md-2 avatar-placeholder">J</span> -->
                                <span class="d-none d-md-block"><?php echo $NombreUsuario?></span>     
                                <i class="fas fa-chevron-down ml-2"></i>                           
                            </a>

                            <ul id="profileMenu" class="unfold unfold-user unfold-light unfold-top unfold-centered position-absolute pt-2 pb-1 mt-2 unfold-css-animation unfold-hidden fadeOut" aria-labelledby="profileMenuInvoker" style="animation-duration: 300ms;">
                            
                                <li class="unfold-item">
                                    <a class="unfold-link d-flex align-items-center text-nowrap" href="#">
                                        <span class="unfold-item-icon mr-3">
                                            <i class='bx bxs-user' style="font-size: 18px;"></i>
                                        </span>
                                        Mi perfil
                                    </a>
                                </li>

                                <li class="unfold-item unfold-item-has-divider">
                                    <a class="unfold-link d-flex align-items-center text-nowrap" href="../modulo_user_control/logout.php">
                                        <span class="unfold-item-icon mr-3">
                                            <i class='bx bx-exit'style="font-size: 18px;"></i>
                                        </span>
                                        Cerrar sesión
                                    </a>
                                </li>

                            </ul>

                        </div>
                        <!-- End User Avatar -->

                    </div>
                </div>

            </nav>

        </header>
        <!-- End Header -->

        <main class="main">

            <!-- barra de navegacion -->
            <aside id="sidebar" class="js-custom-scroll side-nav">
                <ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
                    <!-- Title -->
                    <li class="sidebar-heading h6">Dashboard</li>
                    <!-- End Title -->

                    <!-- Dashboard -->
                    <li class="side-nav-menu-item active">
                        <a class="side-nav-menu-link media align-items-center" href="">
                            <span class="side-nav-menu-icon d-flex mr-3">
                                <i class="fas fa-chart-pie"></i>
                            </span>
                            <span class="side-nav-fadeout-on-closed media-body">Dashboard</span>
                        </a>
                    </li>
                    <!-- End Dashboard -->
    
                    <!-- Title -->
                    <li class="sidebar-heading h6">Productos</li>
                    <!-- End Title -->

                    <!-- Ventas -->
                    <li class="side-nav-menu-item side-nav-has-menu" >

                        <a class="side-nav-menu-link media align-items-center" href="#" data-target="#Ventas">
                            <span class="side-nav-menu-icon d-flex mr-3">
                                <i class="fab fa-shopify"></i>
                            </span>
                            <span class="side-nav-fadeout-on-closed media-body">Ventas</span>
                            <span class="side-nav-control-icon d-flex">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                            <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
                        </a>
    
                        <ul id="Ventas" class="side-nav-menu side-nav-menu-second-level mb-0">
                            <li class="side-nav-menu-item">
                                <a class="side-nav-menu-link" href="Realizar_venta/Venta_producto.php">Realizar venta</a>
                            </li>
                            <li class="side-nav-menu-item">
                                <a class="side-nav-menu-link" href="Registro_ventas/Registro_venta.php">Registro de ventas</a>
                            </li>
                        </ul>

                    </li>
                    <!-- Fin ventas -->

                    <!-- Inventario -->
                    <li class="side-nav-menu-item">
                        <a class="side-nav-menu-link media align-items-center" href="Administrar_inventario/Inventario.php">
                            <span class="side-nav-menu-icon d-flex mr-3">
                                <i class="fas fa-boxes"></i>
                            </span>
                            <span class="side-nav-fadeout-on-closed media-body">Inventario</span>
                        </a>
                    </li>
                    <!-- Fin Inventario -->

                     <!-- Title -->
                     <li class="sidebar-heading h6">Tipos</li>
                     <!-- End Title -->

                    <!-- Tipos -->
                    <li class="side-nav-menu-item side-nav-has-menu">

                        <a class="side-nav-menu-link media align-items-center" href="#" data-target="#Tipos">
                            <span class="side-nav-menu-icon d-flex mr-3">
                                <i class="fas fa-flag"></i>
                            </span>
                                <span class="side-nav-fadeout-on-closed media-body">Tipos</span>
                                <span class="side-nav-control-icon d-flex">
                                <i class="fas fa-chevron-right"></i>

                            </span>
                            <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
                        </a>

                        <!-- Users: subUsers -->
                        <ul id="Tipos" class="side-nav-menu side-nav-menu-second-level mb-0">
                            <li class="side-nav-menu-item">
                                <a class="side-nav-menu-link" href="Administrar_tipo_producto/Tipo_producto.php">Tipo de productos</a>
                            </li>
                            <li class="side-nav-menu-item">
                                <a class="side-nav-menu-link" href="Administrar_tipo_marcas/Marcas.php">Tipo de marcas</a>
                            </li>
                            <li class="side-nav-menu-item">
                                <a class="side-nav-menu-link" href="Administrar_tipo_pago/Tipo_pago.php">Tipo de pagos</a>
                            </li>
                        </ul>
                        <!-- End Users: subUsers -->
                    </li>
                    <!-- Fin tipos -->

                    <!-- Title -->
                    <li class="sidebar-heading h6">Proveedores</li>
                    <!-- End Title -->

                    <!-- provedores -->
                    <li class="side-nav-menu-item">
                        <a class="side-nav-menu-link media align-items-center" href="Administrar_provedores/Provedor.php">
                        <span class="side-nav-menu-icon d-flex mr-3">
                            <i class="fas fa-truck"></i>
                        </span>
                            <span class="side-nav-fadeout-on-closed media-body">Proveedores</span>
                        </a>
                    </li>
                    <!-- Fin provedores -->

                </ul>
            </aside>
            <!-- fin barra de navegacion -->

            <!-- contenido de pagina -->
            <div class="content">

                <!-- pagina -->
                <div class="py-4 px-3 px-md-4">

                    <!-- titulo de pagina -->
                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0" style="cursor: default;">Dashboard</div>
                        <!-- <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            </ol>
                        </nav> -->
                    </div>

                    <!-- detalles de efectivo -->
                    <div class="row">
                        <!-- TotalVendido -->
                        <div class="col-lg-6 col-xl-6 mb-6 mb-xl-6">
                            <!-- Widget -->
                            <div class="card flex-row align-items-center p-3 p-md-4">
                                <div class="icon icon-lg bg-soft-success rounded-circle mr-3">
                                    <i class="fas fa-dollar-sign icon-text d-inline-block text-success" style="font-size: 25px;"></i>
                                </div>

                                <div>
                                    <h4 class="lh-1 mb-1">Total vendido</h4>
                                    <h6 class="mb-0">
                                        <?php
                                            while($row=$consulta1->fetch()){
                                            echo $row['R_TotalVenta'];
                                        }
                                        ?>
                                    </h6>
                                </div>
                                <!-- <i class="gd-arrow-up icon-text d-flex text-primary ml-auto"></i> -->
                            </div>
                            <!-- End Widget -->
                        </div>
                        
                        <!-- TotalGanancia -->
                        <div class="col-lg-6 col-xl-6 mb-6 mb-xl-6">
                            <!-- Widget -->
                            <div class="card flex-row align-items-center p-3 p-md-4">
                                <div class="icon icon-lg bg-soft-success rounded-circle mr-3">
                                    <i class="fas fa-dollar-sign icon-text d-inline-block text-success" style="font-size: 25px;"></i>
                                </div>
                                <div>
                                    <h4 class="lh-1 mb-1">Ganancias</h4>
                                    <h6 class="mb-0">
                                        <?php
                                            while($row=$consulta2->fetch()){
                                            echo $row['R_TotalGanancia'];
                                            }
                                        ?>
                                    </h6>
                                </div>
                                <!-- <i class="gd-arrow-up icon-text d-flex text-secondary ml-auto"></i> -->
                            </div>
                            <!-- End Widget -->
                        </div>

                        <!-- TotalVendidoSmartPhones -->
                        <div class="col-lg-6 col-xl-6 mb-6 mb-xl-6">
                            <!-- Widget -->
                            <div class="card flex-row align-items-center p-3 p-md-4">
                                <div class="icon icon-lg bg-soft-success rounded-circle mr-3">
                                    <i class="fas fa-dollar-sign icon-text d-inline-block text-success" style="font-size: 25px;"></i>
                                </div>
                                <div>
                                    <h4 class="lh-1 mb-1">Total venta smartphone</h4>
                                    <h6 class="mb-0">
                                        <?php
                                            while($row=$consulta13->fetch()){
                                            echo $row['TotalVentaSmartPhone'];
                                            }
                                        ?>
                                    </h6>
                                </div>
                                <!-- <i class="gd-arrow-up icon-text d-flex text-secondary ml-auto"></i> -->
                            </div>
                            <!-- End Widget -->
                        </div>

                        <!-- TotalGananciaSmartPhones -->
                        <div class="col-lg-6 col-xl-6 mb-6 mb-xl-6">
                            <!-- Widget -->
                            <div class="card flex-row align-items-center p-3 p-md-4">
                                <div class="icon icon-lg bg-soft-success rounded-circle mr-3">
                                    <i class="fas fa-dollar-sign icon-text d-inline-block text-success" style="font-size: 25px;"></i>
                                </div>
                                <div>
                                    <h4 class="lh-1 mb-1">Total ganancia smartphone</h4>
                                    <h6 class="mb-0">
                                        <?php
                                            while($row=$consulta14->fetch()){
                                                echo $row['TotalGananciaSmartPhones'];
                                            }
                                        ?>
                                    </h6>
                                </div>
                                <!-- <i class="gd-arrow-up icon-text d-flex text-secondary ml-auto"></i> -->
                            </div>
                            <!-- End Widget -->
                        </div>
                        
                        <!-- TotalVendidoAccesorios -->
                        <div class="col-lg-6 col-xl-6 mb-6 mb-xl-6">
                            <!-- Widget -->
                            <div class="card flex-row align-items-center p-3 p-md-4">
                                <div class="icon icon-lg bg-soft-success rounded-circle mr-3">
                                    <i class="fas fa-users icon-text d-inline-block text-success" style="font-size: 25px;"></i>
                                </div>
                                <div>
                                    <h4 class="lh-1 mb-1">Total venta accesorio</h4>
                                    <h6 class="mb-0">
                                        <?php
                                            while($row=$consulta15->fetch()){
                                            echo $row['TotalVentaAccesorios'];
                                            }
                                        ?>
                                    </h6>
                                </div>
                                <!-- <i class="gd-arrow-up icon-text d-flex text-warning ml-auto"></i> -->
                            </div>
                            <!-- End Widget -->
                        </div>

                        <!-- TotalGananciaAccesorios -->
                        <div class="col-lg-6 col-xl-6 mb-6 mb-xl-6">
                            <!-- Widget -->
                            <div class="card flex-row align-items-center p-3 p-md-4">
                                <div class="icon icon-lg bg-soft-success rounded-circle mr-3">
                                    <i class="fas fa-users icon-text d-inline-block text-success" style="font-size: 25px;"></i>
                                </div>
                                <div>
                                    <h4 class="lh-1 mb-1">Total ganancia accesorio</h4>
                                    <h6 class="mb-0">
                                        <?php
                                            while($row=$consulta16->fetch()){
                                            echo $row['TotalGananciaAccesorios'];
                                            }
                                        ?>
                                    </h6>
                                </div>
                                <!-- <i class="gd-arrow-up icon-text d-flex text-warning ml-auto"></i> -->
                            </div>
                            <!-- End Widget -->
                        </div>



                    </div>
                    <!-- fin detalles efectivo -->

                    <!-- detalles de ventas -->
                    <div class="row">

                        <!-- Producto mas vendido -->
                        <div class="col-lg-6 mb-3 mb-xl-4">
                            <div class="card mat-clr-stat-card text-white green">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-3 text-center bg-c-green">
                                            <i class="fas fa-star mat-icon f-28" style="font-size: 40px;"></i>
                                        </div>
                                        <div class="col-9 cst-cont">
                                            <h3>-
                                                <?php
                                                    while($row=$consulta4->fetch()){
                                                        echo $row['Producto'];
                                                    }
                                                ?>
                                            </h3>
                                            <p class="m-b-0">Top producto mas vendido</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mejor cliente -->
                        <div class="col-lg-6 mb-3 mb-xl-4">
                            <div class="card mat-clr-stat-card text-white green">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-3 text-center bg-c-green">
                                            <i class="fas fa-trophy mat-icon f-28" style="font-size: 40px;"></i>
                                        </div>
                                        <div class="col-9 cst-cont">
                                            <h3>-
                                                <?php
                                                    while($row=$consulta5->fetch()){
                                                        echo $row['Nombre'];
                                                    }
                                                ?>
                                            </h3>
                                            <p class="m-b-0">Top comprador</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mejor empleado -->
                        <div class="col-lg-12 mb-3 mb-xl-4">
                            <div class="card mat-clr-stat-card text-white blue">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-3 text-center bg-c-blue">
                                            <i class="fas fa-trophy mat-icon f-28" style="font-size: 40px;"></i>
                                        </div>
                                        <div class="col-9 cst-cont">
                                            <h3>-
                                                <?php
                                                    while($row=$consulta6->fetch()){
                                                        echo $row['Nombre'];
                                                    }
                                                ?>
                                            </h3>
                                            <p class="m-b-0">Top Empleado</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- fin detalles de ventas -->

                    <!-- graficos -->
                    <div class="row">

                        <!-- grafico de marcas mas vendidas -->
                        <div class="col-lg-6 text-center mb-3 mb-xl-4">
                            <div class="card" style="align-items: center;">
                                <div class="card-block">
                                    <h1>Marcas de smartphone más vendidas</h1>
                                    <div id="ChartMarcasVendidas" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- grafico de productos mas buscado -->
                        <div class="col-lg-6 text-center mb-3 mb-xl-4">
                            <div class="card" style="align-items: center;">
                                <div class="card-block">
                                    <h1>Productos de smartphone más buscado</h1>
                                    <div id="ChartProductoVendido" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- grafico de productividad mensual -->
                        <div class="col-lg-12 text-center mb-3 mb-xl-4">
                            <div class="card" style="align-items: center;">
                                <h1>Productividad mensual</h1>
                                <div id="Productividad" style="width: 100%;"></div>

                            </div>
                        </div>

                        <!-- grafico de marcas en inventario -->
                        <div class="col-lg-6 text-center mb-3 mb-xl-4">
                            <div class="card" style="align-items: center;">
                                <div class="card-block">
                                    <h1>Marcas de smartphone en inventario</h1>
                                    <div id="ChartMarcasInventario" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- grafico de tipo de producto en inventario -->
                        <div class="col-lg-6 text-center mb-3 mb-xl-4">
                            <div class="card" style="align-items: center;">
                                <div class="card-block">
                                    <h1>Producto de smartphone en inventario</h1>
                                    <div id="ChartProductoInventario" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- fin graficos -->
                    
                    <!-- ultimos productos vendidos -->
                    <div class="row">
                        <div class="col-lg-12 mb-3 mb-xl-4">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Productos vendidos hoy</h5>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">

                                        <table class="table table-hover m-b-0 without-header">
                                            <tbody>
                                                
                                                <?php 
                                                while($row=$consulta12->fetch()){
                                                ?>

                                                <tr>
                                                    <td>
                                                        <div class="d-inline-block align-middle">
                                                            <div class="d-inline-block">
                                                                <h6><?php echo $row['Producto']; ?></h6>
                                                                <p class="text-muted m-b-0"><?php echo $row['Nombre']; ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <h6 class="f-w-700"><?php echo $row['PrecioVendido']; ?><i class="fas fa-level-up-alt text-c-green m-l-10"></i></h6>
                                                    </td>
                                                </tr>

                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin de ultimos productos vendidos -->
                    
                </div>

                <!-- Footer -->
                <footer class="small p-4 px-md-4 mt-auto">
                    
                    <div class="row justify-content-between">
                        <div class="col-lg text-center text-lg-left mb-3 mb-lg-0">
                            <ul class="list-dot list-inline mb-0">
                                <li class="list-dot-item list-inline-item mr-lg-2"><a class="link-dark" href="#">Soporte</a></li>
                                <li class="list-dot-item list-inline-item mr-lg-2"><a class="link-dark" href="#">Contactame</a></li>
                            </ul>
                        </div>

                        <div class="col-lg text-center mb-3 mb-lg-0">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="fab fa-instagram"></i></a></li>                                
                                <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="fab fa-whatsapp"></i></a></li>                                
                            </ul>
                        </div>

                        <div class="col-lg text-center text-lg-right">
                            &copy; 2021 D-Cell
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>

        </main>

    </body>

    <script src="../styles/js/modulo_admin/graindashboard.js"></script>
    <script src="../styles/js/modulo_admin/graindashboard.vendor.js"></script>

    <!-- Grafico de marcas mas vendidas -->
    <script>
            new Morris.Donut({
                // ID of the element in which to draw the chart.
                element: 'ChartMarcasVendidas',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data:[<?php echo $ChartMarcasVendidas; ?>],
                //colores
                colors: ['#3D9CDD', '#79BBE7', '#ADD6F1'],                                                      
                //respinsive
                resize: true,
            });       
    </script>

    <!-- Grafico de producto mas buscado -->
    <script>
        new Morris.Donut({
            // ID of the element in which to draw the chart.
            element: 'ChartProductoVendido',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data:[<?php echo $ChartProductoVendido; ?>],        
            colors: ['#33D176', '#65DC98', '#9FE9BF'],                                                      
            //respinsive
            resize: true,
        });            
    </script>

    <!-- grafico de productividad mensual -->
    <script>
        Morris.Line({
            element: 'Productividad',
            data:[<?php echo $ChartProductividadMensual; ?>],        

            xkey: 'y',
            xLabels: "day",
            ykeys: ['a', 'b'],
            labels: ['Total venta', 'Ganancia']

        });
    </script>

    <!-- Grafico de marcas en inventario -->
    <script>
        new Morris.Donut({
            // ID of the element in which to draw the chart.
            element: 'ChartMarcasInventario',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data:[<?php echo $ChartMarcasInventario; ?>],        
            colors: ['#FF7814', '#FFAD70', '#FFEADB'],                                                      
            //respinsive
            resize: true,
        });            
    </script>

    <!-- Grafico de producto en inventario -->
    <script>
        new Morris.Donut({
            // ID of the element in which to draw the chart.
            element: 'ChartProductoInventario',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data:[<?php echo $ChartProductoInventario; ?>],        
            colors: ['#B014FF', '#CF70FF', '#F3DBFF'],                                                      
            //respinsive
            resize: true,
        });            
    </script>



</html>