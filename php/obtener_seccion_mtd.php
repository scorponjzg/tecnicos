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
	$medicion = [];
	$returnJs = [];
	$returnJs['show'] = "false";	
		
	$sql = "SELECT  pk_seccion AS id, seccion FROM seccion WHERE pk_seccion >= 1 && activo = 1;";
	//error_log($sql);
												
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($resultado = $result->fetch_assoc()){
			$medicion = [];	
			$sql = "SELECT  p.pregunta, IF(p.tipo = 0, 'Consulta', IF(p.tipo = 1, 'Selección', 'Campo de texto' )) AS tipo FROM pregunta AS p, seccion_pregunta AS sp WHERE sp.fk_seccion = {$resultado['id']} && sp.fk_pregunta = p.pk_pregunta;";
			//error_log($sql);
													
			$result1 = $conn->query($sql);

			if ($result1->num_rows > 0) {
		
				while($resultado1 = $result1->fetch_assoc()){

					$medicion[] = $resultado1;

					}
				}
				error_log(print_r($resultado, true));
				error_log(print_r($medicion, true));

			$returnJs['seccion'][] = array_merge($resultado, $medicion);
		}
		if($_SESSION['tipo_corpoteg'] == 1){

			$returnJs['show'] = "true";
		}
		
	} else {
		
		$returnJs['seccion'][] = ["seccion" => "No hay secciones registradas", "id" => "0"];
	}
	$result->free();
	
					
	echo json_encode($returnJs);
	$conn->close();
}