<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo registrar.php
    $TipoProducto = trim($_POST['TipoProducto']);
    //consulta para registrar provedor
    $db = new Database();
    $consulta = $db->connect()->prepare("INSERT INTO t_tipo_producto(TipoProducto)
    VALUES(:TipoProducto)");
    $consulta->bindParam(':TipoProducto',$TipoProducto);
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Nuevo tipo de producto registrado");
        window.location.href="Tipo_Producto.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Tipo_Producto.php";
        </script>'; 
    }

?>