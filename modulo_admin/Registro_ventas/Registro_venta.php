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
    
    <!-- iconos font awesome y box-icon-->
    <script src="https://kit.fontawesome.com/45e211e073.js" crossorigin="anonymous"></script>
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
            <p class="Titulo">Registro de ventas</p>

            <!-- tabla -->
            <table id="tabla" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" data-order='[[ 0, "desc" ]]'>
                <thead>
                    <tr>
                        <th>IDVenta</th>
                        <th>Marca</th>
                        <th>Tipo producto</th>
                        <th>Producto</th>
                        <th>Fecha entrada</th>
                        <th>Fecha salida</th>
                        <th>Precio costo</th>
                        <th>Precio venta</th>
                        <th>Existencias</th>
                        <th>Detalles</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Telefono</th>
                        <th>Proveedor</th>
                        <th>Dirección</th>
                        <th>Tipo pago</th>
                        <th>Precio Vendido</th>
                        <th>Cantidad vendida</th>
                        <th>Total venta</th>
                        <th>Pago del cliente</th>
                        <th>Cambio del cliente</th>
                        <th>Ganancia</th>
                        <th>Garantia</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                
                <tbody>
                    <!-- Filas para mostrar -->
                                <!-- realizamos una consulta con un while  -->
                                <?php 
                                include_once '../../db/database.php';

                                $db = new Database();
                                $consulta = $db->connect()->prepare('SELECT IDVentaProducto, t_inventario.IDProducto, Producto, FechaEntrada, PrecioCosto, PrecioVenta, Existencias, Detalles, 
                                IDProvedores, Empresa, t_provedor.Direccion, TipoProducto, Marca, IDUsuarios, Rol, Nombre, t_usuarios.Telefono,
                                TipoPago, FechaSalida, PrecioVendido, CantidadVendida, TotalVenta, PagoCliente, CambioCliente, Ganancia, Garantia 
                                FROM t_registro_venta
                                
                                INNER JOIN t_inventario ON t_inventario.IDProducto = t_registro_venta.IDProducto
                                INNER JOIN t_provedor ON t_inventario.IDProvedor = t_provedor.IDProvedores
                                INNER JOIN t_tipo_producto ON t_inventario.IDTipoProducto = t_tipo_producto.IDTipoProducto
                                INNER JOIN t_tipo_marca ON t_inventario.IDMarca = t_tipo_marca.IDMarca
                                INNER JOIN t_usuarios ON t_usuarios.IDUsuarios = t_registro_venta.IDUsuario
                                INNER JOIN t_roles ON  t_roles.IDRol = t_usuarios.IDRol
                                INNER JOIN t_tipo_pago ON t_tipo_pago.IDTipoPago = t_registro_venta.IDTipoPago');
                                $consulta->execute();
                                while($row=$consulta->fetch()){
                                    ?>
                                    <!-- Imprime la informacion obtenida en la tabla -->
                                    <tr>
                                        <td><?php echo $row['IDVentaProducto']?></td>
                                        <td><?php echo $row['Marca']?></td>
                                        <td><?php echo $row['TipoProducto']?></td>
                                        <td><?php echo $row['Producto']?></td>
                                        <td><?php echo $row['FechaEntrada']?></td>
                                        <td><?php echo $row['FechaSalida']?></td>
                                        <td><?php echo $row['PrecioCosto']?></td>
                                        <td><?php echo $row['PrecioVenta']?></td>
                                        <td><?php echo $row['Existencias']?></td>
                                        <td><?php echo $row['Detalles']?></td>
                                        <td><?php echo $row['Nombre']?></td>
                                        <td><?php echo $row['Rol']?></td>
                                        <td><?php echo $row['Telefono']?></td>
                                        <td><?php echo $row['Empresa']?></td>
                                        <td><?php echo $row['Direccion']?></td>
                                        <td><?php echo $row['TipoPago']?></td>
                                        <td><?php echo $row['PrecioVendido']?></td>
                                        <td><?php echo $row['CantidadVendida']?></td>
                                        <td><?php echo $row['TotalVenta']?></td>
                                        <td><?php echo $row['PagoCliente']?></td>
                                        <td><?php echo $row['CambioCliente']?></td>
                                        <td><?php echo $row['Ganancia']?></td>
                                        <td><?php 
                                        // Calcular si la garantia esta activa
                                        $FechaVenta= $row['FechaSalida'];
                                        $FechaActual = date("y-m-d"); 

                                        $fecha1= new DateTime($FechaVenta);
                                        $fecha2= new DateTime($FechaActual);

                                        $ContadorDias = $fecha1->diff($fecha2);

                                        if($ContadorDias->days>30){
                                            echo ("Garantia vencida dia: ".$ContadorDias->days);
                                        }else{
                                            echo ("Garantia activa dia: ".$ContadorDias->days); 
                                        }
                                        
                                        ?></td>
                                        
                                        <td><a class="btn btn-warning " href="Retorno_venta.php?IDProducto=<?php echo $row['IDProducto'];?>&Existencias=<?php echo $row['Existencias'];?>&CantidadVendida=<?php echo $row['CantidadVendida']?>">Retornar</a></td>                                        
                                    </tr>

                                    <?php
                                }
                                ?>

                </tbody>
            </table>
            
		</form>


    </div>

</body>

<!-- script para tabledata -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

<!-- script para tabledata botones -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>


<script>
    
    $(document).ready(function() {
     
        $('#tabla').DataTable({
            //botones de impresion
            dom: 'Bfrtip',
            buttons: [
                {
                    extend:    'copyHtml5',
                    text:      '<i class="far fa-copy" style="font-size:20px;"></i>',
                    titleAttr: 'Copy',
                    className: 'btn btn-primary'
                },
                {
                    extend:    'excelHtml5',
                    text:      '<i class="fa fa-file-excel-o" style="font-size:20px;"></i>',
                    titleAttr: 'Excel',
                    className: 'btn btn-success'

                },
                {
                    extend:    'print',
                    text:      '<i class="bx bx-printer" style="font-size:20px;"></i>',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-info'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fa fa-file-pdf-o" style="font-size:20px;"></i>',
                    titleAttr: 'PDF',
                    className: 'btn btn-danger'

                },
                
                
            ],
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