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

	$id = isset($_POST['pregunta']) ? $_POST['pregunta'] + 0 : 0;
	

	$sql = "SELECT  pregunta, pk_pregunta as id, tipo, activo AS estado from pregunta WHERE pk_pregunta = ".$id;
							
	$result = $conn->query($sql);
	
	if ($result->num_rows == 1) {
	
		$returnJs['pregunta']= $result->fetch_assoc();
	
	} else{
		
		$returnJs['pregunta'][]= "No hay mediciones registradas";
	}
	
		$result->free();
					
	echo json_encode($returnJs);
	$conn->close();
}