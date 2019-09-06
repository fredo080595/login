<?php

require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array();

if (!empty($_GET)) {
    $nombre       = $_GET['nombre'];
    $usuario      = $_GET['usuario'];
    $password     = $_GET['password'];
    $con_password = $_GET['con_password'];
    $email        = $_GET['email'];
    
    
    
    
    $activo  = 0;
    $tipo_usuario = 2;
    
    
    
    
    if (isNull($nombre, $usuario, $password, $con_password, $email)) {
        $errors[] = "Debe llenar todos los campos";
    }
    
    if (!isEmail($email)) {
        $errors[] = "Dirección de correo inválida";
    }
    
    if (!validaPassword($password, $con_password)) {
        $errors[] = "Las contraseñas no coinciden";
    }
    
    if (usuarioExiste($usuario)) {
        $errors[] = "El nombre de usuario $usuario ya existe";
    }
    
    if (emailExiste($email)) {
        $errors[] = "El correo electronico $email ya existe";
    }
    
    if (count($errors) == 0) {
        
        
        
        
        $pass_hash = hashPassword($password);
        $token     = generateToken();
        
        $registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);
        

        
        
        
        
        if ($registro > 0) {
            

            
            
            $url = 'http://' . $_SERVER["SERVER_NAME"] . '/login/activar.php?id=' . $registro . '&val=' . $token;
            
            $asunto = 'Activar Cuenta - Sistema de Usuarios';
            $cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, es indispensable de click en la siguiente liga <a href='$url'>Activar Cuenta</a>";
            $errors[] = "Exito";
            if ($mail=enviarEmail($email, $nombre, $asunto, $cuerpo)) {
                
                echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: $email";
                
              
              exit;
                
                

                
            } else {
                $error[] = "Error al enviar Email";
                
            }
            
        } else {
            $errors[] = "Error al Registrar";
           		
             
        }
        


    }
}

	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php echo json_encode($errors); ?>


</body>
</html>