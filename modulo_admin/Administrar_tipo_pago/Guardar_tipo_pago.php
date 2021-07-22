<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo registrar.php
    $TipoPago = trim($_POST['TipoPago']);
    //consulta para registrar provedor
    $db = new Database();
    $consulta = $db->connect()->prepare("INSERT INTO t_tipo_pago(TipoPago)
    VALUES(:TipoPago)");
    $consulta->bindParam(':TipoPago',$TipoPago);
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Nuevo tipo de pago registrado");
        window.location.href="Tipo_Pago.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Tipo_Pago.php";
        </script>'; 
    }

?>