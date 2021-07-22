<?php
    //incluimos base de datos
    include_once '../../db/database.php';
    //variables obtenidas por medio de POST archivo registrar.php
    $Empresa = trim($_POST['Empresa']);
    $RTN = trim($_POST['RTN']);
    $Telefono = trim($_POST['Telefono']);
    $Direccion = trim($_POST['Direccion']);
    $Correo = trim($_POST['Correo']);
    $SitioWeb = trim($_POST['SitioWeb']);
    //consulta para registrar provedor
    $db = new Database();
    $consulta = $db->connect()->prepare("INSERT INTO t_provedor(Empresa, RTN, Telefono, Direccion, Correo, SitioWeb)
    VALUES(:Empresa, :RTN, :Telefono, :Direccion, :Correo, :SitioWeb)");
    $consulta->bindParam(':Empresa',$Empresa);
    $consulta->bindParam(':RTN',$RTN);
    $consulta->bindParam(':Telefono',$Telefono);
    $consulta->bindParam(':Direccion',$Direccion);
    $consulta->bindParam(':Correo',$Correo);
    $consulta->bindParam(':SitioWeb',$SitioWeb);
    //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
    if ($consulta->execute()){
        echo'<script type="text/javascript">
        alert("Exito al registrar provedor");
        window.location.href="Provedor.php";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Error al conectar con la base de datos.");
        window.location.href="Provedor.php";
        </script>'; 
    }

?>