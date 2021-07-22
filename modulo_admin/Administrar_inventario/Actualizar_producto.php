<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo Modificar_inventario.php
    $IDProducto=$_REQUEST['IDProducto'];
    // validamos que exista el ID para modificar    
    if($IDProducto==false){
        echo'<script type="text/javascript">
        alert("Error al obtener IDProducto para modificar. Intente de nuevo.");
        window.location.href="Inventario.php";
        </script>';
    }
    // variables almacenadas en post
    $IDProvedor = trim($_POST['IDProvedor']);
    $IDTipoProducto = trim($_POST['IDTipoProducto']);
    $IDMarca = trim($_POST['IDMarca']);
    $Producto = trim($_POST['Producto']);
    $PrecioCosto = trim($_POST['PrecioCosto']);
    $PrecioVenta = trim($_POST['PrecioVenta']);
    $Existencias = trim($_POST['Existencias']);
    $Detalles = trim($_POST['Detalles']);
    // Consulta para actualizar    
    $db = new Database();
    $consulta = $db->connect()->prepare("UPDATE t_inventario SET IDProvedor= :IDProvedor, 
    IDTipoProducto=:IDTipoProducto, IDMarca=:IDMarca, Producto=:Producto, PrecioCosto=:PrecioCosto,
    PrecioVenta=:PrecioVenta, Existencias=:Existencias, Detalles=:Detalles
    WHERE IDProducto='$IDProducto'");
    $consulta->bindParam(':IDProvedor',$IDProvedor);
    $consulta->bindParam(':IDTipoProducto',$IDTipoProducto);
    $consulta->bindParam(':IDMarca',$IDMarca);
    $consulta->bindParam(':Producto',$Producto);
    $consulta->bindParam(':PrecioCosto',$PrecioCosto);
    $consulta->bindParam(':PrecioVenta',$PrecioVenta);
    $consulta->bindParam(':Existencias',$Existencias);
    $consulta->bindParam(':Detalles',$Detalles);
    $consulta->execute();    
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al actualizar inventario");
        window.location.href="Inventario.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Provedor.php";
        </script>'; 
    }
?>