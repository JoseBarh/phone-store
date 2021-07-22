<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo Modificar_provedor.php
    $IDTipoPago=$_REQUEST['IDTipoPago'];
    // validamos que exista el ID para modificar
    if($IDTipoPago==false){
        echo'<script type="text/javascript">
        alert("Error al obtener ID para tipo de pago. Intente de nuevo.");
        window.location.href="Tipo_pago.php";
        </script>';
    }
    // variables almacenadas en post
    $TipoPago = trim($_POST['TipoPago']);
    // Consulta para actualizar    
    $db = new Database();
    $consulta = $db->connect()->prepare("UPDATE t_tipo_pago SET TipoPago= :TipoPago WHERE IDTipoPago='$IDTipoPago'");
    $consulta->bindParam(':TipoPago',$TipoPago);
    $consulta->execute();    
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al actualizar tipo pago");
        window.location.href="Tipo_Pago.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Tipo_Pago.php";
        </script>'; 
    }
?>