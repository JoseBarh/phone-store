<?php
    // incluimos la base de datos
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
    // en caso de que exista el IDProducto para la venta imprimira el precio del producto en el modal
    if(isset($_GET['IDProducto'])){
        // almacenamos la variable para condicionar en la consulta
        $IDProducto=$_GET['IDProducto'];
        // consulta para dar informacion en los campos del modal
        $db = new Database();
        $consulta = $db->connect()->prepare("SELECT * FROM t_inventario WHERE IDProducto='$IDProducto'");
        $consulta->execute();
        $rowCampos=$consulta->fetch();
        // necesario para luego restar con la cantidad comprada. La enviamos por POST.
        $Existencias=$rowCampos['Existencias'];
        $PrecioCosto=$rowCampos['PrecioCosto'];
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

    <!-- stylo bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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

        <!-- modal large para realizar venta -->
        <div id="ModalVender" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        
            <div class="modal-dialog modal-xl modal-dialog-centered">

                <div class="modal-content">

                    <form action="Vender_producto.php?IDProducto=<?php echo $IDProducto?>&Existencias=<?php echo $Existencias?>&PrecioCosto=<?php echo $PrecioCosto?>" method="POST" id="form">
                   
                        <div class="modal-header">
                            <h5 class="modal-title">Vender <?php echo $rowCampos['Producto']; ?></h5>
                            <a href="Venta_producto.php"><i class='bx bx-x'></i></a>
                        </div>

                        <div class="modal-body">

                            <div class="contenedor-inputs-modal row">

                                <div class="modal-input col-md-3 col-sm-3">
                                    <input name="CantidadVendida" type="text" placeholder="CantidadVendida" value="1">Cantidad de producto a vender
                                </div>

                                <div class="modal-input col-md-3 col-sm-3">
                                    <input name="PrecioVendido" type="text" placeholder="Precio venta" value="<?php echo $rowCampos['PrecioVenta'];?>">Precio venta del producto
                                </div>

                                <div class="modal-input col-md-3 col-sm-3">
                                    <input name="PagoCliente" type="text" placeholder="Pago del cliente">Ingrese pago del cliente
                                </div>

                                <div class="modal-input col-md-3 col-sm-3">
                                    <select name="IDTipoPago">
                                        <option value="0">Selecciona tipo de pago</option>
                                        <?php 
                                            $db = new Database();
                                            $consultaSelect1 = $db->connect()->prepare('SELECT IDTipoPago, TipoPago FROM t_tipo_pago');
                                            $consultaSelect1->execute();
                                            while($row=$consultaSelect1->fetch()){
                                                ?>
                                                    <!-- Imprime la informacion obtenida en el select -->
                                                    <option value="<?php echo $row['IDTipoPago']?>"><?php echo $row['TipoPago']?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <a href="Venta_producto.php" class="btn btn-danger">Cancelar</a>
                            <a style="cursor: pointer; color: white;" class="btn btn-success" onclick="document.forms['form'].submit()">Confirmar venta</a>
                        </div>
                    </form>


                </div>
                
            </div>

        </div>

        <!--  contenedor tabla -->
        <div class="contenedor_tabla">

            <!-- titulo -->
            <p class="Titulo">Vender producto</p>

            <!-- tabla -->
            <table id="tabla" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>IDProducto</th>
                        <!-- No es necesario mostrarle al empleado de donde viene el producto -->
                        <!-- <th>IDProveedor</th> -->
                        <th>IDTipoProducto</th>
                        <th>IDMarca</th>
                        <th>Producto</th>
                        <!-- <th>Fecha entrada</th> -->
                        <!-- No es necesario mostrarle al empleado el precio costo del producto -->
                        <!-- <th>Precio costo</th> -->
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
                                        <!-- No es necesario mostrarle al empleado de donde viene el producto -->
                                        <!-- <td><?php //echo $row['Empresa']?></td> -->
                                        <td><?php echo $row['TipoProducto']?></td>
                                        <td><?php echo $row['Marca']?></td>
                                        <td><?php echo $row['Producto']?></td>
                                        <!-- <td><?php //echo $row['FechaEntrada']?></td> -->
                                        <!-- No es necesario mostrarle al empleado el precio costo del producto -->
                                        <!-- <td><?php //echo $row['PrecioCosto']?></td> -->
                                        <td><?php echo $row['PrecioVenta']?></td>
                                        <td><?php echo $row['Existencias']?></td>
                                        <td><?php echo $row['Detalles']?></td>

                                        <td><a class="btn btn-success" href="?IDProducto=<?php echo $row['IDProducto'];?>" onclick="document.forms['form'].submit()">Vender</a></td>
                                    </tr>

                                    <?php
                                }
                                ?>

                </tbody>
            </table>
            
        
        </div>

    </div>

</body>

<!-- librerias js boostrap para el modal -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- script para tabledata -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

<!-- script necesario para inicializar el modal al encontrar un IDProducto "Al precionar el boton vender" -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- habilitar obciones de DataTable -->
<script>
    $(document).ready(function() {
        
        $('#tabla').DataTable({
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

<!-- cuando exista el IDProducto mostraremos el modal para realizar la venta -->
<?php
    if(isset($_GET['IDProducto'])){
?>
<script>
    (function(){
        $(function(){
            $('#ModalVender').modal()
        });
    }());
</script>
<?php
    }
?>  

</html>