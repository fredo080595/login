
<?php 

    require_once "controles/conexion.php";
    require_once "metodos.php";

   
    $obj = new funciones();


    

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $nombre = "a quien corresponda";



        if ($obj->emailExiste($email)) {

            $user_id = $obj->getValor('id', 'correo', $email);
            $token = $obj->generaTokenPass($user_id);
            $url = 'http://'.$_SERVER["SERVER_NAME"].'/login/cambia_pass.php?user_id='.$user_id.'&token='.$token;
            
            $asunto = 'Recuperar Password - Sistema de Usuarios';
            $cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";


            if ($obj->enviarEmail($email,$nombre,$asunto,$cuerpo)) {
                        echo "Hemos enviado un correo electronico a las direcion $email para restablecer tu password.<br />";
                        exit;
                
            }else{
                echo "error al enviar el email";
            }
            
        }



        
    }


 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<div class="row">
	
			 <div class="col-sm-3"></div>
             <div class="col-sm-6">
                    
                <div class="form-group text-center">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                     <br><br><br>
                     <h3>Correro a confirmar</h3>
                
                    <input type="email" name="email"  class="form-control text-center" >
                    <br>
                    <button class="btn btn-primary" type="submit">Cambiar Password</button>
                </form>
                </div>

             </div>
             <div class="col-sm-3"></div>    


            </div>
		</div>


</body>
</html>