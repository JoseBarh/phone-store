<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo Modificar_provedor.php
    $IDMarca=$_REQUEST['IDMarca'];
    // validamos que exista el ID para modificar
    if($IDMarca==false){
        echo'<script type="text/javascript">
        alert("Error al obtener ID para marca. Intente de nuevo.");
        window.location.href="Marcas.php";
        </script>';
    }
    // variables almacenadas en post
    $Marca = trim($_POST['Marca']);
    // Consulta para actualizar    
    $db = new Database();
    $consulta = $db->connect()->prepare("UPDATE t_tipo_marca SET Marca= :Marca WHERE IDMarca='$IDMarca'");
    $consulta->bindParam(':Marca',$Marca);
    $consulta->execute();    
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al actualizar marca");
        window.location.href="Marcas.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Marcas.php";
        </script>'; 
    }
?>