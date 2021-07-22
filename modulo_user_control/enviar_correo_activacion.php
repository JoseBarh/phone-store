<?php
    //incluimos base de datos
    include_once '../db/database.php';
    //variables creadas
    $Code= rand(1000, 9999); 
    $Active=0;
    $Rol_id=2;

    $Direccion="";
    $Telefono="";
    $Genero=3;
    //variables obtenidas por medio de POST archivo registrar.php
    $Nombre = trim($_POST['nombre-usuario']);
    $Correo = trim($_POST['correo-usuario']);
    $Password = trim($_POST['password1']);
    //Validamos si ya esta registrado el usuario para no tener multicuentas con correo
    $db = new Database();
    $query = $db->connect()->prepare('SELECT * FROM t_usuarios WHERE correo = :correo');
    $query->execute(['correo' => $Correo]);
    $row = $query->fetch(PDO::FETCH_NUM);
    //si el correo existe lo reenviamos al formulario del registro de lo contrario se lograra registrar
    if($row == true){
        echo'<script type="text/javascript">
        alert("Este correo ya esta registrado.");
        window.location.href="registrar.php";
        </script>';
    }else{
        //consulta para registrar usuario
        $db = new Database();
        $consulta = $db->connect()->prepare("INSERT INTO t_usuarios(IDRol, Nombre, Telefono, Direccion, Genero, Correo, Contrasena, code, active)
        VALUES(:IDRol, :Nombre, :Telefono, :Direccion, :Genero, :Correo, :Password, :Code, :Active)");
        $consulta->bindParam(':IDRol',$Rol_id);
        $consulta->bindParam(':Nombre',$Nombre);
        $consulta->bindParam(':Telefono',$Telefono);
        $consulta->bindParam(':Direccion',$Direccion);
        $consulta->bindParam(':Genero',$Genero);
        $consulta->bindParam(':Correo',$Correo);
        $consulta->bindParam(':Password',$Password);
        $consulta->bindParam(':Code',$Code);
        $consulta->bindParam(':Active',$Active);
        //si el registro es exitoso enviaremos un msj a su correo sino; hay un error con la DB.
        if ($consulta->execute()){
            //emisor del mensaje
            $emisor = "josebarah121@dcell.tk";
            //receptor del mensaje
            $receptor = $_POST['correo-usuario'];
            //Encabezado de mensaje (DE:,PARA:,TITULO,CUERPO)
            $from = "From: Support DCell<" . $emisor . ">";
            $to = $receptor;
            $subject = "Activación de cuenta DCell";
            $body = "\nHola ".$Nombre." sigue el siguiente vinculo para activar tu cuenta.
                     \nhttp://www.dcell.tk/modulo_user_control/confirmar_usuario.php?correo=".$receptor."&code=".$Code."
                     \nSi haz recivido este mensaje por error, puedes ignoralo.";
            // Esta es una funcion para que se envie el mensaje en donde fue almacenado
            mail($to,$subject,$body,$from);
            //Redirijir a login
            echo'<script type="text/javascript">
            alert("Registro exitoso. Activa tu cuenta desde tu correo para poder iniciar sesion.");
            window.location.href="login.php";
            </script>';
        }else{
            echo'<script type="text/javascript">
            alert("Error al conectar con la base de datos.");
            window.location.href="registrar.php";
            </script>'; 
        } 
    }
?>