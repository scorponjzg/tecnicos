<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
  session_start();
	
  require_once 'configMySQL.php';

	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->set_charset("utf8");
	
	$returnJs = [];
	$returnJs['show'] = "false";
	$condicional = ">";
	if($_SESSION['tipo_corpoteg'] == '1'){
		$condicional = ">=";
	}

	$sql = "SELECT pk_usuario AS identificador, CONCAT(a_paterno, ' ', IFNULL(a_materno,' '),' ', nombre) AS nombre, IFNULL(telefono,'No registrado') AS telefono, IFNULL(correo, 'No registrado') AS correo FROM usuario WHERE activo=1  && fk_perfil ".$condicional." 1";
	//error_log($sql);
													
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			
			$returnJs['usuario'][]= $resultado;
		}
		if($_SESSION['tipo_corpoteg'] == 1){

			$returnJs['show'] = "true";
		}
		
	} else {
		
		$returnJs['usuario'][] = array("nombre" => "No hay usuarios registrados");
	}
	$result->free();
	
					
	echo json_encode($returnJs);
	$conn->close();
}