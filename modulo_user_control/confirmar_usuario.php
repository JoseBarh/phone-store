<?php
     // incluimos base de datos
     include_once '../db/database.php';
     // obtenemos datos enviados mediante GET
     $correo = $_GET['correo'];
     $code = $_GET['code'];
     // creamos variable para activar usuario
     $active='1';
     // validamos si existen credenciales para confirmar usuario
     if($correo=="" && $code==""){
          //header("Location:login.php");
          echo("No se encontraron credenciales");
          '<script type="text/javascript">
          alert("No se encontraron credenciales para la activacion.");
          </script>';
     }else{
          // actualizamos y activamos el usuario
          $db = new Database();
          $consulta = $db->connect()->prepare("UPDATE t_usuarios
          SET active=:active
          WHERE correo=:correo;");
          $consulta->bindParam(':active',$active);
          $consulta->bindParam(':correo',$correo);
          // validamos si la consulta se ejecuto 
          if ($consulta->execute()) {
               '<script type="text/javascript">
               alert("Activación de cuenta exitosa.");
               </script>';
               header("Location:login.php"); 
          }else{
               //no se encontro ninguna coincidencia para la activacion de cuenta o fallo en conexion con la DB
               header("Location:registrar.php"); 
               '<script type="text/javascript">
               alert("Error al actualizar tabla de datos.");
               </script>';
          }
     }
?>