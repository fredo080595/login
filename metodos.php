<?php 
    require_once "controles/conexion.php";



class funciones{


	private function conexion(){

		$c = new conectar();
		return $c->conexion();
	}

		public function emailExiste($email){

		$conexion = self::conexion();
		$sql = "SELECT id FROM usuarios where correo like '$email' Limit 1";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_fetch_array($result)>0) {
			return true;
			
			
		}else{
			return false;
			
			}
		}


	public function getValor($campo,$campoWhere,$valor){
			$conexion = self::conexion();
			$sql = "SELECT $campo FROM usuarios WHERE $campoWhere = '$valor' LIMIT 1";
			$result = mysqli_query($conexion,$sql);

			$var = mysqli_fetch_array($result);

			if ($var>0) {

				return $var[$campo];
				
			}else {
				return null;
			}
	

	}

	public function generaToken(){
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}

	public function generaTokenPass($user_id){

		$conexion = self::conexion();
		
		$token = self::generaToken();

		$sql = "UPDATE usuarios SET token_password = '$token' WHERE id like '$user_id'";

		$result = mysqli_query($conexion,$sql);

		if ($result) {
		return $token;
		}else{
		return null;
		}

	}

	public function enviarEmail($email, $nombre, $asunto, $cuerpo){
		$destinatario = $email; 
        $asunto = $asunto; 
        $cuerpo = $cuerpo; 

        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 

        //dirección del remitente 
        $headers .= "From: $nombre <>\r\n"; 

        //dirección de respuesta, si queremos que sea distinta que la del remitente 
        $headers .= "Reply-To: alfredo.ruiz.itt2@gmail.com\r\n"; 

        //ruta del mensaje desde origen a destino 
        $headers .= "Return-path: '.$email.'\r\n"; 

        //direcciones que recibián copia 
        $headers .= "Cc: alfredo.ruiz.itt2@gmail.com\r\n"; 

        //direcciones que recibirán copia oculta 
        $headers .= "Bcc:alfredo.ruiz.itt2@gmail.com \r\n"; 

        mail($destinatario,$asunto,$cuerpo,$headers); 
        
        $resultado = "correo enviado";
       	return true;
		
		/*require_once 'PHPMailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'TLS'; //Modificar
		$mail->Host = 'bibliotecadigitaltecnm.esy.es'; //Modificar
		$mail->Port = 587; //Modificar
		
		$mail->Username = 'sindacco080595@gmail.com'; //Modificar
		$mail->Password = '21083946Ea'; //Modificar
		
		$mail->setFrom('sindacco080595@gmail.com', 'Prueba'); //Modificar
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
		return true;
		else
		return false;*/
	}



}



 ?>