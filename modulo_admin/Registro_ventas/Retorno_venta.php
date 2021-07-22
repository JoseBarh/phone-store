<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //Capturamos el IDProducto 
    $IDProducto=$_GET['IDProducto'];
    // Obtenemos valores enviados por el metodo GET para devolver la cantidad de producto vendido
    $Existencias=$_GET['Existencias'];
    $CantidadVendida=$_GET['CantidadVendida'];
    // Calculamos el total exitencias
    $Existencias= $Existencias+$CantidadVendida;
    //consulta para debolver el producto al inventario
    $db = new Database();
    $consulta = $db->connect()->prepare("UPDATE t_inventario SET Existencias=:Existencias
    WHERE IDProducto='$IDProducto'");
    $consulta->bindParam(':Existencias',$Existencias);
    // Consulta para eliminar el producto del registro de ventas
    $consulta2 = $db->connect()->prepare("DELETE FROM t_registro_venta WHERE IDProducto='$IDProducto'");
    if ($consulta->execute() && $consulta2->execute()){
        ?>
            <script>
                alert("Se ha devuelto el producto al inventario.");
                window.location.href="Registro_venta.php";
            </script>      
        <?php   
            }else{
        ?>
            <script>
                alert("Error al conectar con la base de datos.");
                window.location.href="Registro_venta.php";
            </script>
        <?php  
    }
?>