<?php 

    include_once '../db/database.php';

    $db = new Database();
    $consulta = $db->connect()->prepare('SELECT * FROM t_inventario');
    $consulta->execute();

    $total=$consulta->rowCount();//cuenta las filas de la consulta


    $cantidad=15; //Cantidad de productos por pagina
    $pagina=ceil($total/$cantidad);

    if(!$_GET){
       header('location: catalogo.php?pag=1');
    }


    //Consulta con limite de productos por pagina
    $limite_inicial=($_GET['pag']-1)*$cantidad; //formula para calcular el limite donde empieza

    $sql="SELECT * FROM `t_inventario` LIMIT :inicio, :final";
    $Resultado_inventario=$db->connect()->prepare($sql);
    $Resultado_inventario->bindParam(':inicio',$limite_inicial, PDO::PARAM_INT);//limite inicial en la consulta
    $Resultado_inventario->bindParam(':final',$cantidad, PDO::PARAM_INT);//limite final en la consulta
    $Resultado_inventario->execute();

    $datos_inventario=$Resultado_inventario->fetchAll();//arreglo de productos encontrados


?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dcell SB</title>
        
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        
        <!-- google fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap">

        <!-- Para iconos externos en boxicon -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- libreria para el diseno de la barra de navegacion principal-->
        <link rel="stylesheet" href="../styles/css/header.css">

        <!-- style body de catalogo -->
        <link rel="stylesheet" href="../styles/css/modulo_user/body-catalogo.css">

        <!-- style para paginacion -->
        <link rel="stylesheet" href="../styles/css/paginacion.css">

        <!-- aqui comenzamos a enlazar los footers -->
        <link rel="stylesheet" href="../styles/css/stick-footer.css">
        <link rel="stylesheet" href="../styles/css/footer.css">

    </head>

    <!-- header para navegacion en pagina -->
    <header class="Contenedor header">

        <!-- header principal de registro -->
        <nav class="navbar-top">

            <ul class="navbar-top-ul">

                <li class="navbar-top-item">
                    <a href="modulo_usuario/registro.php" class="navbar-top-links"> <i class='bx bxl-facebook bx-sm'></i> </a>
                </li>

                <li class="navbar-top-item">
                    <a href="modulo_usuario/login.php" class="navbar-top-links"> <i class='bx bxl-instagram bx-sm' ></i> </a>
                </li>
                
                <li class="navbar-top-item">
                    <a href="modulo_usuario/login.php" class="navbar-top-links"> <i class='bx bxl-whatsapp bx-sm'></i> </a>
                </li>
                
                <li class="navbar-top-item">
                    <a href="modulo_usuario/login.php" class="navbar-top-links"> <i class='bx bx-map bx-sm'></i> </a>
                </li>
                
                <li class="navbar-top-item">
                    <a href="modulo_usuario/login.php" class="navbar-top-links"> <i class='bx bx-envelope bx-sm'></i> </a>
                </li>

            </ul>

        </nav>

        <!-- header secundario de navegacion -->
        <nav class="navbar">

            <!-- header de celular -->
            <header class="nabvar-mobile">
                <a class="navbar-mobile-link" href="index.html">D-Cell SB</a>
                <div>
                    <a class="navbar-mobile-link" id="btn-mobile"><i class='bx bx-menu'></i></a>
                </div>
                <!-- nombre de tienda en celular -->
            </header>

            <!-- header de computadora -->
            <nav class="nav-menu" id="mySidenav">

                <!-- nombre de tienda en computadora -->
                <div class="contenedor-logo-encabezado">
                    <!-- <a class="is-hidden-mobile brand is-uppercase has-text-weight-bold" href="index.html">D-Cell Santa Barbara</a> -->
                    <a class="brand" href="index.html">D-Cell Santa Barbara</a>
                </div>

                <!-- aqui comienza las opciones de navegacion -->
                <ul class="nav-menu-ul">

                    <!-- Smartphones -->
                    <li class="nav-menu-item" id="Smartphones">
                        <a class="nav-menu-link link-submenu" href="#">Smartphones</a>
                        <!-- submenu de Smartphones     -->
                        <div class="container-sub-menu">

                            <!-- Primer columna de marcas -->
                            <ul class="sub-menu-ul">
                                <li class="nav-menu-li ">
                                    <a class="nav-menu-link" href="#">
                                        <strong>Vista general</strong>
                                    </a>
                                    <ul class="sub-menu-ul">
                                        <li><a class="nav-menu-link" href="#">Blu</a></li>
                                        <li><a class="nav-menu-link" href="#">Bmobile</a></li>
                                        <li><a class="nav-menu-link" href="#">HTC</a></li>
                                        <li><a class="nav-menu-link" href="#">Huawei</a></li>
                                        <li><a class="nav-menu-link" href="#">Hyundai</a></li>
                                        <li><a class="nav-menu-link" href="#">Iphone</a></li>
                                        <li><a class="nav-menu-link" href="#">Lg</a></li>
                                        <li><a class="nav-menu-link" href="#">Blackberry</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- Segunda columna de marcas -->
                            <ul class="sub-menu-ul">
                                <li class="nav-menu-li">
                                    <ul class="sub-menu-ul">
                                        <li><a class="nav-menu-link" href="#">Motorola</a></li>
                                        <li><a class="nav-menu-link" href="#">Samsung</a></li>
                                        <li><a class="nav-menu-link" href="#">Xiami</a></li>
                                        <li><a class="nav-menu-link" href="#">ZTE</a></li>
                                        <li><a class="nav-menu-link" href="#">Lenovo</a></li>
                                        <li><a class="nav-menu-link" href="#">Sony</a></li>
                                        <li><a class="nav-menu-link" href="#">Nokia</a></li>
                                        <li><a class="nav-menu-link" href="#">Microsoft</a></li>
                                        <li><a class="nav-menu-link" href="#">Asus</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- Tercer columna de marcas -->
                            <ul class="sub-menu-ul">
                                <li class="nav-menu-li">
                                    <ul class="sub-menu-ul">
                                        <li><a class="nav-menu-link" href="#">Prueba</a></li>
                                        <li><a class="nav-menu-link" href="#">Prueba</a></li>
                                        <li><a class="nav-menu-link" href="#">Prueba</a></li>
                                        <li><a class="nav-menu-link" href="#">Prueba</a></li>
                                        <li><a class="nav-menu-link" href="#">Prueba</a></li>
                                        <li><a class="nav-menu-link" href="#">Prueba</a></li>
                                        <li><a class="nav-menu-link" href="#">Prueba</a></li>
                                        <li><a class="nav-menu-link" href="#">Prueba</a></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </li>

                    <!-- Accesorios -->
                    <li class="nav-menu-item" id="Accesorios">
                        <a class="nav-menu-link link-submenu" href="#">Accesorios</a>
                        <!-- submenu de Accesorios -->
                        <div class="container-sub-menu2">

                            <!-- Primer columna de accesorios -->
                            <ul class="sub-menu-ul">
                                <li class="nav-menu-li ">
                                    <a class="nav-menu-link" href="#">
                                        <strong>Vista general</strong>
                                    </a>
                                    <ul class="sub-menu-ul">
                                        <li><a class="nav-menu-link" href="#">Cargadores</a></li>
                                        <li><a class="nav-menu-link" href="#">Cables USB</a></li>
                                        <li><a class="nav-menu-link" href="#">Cobertores</a></li>
                                        <li><a class="nav-menu-link" href="#">Auriculares</a></li>
                                        <li><a class="nav-menu-link" href="#">Cascos</a></li>
                                        <li><a class="nav-menu-link" href="#">Memorias</a></li>
                                        <li><a class="nav-menu-link" href="#">Vocinas</a></li>
                                    </ul>
                                </li>
                            </ul>


                        </div>
                    </li>

                    <!-- Smartwatch -->
                    <li class="nav-menu-item"><a href="brand.html" class="nav-menu-link">Smartwatch</a></li>
                    <!-- cerrar sesion -->
                    <li class="nav-menu-item"><a href="modulo_user_control/logout.php" class="nav-menu-link">cerrar sesion</a></li>
                </ul>

            </nav>

        </nav>

    </header>

    <body>

   
        <!-- catalogo de productos -->
        <section class="Container_productos">

            <div class="row_body fila_body">

                <!-- Comenzamos foreach -->
                <?php 
                    foreach($datos_inventario as $datos){
                ?>

                    <!-- primer columna  -->
                    <a class="columna_body" href="">

                        <div class="img_body">
                            <img style="width:100px;" src="data:image/jpg; base64,<?=base64_encode($datos['FotoProducto']);?>" alt="">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $datos['Producto']?></h5>
                            <p class="card-text">Lps. <?= $datos['PrecioVenta']?></p>

                            <?$datos['Existencias']?>
                            
                            <?php
                            if ($datos>0){
                                echo'<p class="card-text">Disponible</p>';
                            }else{
                                echo'<p class="card-text">Agotado</p>'; 
                            }
                            ?>

                        </div>

                    </a>
                
                    <!-- terminamos foreach -->
                <?php 
                    } 
                ?>

            </div>

        </section>

        <!-- paginacion de productos -->
        <section class="paginador">
            <!-- Paginador -->
            <nav>

                <ul class="pagination pagination-circle">

                    <li class="page-item <?php echo $_GET['pag']==1 ? 'invisible': '' ?>">
                        <a class="page-link" href="catalogo.php?pag=<?=$_GET['pag']-1; ?>" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>

                    <?php

                    for($i=1;$i<=$pagina;$i++){?>

                    <li class="page-item <?php echo $_GET['pag']==$i ? 'active': '' ?> ">
                        <a class="page-link " href="catalogo.php?pag=<?= $i ?>"><?= $i ?></a>
                    </li>

                    <?php } ?>

                    <li class="page-item <?php echo $_GET['pag']==$pagina ? 'invisible': '' ?> ">
                        <a class="page-link " href="catalogo.php?pag=<?=$_GET['pag']+1; ?>">Siguiente</a>
                    </li>

                </ul>

            </nav>
        </section>


    </body>

    <footer class="footer">

        <div class="contenedor-logo">


            <div class="logo">
                <label class="logo-text">D-Cell Santa Barbara</label>
            </div>

        </div>

        <ul class="r-footer">
            <!-- columna 0 -->
            <li class="columna">
                <h2 class="Titulo">Productos</h2>
                <ul class="box">
                    <li><a href="#">Accesorios</a></li>
                    <li><a href="#">Consolas</a></li>
                    <li><a href="#">Smartphones</a></li>
                    <li><a href="#">Smartwatch</a></li>
                </ul>
            </li>
            <!-- columna 1 -->
            <li class="columna">
                <h2 class="Titulo">Servicios</h2>
                <ul class="box">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Contract</a></li>
                </ul>
            </li>
            <!-- columna 2 -->
            <li class="columna">
                <h2 class="Titulo">Privacidad</h2>
                <ul class="box">
                    <li><a href="#">Privacidad</a></li>
                    <li><a href="#">Terminos de uso</a></li>
                </ul>
            </li>
            <!-- COLUMNA 3 -->
            <li class="columna">
                <h2 class="Titulo">Cuenta</h2>
                <ul class="box">
                    <li><a href="#">Iniciar sesión</a></li>
                    <li><a href="#">Registrarse</a></li>
                    <li><a href="#">Seguridad</a></li>
                    <li><a href="#">Olvide mi clave</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>
            <!-- columna 1 -->
            <li class="columna">
                <h2 class="Titulo">Garantia</h2>
                <ul class="box">
                    <li><a href="#">Terminos de uso</a></li>
                    <li><a href="#">Condiciones</a></li>
                    <li><a href="#">Mas detalles</a></li>
                </ul>
            </li>
            <!-- columna 2 -->
            <li class="columna">
                <h2 class="Titulo">Empresa</h2>
                <ul class="box">
                    <li><a href="#">Misión</a></li>
                    <li><a href="#">Visión</a></li>
                    <li><a href="#">Valores</a></li>
                    <li><a href="#">Quienes somos?</a></li>
                </ul>
            </li>
            <!-- COLUMNA 3 -->
            <li class="columna">
                <h2 class="Titulo">Acerca de D-Cell</h2>
                <ul class="box">
                    <li><a href="#">Contactar</a></li>
                    <li><a href="#">Ubicación</a></li>
                </ul>
            </li>
        </ul>

    </footer>

    <footer class="stick">
        <div class="stick-footer">
            Derechos reservados │ Juan José Ordoñez Barahona
        </div>
    </footer>


    <!-- scripts para la seccion de animacion de barra de navegacion mobil menu -->
    <script src="../styles/js/main.js"></script>


</html>