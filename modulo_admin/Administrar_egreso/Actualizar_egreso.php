<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo Modificar_provedor.php
    $IDEgreso=$_REQUEST['IDEgreso'];
    // validamos que exista el ID para modificar
    if($IDEgreso==false){
        echo'<script type="text/javascript">
        alert("Error al obtener ID para modificar. Intente de nuevo.");
        window.location.href="Provedor.php";
        </script>';
    }
    // variables almacenadas en post
    $Descripcion = trim($_POST['Descripcion']);
    $Egreso = trim($_POST['Egreso']);
    $Fecha = date("y-m-d h:i:s"); 
    // Consulta para actualizar    
    $db = new Database();
    $consulta = $db->connect()->prepare("UPDATE t_egreso SET Descripcion= :Descripcion, Egreso=:Egreso, Fecha=:Fecha WHERE IDEgreso='$IDEgreso'");
    $consulta->bindParam(':Descripcion',$Descripcion);
    $consulta->bindParam(':Egreso',$Egreso);
    $consulta->bindParam(':Fecha',$Fecha);
    $consulta->execute();    
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al actualizar provedor");
        window.location.href="Egreso.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Egreso.php";
        </script>'; 
    }
?>