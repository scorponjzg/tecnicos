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

	$id = isset($_POST['id']) ? $_POST['id'] + 0 : 0;
	

	$sql = "SELECT  pk_usuario AS id, usuario, nombre, a_paterno AS paterno, IFNULL(a_materno, ' ') AS materno, fk_perfil AS perfil, correo, telefono FROM usuario WHERE pk_usuario= ".$id;
						
	$result = $conn->query($sql);
	
	if ($result->num_rows == 1) {
	
		$returnJs['usuario']= $result->fetch_assoc();
	
	} else{
		
		$returnJs['usuario'][]= "No hay clientes registados";
	}
	
		$result->free();
					
	echo json_encode($returnJs);
	$conn->close();
}