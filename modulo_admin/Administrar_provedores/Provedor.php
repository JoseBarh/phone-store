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

        <form action="Guardar_provedor.php" method="POST" id="form">

            <!-- titulo -->
            <p class="Titulo">Registrar proveedor</p>

            <!-- fila contenedor de campos -->
            <div class="row justify-content-md-center">

                <!-- primer fila -->
                <div class="col-md-4 col-sm-3 columna">
                    <div class="Empresa">
                        <input type="text" name="Empresa" placeholder="Nombre de empresa">Empresa
                    </div>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <div class="RTN">
                        <input type="text" name="RTN" placeholder="RTN de empresa" onkeypress="return soloNumeros(event)">RTN
                    </div>
                </div>
                

                <div class="col-md-4 col-sm-3 columna">
                    <div class="Telefono">
                        <input type="text" name="Telefono" placeholder="Telefono de empresa" onkeypress="return soloNumeros(event)">Telefono
                    </div>
                </div>

                <!-- Segunda fila -->

                <div class="col-md-4 col-sm-3 columna">
                    <div class="Direccion">
                        <input type="text" name="Direccion" placeholder="Direccion de empresa">Dirección
                    </div>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <div class="Correo">
                        <input type="text" name="Correo" placeholder="Correo de empresa">Correo
                    </div>
                </div>

                <div class="col-md-4 col-sm-3 columna">
                    <div class="SitioWeb">
                        <input type="text" name="SitioWeb" placeholder="Sitio Web de empresa">Sitio web
                    </div>
                </div>

            </div>

            <!-- fila de botones -->
            <div class="row justify-content-md-center">
                <a style="cursor: pointer;" class="btn_registrar" onclick="document.forms['form'].submit()">Registrar</a>
            </div>

            <!-- fila de tabla -->
            <div class="contenedor_tabla">

                <!-- tabla -->
                <table id="tabla" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Provedor</th>
                            <th>Empresa</th>
                            <th>RTN</th>
                            <th>Telefono</th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th>Sitio web</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <!-- Filas para mostrar -->
                                    <!-- realizamos una consulta con un while  -->
                                    <?php 
                                    include_once '../../db/database.php';

                                    $db = new Database();
                                    $consulta = $db->connect()->prepare('SELECT * FROM t_provedor');
                                    $consulta->execute();
                                    while($row=$consulta->fetch()){
                                        ?>
                                        <!-- Imprime la informacion obtenida en la tabla -->
                                        <tr>
                                            <td><?php echo $row['IDProvedores']?></td>
                                            <td><?php echo $row['Empresa']?></td>
                                            <td><?php echo $row['RTN']?></td>
                                            <td><?php echo $row['Telefono']?></td>
                                            <td><?php echo $row['Direccion']?></td>
                                            <td><?php echo $row['Correo']?></td>
                                            <td><?php echo $row['SitioWeb']?></td>

                                            <td><a class="btn btn-primary " href="Modificar_provedor.php?IDProvedor=<?php echo $row['IDProvedores'];?>">Modificar</a></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                    </tbody>
                </table>
            
            </div>

		</form>


    </div>

</body>

<!-- Validaciones -->
<script src="../../styles/js/modulo_admin/Validaciones.js"></script>
<!-- script para tabledata -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
     
        $('#tabla').DataTable({
            //filtrado de busqueda 
            "search": {
                // caseInsensitive coincidencia entre minusculas y mayusculas
                "caseInsensitive": false,
                // Realiza busquedas inteligente mas exactas evita la sugerencia de relaciones
                "smart": false,
            }
        })

    } );
</script>

</html>