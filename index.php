<?php
    // iniciamos sesion
    session_start();
    //verificamos SINO existe rol o si el rol es distinto a 2 lo reenviamos a login
    if(!isset($_SESSION['IDRol'])){
        header('location: modulo_user_control/login.php');
    }else{
        if($_SESSION['IDRol'] != 2){
            header('location: modulo_user_control/login.php');
        }else if($_SESSION['IDRol'] == 1){
            header('location: modulo_admin/menu.php');
        }
    }
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- google fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap">

        <!-- Para iconos externos en boxicon -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- para el diseno de la barra de navegacion principal-->
        <link rel="stylesheet" href="styles/css/header.css">

        <!-- dise;o swiper css para carousel libreria para del dise;o esta en index-body.css -->
        <link rel="stylesheet" type="text/css" href="styles/css/swiper.lib.css"/>

        <!-- diseno de todo el cuerpo del body en secciones -->
        <link rel="stylesheet" type="text/css" href="styles/css/index-body.css">

        <!-- diseno necesario para la seccion 3 en body -->
        <link rel="stylesheet" type="text/css" href="styles/css/lightslider.css">

        <!-- Jquery necesario para que funcione la seccion 2 en el body -->
        <script type="text/javascript" src="styles/js/Jquery.js"></script>
        <script type="text/javascript" src="styles/js/lightslider.js"></script>

        <!-- aqui comenzamos a enlazar los footers -->
        <link rel="stylesheet" href="styles/css/stick-footer.css">
        <link rel="stylesheet" href="styles/css/footer.css">

        <title>D-Cell SB</title>

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

    <body id="body" style="margin:0;">

        <!-- seccion 1 -->
        <!-- Portada Slide -->
        <section class="Portada">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    
                    <div class="swiper-slide slider-1">
                        <div class="btn">
                            Hola
                        </div>
                    </div>
                    <div class="swiper-slide slider-2">
                        <div class="btn">
                            como estas?
                        </div>
                    </div>
                    
                    <div class="swiper-slide slider-3">
                        <div class="btn">
                            asd
                        </div>
                    </div>
                </div>
                <!-- agregar paginacion (Los 2 o mas puntos que indican donde esta)-->
                <div class="swiper-pagination"></div>
                <!-- Agregar flechas -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <!-- Portada presentacion iphone -->
        <!-- seccion 2 -->
        <section class="section-portada-iphone">

            <div class="Contenedor-PortadaIphone">
                <div class="contenido">
                    <div class="titulo">
                        <h5>Iphone 7</h5><br>
                        <span>Nueva experiencia</span><br> <br>
                    </div>
                    <div class="detalles">
                        <label>Pantalla IPS de 4,7 pulgadas, diseno totalmente nuevo con</label><br>
                        <label>TouchID, resistencia al agua IP67 y una</label><br>
                        <label>bateria de 1.960 mAh</label><br><br>
                        <a href="#" class="btn">Ver mas</a>

                    </div>
                </div>

                <img src="src/img/Portada-Ipone7.jpg" alt="">

            </div>

        </section>

        <!-- seccion 3 -->
        <!-- Slide de los productos -->
        <section class="Productos" id="SlideProductos">

            <div class="slide-producto-contenedor">
                <!-- titulos del contenedor producto -->
                <h5>¿Que celular es el mas adecuado para ti?</h5>
                <h4>
                    <a href="http://" class="link-productos">Ver todos los modelos disponible ></a>
                </h4>

                <ul id="autoWidth" class="cs-hidden">

                    <!-- producto 1------------------------------------>
                    <li class="item-a">
                        <!--box-slider--------------->
                        <div class="box">
                            <!--img-box---------->
                            <div class="slide-img">
                                <img alt="1" src="src/img/1.jpg">
                                <!--overlayer---------->
                                <div class="overlay">
                                    <!--buy-btn------>
                                    <a href="#" class="buy-btn">Agregar a carrito 1</a>
                                </div>
                            </div>
                            <!--detail-box--------->
                            <div class="detail-box">
                                <!--type-------->
                                <div class="type">
                                    <a href="#">Samsung Galaxy S20</a>
                                    <!-- precio oferta o original del producto -->
                                    <div class="contenedor-precios">
                                        <!-- precio oferta -->
                                        <a href="#" class="price">12,700 Lps</a>
                                        <!-- precio original -->
                                        <s href="#" class="price2">14,700 Lps</s>
                                    </div>
                                    <!-- detalles del producto -->
                                    <span>Procesador <label>Snapdragon 720</label></span>
                                    <span>Almacenamiento <label>128GB</label></span>
                                    <span>Memoria RAM <label>6GB</label></span>

                                </div>

                            </div>
                            <!-- botones y enlace de slide producto -->
                            <div class="slideProducto-contenedor-boton">
                                <a href="#" class="btn">Ver mas</a>
                                <a href="http://" class="link-producto">Aprende más..</a>
                            </div>
                        </div>
                    </li>

                    <!-- producto 2------------------------------------>
                    <li class="item-b">
                        <!--box-slider--------------->
                        <div class="box">
                            <!--img-box---------->
                            <div class="slide-img">
                                <img alt="2" src="src/img/2.jpg">
                                <!--overlayer---------->
                                <div class="overlay">
                                    <!--buy-btn------>
                                    <a href="#" class="buy-btn">Agregar a carrito</a>
                                </div>
                            </div>
                            <!--detail-box--------->
                            <div class="detail-box">
                                <!--type-------->
                                <div class="type">
                                    <a href="#">Samsung Galaxy S5</a>
                                    <!-- precios y ofertas del producto -->
                                    <div class="contenedor-precios">
                                        <!-- precio oferta o original -->
                                        <a href="#" class="price">2,700 Lps</a>
                                        <!-- precio original -->
                                        <!-- <a href="#" class="price2">14,700 Lps</a> -->
                                    </div>

                                    <!-- detalles del producto -->
                                    <span>Procesador <label>Snapdragon 720</label></span>
                                    <span>Almacenamiento <label>128GB</label></span>
                                    <span>Memoria RAM <label>6GB</label></span>
                                </div>
                            </div>
                            <!-- botones y enlace de slide producto -->
                            <div class="slideProducto-contenedor-boton">
                                <a href="#" class="btn">Ver mas</a>
                                <a href="http://" class="link-producto">Aprende más..</a>
                            </div>


                        </div>
                    </li>

                    <!-- producto 3------------------------------------>
                    <li class="item-c">
                        <!--box-slider--------------->
                        <div class="box">
                            <!--img-box---------->
                            <div class="slide-img">
                                <img alt="3" src="src/img/3.jpg">
                                <!--overlayer---------->
                                <div class="overlay">
                                    <!--buy-btn------>
                                    <a href="#" class="buy-btn">Agregar a carrito</a>
                                </div>
                            </div>
                            <!--detail-box--------->
                            <div class="detail-box">
                                <div class="type">
                                    <a href="#">Samsung Galaxy S6</a>
                                    <!-- precio oferta o original del producto -->
                                    <div class="contenedor-precios">
                                        <!-- precio oferta -->
                                        <a href="#" class="price">3,400 Lps</a>
                                        <!-- precio original -->
                                        <s href="#" class="price2">3,800 Lps</s>
                                    </div>
                                    <!-- detalles del producto -->
                                    <span>Procesador <label>Snapdragon 720</label></span>
                                    <span>Almacenamiento <label>128GB</label></span>
                                    <span>Memoria RAM <label>6GB</label></span>
                                </div>


                            </div>
                            <!-- botones y enlace de slide producto -->
                            <div class="slideProducto-contenedor-boton">
                                <a href="#" class="btn">Ver mas</a>
                                <a href="http://" class="link-producto">Aprende más..</a>
                            </div>

                        </div>
                    </li>

                    <!-- producto 4------------------------------------>
                    <li class="item-d">
                        <!--box-slider--------------->
                        <div class="box">
                            <!--img-box---------->
                            <div class="slide-img">
                                <img alt="4" src="src/img/4.jpg">
                                <!--overlayer---------->
                                <div class="overlay">
                                    <!--buy-btn------>
                                    <a href="#" class="buy-btn">Agregar a carrito</a>
                                </div>
                            </div>
                            <!--detail-box--------->
                            <div class="detail-box">
                                <div class="type">
                                    <a href="#">Iphone 6</a>
                                    <!-- precio oferta o original del producto -->
                                    <div class="contenedor-precios">
                                        <!-- precio oferta -->
                                        <a href="#" class="price">3500 Lps</a>
                                        <!-- precio original -->
                                        <!-- <s href="#" class="price2">14,700 Lps</s> -->
                                    </div>
                                    <!-- detalles del producto -->
                                    <span>Procesador <label>Snapdragon 720</label></span>
                                    <span>Almacenamiento <label>128GB</label></span>
                                    <span>Memoria RAM <label>6GB</label></span>
                                </div>
                            </div>
                            <!-- botones y enlace de slide producto -->
                            <div class="slideProducto-contenedor-boton">
                                <a href="#" class="btn">Ver mas</a>
                                <a href="http://" class="link-producto">Aprende más..</a>
                            </div>

                        </div>
                    </li>

                    <!-- producto 5------------------------------------>
                    <li class="item-e">
                        <!--box-slider--------------->
                        <div class="box">
                            <!--img-box---------->
                            <div class="slide-img">
                                <img alt="5" src="src/img/5.jpg">
                                <!--overlayer---------->
                                <div class="overlay">
                                    <!--buy-btn------>
                                    <a href="#" class="buy-btn">Agregar a carrito</a>
                                </div>
                            </div>
                            <!--detail-box--------->
                            <div class="detail-box">
                                <div class="type">
                                    <a href="#">Iphone 6S</a>
                                    <!-- precio oferta o original del producto -->
                                    <div class="contenedor-precios">
                                        <!-- precio oferta -->
                                        <a href="#" class="price">4500 Lps</a>
                                        <!-- precio original -->
                                        <!-- <s href="#" class="price2">14,700 Lps</s> -->
                                    </div>
                                    <!-- detalles del producto -->
                                    <span>Procesador <label>Snapdragon 720</label></span>
                                    <span>Almacenamiento <label>128GB</label></span>
                                    <span>Memoria RAM <label>6GB</label></span>
                                </div>
                            </div>
                            <!-- botones y enlace de slide producto -->
                            <div class="slideProducto-contenedor-boton">
                                <a href="#" class="btn">Ver mas</a>
                                <a href="http://" class="link-producto">Aprende más..</a>
                            </div>

                        </div>
                    </li>

                    <!-- producto 6------------------------------------>
                    <li class="item-f">
                        <!--box-slider--------------->
                        <div class="box">
                            <!--img-box---------->
                            <div class="slide-img">
                                <img alt="6" src="src/img/6.jpg">
                                <!--overlayer---------->
                                <div class="overlay">
                                    <!--buy-btn------>
                                    <a href="#" class="buy-btn">Agregar a carrito</a>
                                </div>
                            </div>
                            <!--detail-box--------->
                            <div class="detail-box">
                                <div class="type">
                                    <a href="#">Iphone 7</a>
                                    <!-- precio oferta o original del producto -->
                                    <div class="contenedor-precios">
                                        <!-- precio oferta -->
                                        <a href="#" class="price">6300 Lps</a>
                                        <!-- precio original -->
                                        <!-- <s href="#" class="price2">14,700 Lps</s> -->
                                    </div>
                                    <!-- detalles del producto -->
                                    <span>Procesador <label>Snapdragon 720</label></span>
                                    <span>Almacenamiento <label>128GB</label></span>
                                    <span>Memoria RAM <label>6GB</label></span>
                                </div>

                            </div>
                            <!-- botones y enlace de slide producto -->
                            <div class="slideProducto-contenedor-boton">
                                <a href="#" class="btn">Ver mas</a>
                                <a href="http://" class="link-producto">Aprende más..</a>
                            </div>
                        </div>
                    </li>

                    <!-- producto 7------------------------------------>
                    <li class="item-g">
                        <!--box-slider--------------->
                        <div class="box">
                            <!--img-box---------->
                            <div class="slide-img">
                                <img alt="7" src="src/img/7.jfif">
                                <!--overlayer---------->
                                <div class="overlay">
                                    <!--buy-btn------>
                                    <a href="#" class="buy-btn">Agregar a carrito</a>
                                </div>
                            </div>
                            <!--detail-box--------->
                            <div class="detail-box">
                                <div class="type">
                                    <a href="#">Iphone 7+</a>
                                    <!-- precio oferta o original del producto -->
                                    <div class="contenedor-precios">
                                        <!-- precio oferta -->
                                        <a href="#" class="price">7,700 Lps</a>
                                        <!-- precio original -->
                                        <!-- <s href="#" class="price2">14,700 Lps</s> -->
                                    </div>
                                    <!-- detalles del producto -->
                                    <span>Procesador <label>Snapdragon 720</label></span>
                                    <span>Almacenamiento <label>128GB</label></span>
                                    <span>Memoria RAM <label>6GB</label></span>
                                </div>
                            </div>
                            <!-- botones y enlace de slide producto -->
                            <div class="slideProducto-contenedor-boton">
                                <a href="#" class="btn">Ver mas</a>
                                <a href="http://" class="link-producto">Aprende más..</a>
                            </div>

                        </div>
                    </li>

                    <!-- producto 8------------------------------------>
                    <li class="item-h">
                        <!--box-slider--------------->
                        <div class="box">
                            <!--img-box---------->
                            <div class="slide-img">
                                <img alt="8" src="src/img/8.jfif">
                                <!--overlayer---------->
                                <div class="overlay">
                                    <!--buy-btn------>
                                    <a href="#" class="buy-btn">Agregar a carrito</a>
                                </div>
                            </div>
                            <!--detail-box--------->
                            <div class="detail-box">
                                <div class="type">
                                    <a href="#">Iphone XR</a>
                                    <!-- precio oferta o original del producto -->
                                    <div class="contenedor-precios">
                                        <!-- precio oferta -->
                                        <a href="#" class="price">10,000 Lps</a>
                                        <!-- precio original -->
                                        <!-- <s href="#" class="price2">14,700 Lps</s> -->
                                    </div>
                                    <!-- detalles del producto -->
                                    <span>Procesador <label>Snapdragon 720</label></span>
                                    <span>Almacenamiento <label>128GB</label></span>
                                    <span>Memoria RAM <label>6GB</label></span>
                                </div>
                            </div>
                            <!-- botones y enlace de slide producto -->
                            <div class="slideProducto-contenedor-boton">
                                <a href="#" class="btn">Ver mas</a>
                                <a href="http://" class="link-producto">Aprende más..</a>
                            </div>

                        </div>
                    </li>
                </ul>

            </div>

        </section>

        <!-- seccion 4 -->
        <!-- Portada presentacion Xiaomi -->
        <section>
            <div class="Contenedor-PortadaSamsung">

                <h5 class="titulo">NOTE 10 LITE</h5>
                <h5 class="subtitulo">XIAOMI</h5>
                <a href="http://" class="link-productos">Ver los modelos disponible ></a>

                <div class="Portada-Samsung">
                    <img src="src/img/Samsung A20.png" alt="">
                </div>

        </section>

        <!-- seccion 5 -->
        <!-- Portada consola xbox serie s -->
        <section class="Consolas-de-videojuegos">

            <div class="encabezado">
                <div class="Titulo">
                    <h5>Enciende tus sueños con la nueva generación de consolas</h5>
                </div>
                <div class="subtitulo">
                    <a href="#" class="btn">Ver mas</a>
                    <a href="http://" class="link-producto">Aprende más..</a>
                </div>
            </div>

            <div class="Contenedor-xbox-serie-s">
                <img src="src/img/xbox-serie-S.jpg" alt="">
            </div>

        </section>

        <!-- seccion 6 -->
        <!-- section de accesorios variados -->
        <section class="section-accesorios">

            <div class="contenedor-accesorios">

                <div class="Titulo">
                    <h1>Accesorios</h1>
                </div>

                <div class="row-2">

                    <div class="col-2">
                        <div class="Titulo">
                            <h5>Auriculares inalambricos</h5>
                        </div>
                        <div class="Subtitulo">
                            <a href="#" class="btn">Ver mas</a>
                            <a href="http://" class="link-producto">Aprende más..</a>
                        </div>
                        <div class="IMG">
                            <img src="src/img/Auricular.jpg" alt="">
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="Titulo">
                            <h5>Smart watch</h5>
                        </div>
                        <div class="Subtitulo">
                            <a href="#" class="btn">Ver mas</a>
                            <a href="http://" class="link-producto">Aprende más..</a>
                        </div>
                        <div class="IMG">
                            <img src="src/img/smartwatch.png" alt="">
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="Titulo">
                            <h5>Navaja suiza</h5>
                        </div>
                        <div class="Subtitulo">
                            <a href="#" class="btn">Ver mas</a>
                            <a href="http://" class="link-producto">Aprende más..</a>
                        </div>
                        <div class="IMG">
                            <img src="src/img/navaja-zuisa.jpg" alt="">
                        </div>
                    </div>

                </div>
            </div>
            </div>

        </section>

        <!-- seccion 7 -->
        <!-- section de garantia -->
        <section class="section-garantia">
            <div class="conetendor-garantia">
                <div class="titulo">
                    <h5>Garantia de devolución de dinero en 30 dias</h5>
                </div>
                <div class="subtitulo">
                    <h1>Si no está satisfecho con nuestros servicios por cualquier motivo, le <br>
                        reembolsaremos su pago. Sin problemas, sin riesgo.</h1>
                </div>
                <div class="botones">
                    <a href="#" class="btn">Ver mas</a>
                </div>

            </div>

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
    <script src="styles/js/main.js"></script>
    <!-- scripts para la seccion 1 swiper slider-->
    <script type="text/javascript" src="styles/js/swiper.lib.js"></script>
    <script type="text/javascript" src="styles/js/ActivarSwiperFadeEffect.js"></script>
    <!--scripts para la seccion 2----------->
    <script type="text/javascript" src="styles/js/script.js"></script>
    <!-- Jquery necesario para que funcione la seccion 2 en el body -->
    <script type="text/javascript" src="styles/js/Jquery.js"></script>
    <script type="text/javascript" src="styles/js/lightslider.js"></script>

</html>