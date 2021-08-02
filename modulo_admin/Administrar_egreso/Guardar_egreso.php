<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo registrar.php
    $Descripcion = trim($_POST['Descripcion']);
    $Egreso = trim($_POST['Egreso']);
    $Fecha = date("y-m-d h:i:s"); 

    //consulta para registrar provedor
    $db = new Database();
    $consulta = $db->connect()->prepare("INSERT INTO t_egreso(Descripcion, Egreso, Fecha)
    VALUES(:Descripcion, :Egreso, :Fecha)");
    $consulta->bindParam(':Descripcion',$Descripcion);
    $consulta->bindParam(':Egreso',$Egreso);
    $consulta->bindParam(':Fecha',$Fecha);
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al registrar egreso");
        window.location.href="Egreso.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Egreso.php";
        </script>'; 
    }

?>