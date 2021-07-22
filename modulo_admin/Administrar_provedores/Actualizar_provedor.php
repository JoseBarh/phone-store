<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo Modificar_provedor.php
    $IDProvedor=$_REQUEST['IDProvedor'];
    // validamos que exista el ID para modificar
    if($IDProvedor==false){
        echo'<script type="text/javascript">
        alert("Error al obtener ID para modificar. Intente de nuevo.");
        window.location.href="Provedor.php";
        </script>';
    }
    // variables almacenadas en post
    $Empresa = trim($_POST['Empresa']);
    $RTN = trim($_POST['RTN']);
    $Telefono = trim($_POST['Telefono']);
    $Direccion = trim($_POST['Direccion']);
    $Correo = trim($_POST['Correo']);
    $SitioWeb = trim($_POST['SitioWeb']);
    // Consulta para actualizar    
    $db = new Database();
    $consulta = $db->connect()->prepare("UPDATE t_provedor SET Empresa= :Empresa, RTN=:RTN, Telefono=:Telefono, Direccion=:Direccion, Correo=:Correo, SitioWeb=:SitioWeb WHERE IDProvedores='$IDProvedor'");
    $consulta->bindParam(':Empresa',$Empresa);
    $consulta->bindParam(':RTN',$RTN);
    $consulta->bindParam(':Telefono',$Telefono);
    $consulta->bindParam(':Direccion',$Direccion);
    $consulta->bindParam(':Correo',$Correo);
    $consulta->bindParam(':SitioWeb',$SitioWeb);
    $consulta->execute();    
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al actualizar provedor");
        window.location.href="Provedor.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Provedor.php";
        </script>'; 
    }
?>