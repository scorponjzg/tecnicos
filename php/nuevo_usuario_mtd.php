<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['tipo_corpoteg']) && $_SESSION['tipo_corpoteg'] == 1){

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['ingresado'] = 'Por el momento no se encuentra en la funcionalidad activa, intente más tarde.';
		
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');

		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		$paterno = isset($_POST['a_paterno']) ? $conn->real_escape_string($_POST['a_paterno']) : '';
		$materno = isset($_POST['a_materno']) ? $conn->real_escape_string($_POST['a_materno']) : '';
		$perfil = isset($_POST['perfil']) ? $_POST['perfil']+0 : 0;
		$usuario = isset($_POST['usuario']) ? $conn->real_escape_string($_POST['usuario']) : '';
		$clave = isset($_POST['clave']) ? $conn->real_escape_string(sha1($_POST['clave'])) : '';
		$correo = isset($_POST['correo']) ? $conn->real_escape_string($_POST['correo']) : '';
		$telefono = isset($_POST['telefono']) ? $conn->real_escape_string($_POST['telefono']) : '';
		
			$sql = "INSERT INTO usuario(usuario, contrasena, nombre, a_paterno, a_materno, fk_perfil, correo, telefono) VALUES('{$usuario}','{$clave}','{$nombre}','{$paterno}','{$materno}',{$perfil},'{$correo}','{$telefono}');";
			
			$conn->query($sql);
			
			if($conn->affected_rows == 1){
			
				$returnJs['ingresado'] = 'true';
			
			} else {

				
					$returnJs['ingresado']="Funcionalidad no disponible por el momento.";
				
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}