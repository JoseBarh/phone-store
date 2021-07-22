<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo registrar.php
    $IDProvedor = trim($_POST['IDProvedor']);
    $IDTipoProducto = trim($_POST['IDTipoProducto']);
    $IDMarca = trim($_POST['IDMarca']);
    $Producto = trim($_POST['Producto']);
    $FechaEntrada = date("y-m-d h:i:s"); 
    $PrecioCosto = trim($_POST['PrecioCosto']);
    $PrecioVenta = trim($_POST['PrecioVenta']);
    $Existencias = trim($_POST['Existencias']);
    $Detalles = trim($_POST['Detalles']);
    //consulta para registrar provedor
    $db = new Database();
    $consulta = $db->connect()->prepare("INSERT INTO t_inventario(IDProvedor, IDTipoProducto, IDMarca, Producto, FechaEntrada, PrecioCosto, PrecioVenta, Existencias, Detalles)
    VALUES(:IDProvedor, :IDTipoProducto, :IDMarca, :Producto, :FechaEntrada, :PrecioCosto, :PrecioVenta, :Existencias, :Detalles)");
    $consulta->bindParam(':IDProvedor',$IDProvedor);
    $consulta->bindParam(':IDTipoProducto',$IDTipoProducto);
    $consulta->bindParam(':IDMarca',$IDMarca);
    $consulta->bindParam(':Producto',$Producto);
    $consulta->bindParam(':FechaEntrada',$FechaEntrada);
    $consulta->bindParam(':PrecioCosto',$PrecioCosto);
    $consulta->bindParam(':PrecioVenta',$PrecioVenta);
    $consulta->bindParam(':Existencias',$Existencias);
    $consulta->bindParam(':Detalles',$Detalles);
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al registrar producto");
        window.location.href="Inventario.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Inventario.php";
        </script>'; 
    }

?>