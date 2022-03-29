<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['tipo_corpoteg']) && $_SESSION['tipo_corpoteg'] == 1){

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['editado'] = 'Por el momento no se encuentra en la funcionalidad activa, intente en otro momento.';
		$noCambios = 0;
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');
		$id= isset($_POST['identificador']) ? $conn->real_escape_string($_POST['identificador']) : '';
		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		$ap = isset($_POST['a_paterno']) ? $conn->real_escape_string($_POST['a_paterno']) : '';
		$am = isset($_POST['a_materno']) ? $conn->real_escape_string($_POST['a_materno']) : '';
		$usuario = isset($_POST['usuario']) ? $conn->real_escape_string($_POST['usuario']) : '';
		$clave = isset($_POST['clave']) ? $conn->real_escape_string($_POST['clave']) : '';
		$perfil = isset($_POST['perfil']) ? $_POST['perfil']+0 : 0;
		$tel =  isset($_POST['telefono']) ? $conn->real_escape_string($_POST['telefono']) : '';
		$correo =  isset($_POST['correo']) ? $conn->real_escape_string($_POST['correo']) : '';

		if($clave == ''){
			$sql = "UPDATE usuario SET nombre='{$nombre}', a_paterno='{$ap}', a_materno='{$am}', usuario='{$usuario}', fk_perfil = {$perfil}, telefono = '{$tel}', correo='{$correo}' WHERE pk_usuario=".$id."; ";
		} else {

			$sql = "UPDATE usuario SET nombre='{$nombre}', a_paterno='{$ap}', a_materno='{$am}', usuario='{$usuario}', contrasena='".sha1($clave)."', usuario='{$usuario}', fk_perfil = {$perfil}, telefono = '{$tel}', correo='{$correo}' WHERE pk_usuario=".$id."; ";
		}
				
			$noCambios = $conn->query($sql);
			
			if($conn->affected_rows == 1){
			
				$returnJs['editado'] = 'true';
			
			} else {

				if($noCambios == 1){
					$returnJs['editado']="No realizó ningún cambio.";
				}
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}