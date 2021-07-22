<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo Modificar_provedor.php
    $IDTipoProducto=$_REQUEST['IDTipoProducto'];
    // validamos que exista el ID para modificar
    if($IDTipoProducto==false){
        echo'<script type="text/javascript">
        alert("Error al obtener ID para tipo producto. Intente de nuevo.");
        window.location.href="Marcas.php";
        </script>';
    }
    // variables almacenadas en post
    $TipoProducto = trim($_POST['TipoProducto']);
    // Consulta para actualizar    
    $db = new Database();
    $consulta = $db->connect()->prepare("UPDATE t_tipo_producto SET TipoProducto= :TipoProducto WHERE IDTipoProducto='$IDTipoProducto'");
    $consulta->bindParam(':TipoProducto',$TipoProducto);
    $consulta->execute();    
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al actualizar tipo producto");
        window.location.href="Tipo_Producto.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Tipo_Producto.php";
        </script>'; 
    }
?>