<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    // iniciamos sesion
    session_start();
    //creamos variables y se insertan los datos guardados en las $SESSION 
    $IDUsuario = $_SESSION['IDUsuario'];
    //Capturamos el IDProducto 
    $IDProducto=$_GET['IDProducto'];
    // Obtenemos valores enviados por el metodo GET para calcular las existencias y la ganancia
    $Existencias=$_GET['Existencias'];
    $PrecioCosto=$_GET['PrecioCosto'];
    //variables obtenidas por medio de POST del archivo Venta_producto.php
    $CantidadVendida = trim($_POST['CantidadVendida']);
    $PrecioVendido = trim($_POST['PrecioVendido']);
    $PagoCliente = trim($_POST['PagoCliente']);
    $IDTipoPago = trim($_POST['IDTipoPago']);
    //capturamos la fecha de venta del producto
    date_default_timezone_set('America/El_Salvador');
    $FechaSalida = date("y-m-d"); 
    //Calculos para la venta
    //Calculamos el total venta, el cambio del cliente y la ganancia de la empresa
    $TotalVenta=$CantidadVendida*$PrecioVendido;
    $CambioCliente=$PagoCliente-$TotalVenta;
    $Ganancia=$TotalVenta-($PrecioCosto*$CantidadVendida);
    //consulta para registrar venta del producto
    $db = new Database();
    $consulta = $db->connect()->prepare("INSERT INTO t_registro_venta(IDProducto, IDUsuario, IDTipoPago, 
    FechaSalida, PrecioVendido, CantidadVendida, TotalVenta, PagoCliente, CambioCliente, Ganancia)
    VALUES(:IDProducto, :IDUsuario, :IDTipoPago, :FechaSalida, :PrecioVendido, :CantidadVendida, 
    :TotalVenta, :PagoCliente, :CambioCliente, :Ganancia)");
    $consulta->bindParam(':IDProducto',$IDProducto);
    $consulta->bindParam(':IDUsuario',$IDUsuario);
    $consulta->bindParam(':IDTipoPago',$IDTipoPago);
    $consulta->bindParam(':FechaSalida',$FechaSalida);
    $consulta->bindParam(':PrecioVendido',$PrecioVendido);
    $consulta->bindParam(':CantidadVendida',$CantidadVendida);
    $consulta->bindParam(':TotalVenta',$TotalVenta);
    $consulta->bindParam(':PagoCliente',$PagoCliente);
    $consulta->bindParam(':CambioCliente',$CambioCliente);
    $consulta->bindParam(':Ganancia',$Ganancia);
    //calculos para la Existencias del producto
    $Existencias= $Existencias - $CantidadVendida;
    // Consulta para actualizar la Existencias del producto    
    $consulta2 = $db->connect()->prepare("UPDATE t_inventario SET Existencias= :Existencias
    WHERE IDProducto='$IDProducto'");
    $consulta2->bindParam(':Existencias',$Existencias);
    $consulta2->execute();
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute() && $consulta2->execute()){
        ?>
            <script>
                alert("Venta realizada con exito");
                alert('El cambio del cliente es: <?php echo $CambioCliente ?>');
                window.location.href="Venta_producto.php";
            </script>      
        <?php   
            }else{
        ?>
            <script>
                alert("Error al conectar con la base de datos.");
                window.location.href="Venta_producto.php";
            </script>
        <?php  
    }
?>