<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo registrar.php
    $Marca = trim($_POST['Marca']);
    //consulta para registrar provedor
    $db = new Database();
    $consulta = $db->connect()->prepare("INSERT INTO t_tipo_marca(Marca)
    VALUES(:Marca)");
    $consulta->bindParam(':Marca',$Marca);
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Nueva marca registrada");
        window.location.href="Marcas.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Marcas.php";
        </script>'; 
    }

?>