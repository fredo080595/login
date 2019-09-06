<?php 

class conectar{

	private $sever = /*"mysql.hostinger.mx"*/"localhost";
	private $user = /*"u656765632_root"*/"root";
	private $pass = /*"21083946Ea"*/ "";
	private $db = /*"u656765632_login"*/ "login";

	public function conexion(){

		$conexion = mysqli_connect($this->sever,$this->user,$this->pass,$this->db);
		return $conexion;
	}

}



 ?>