<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['tipo_corpoteg']) && $_SESSION['tipo_corpoteg'] == 1){

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['ingresado'] = 'Por el momento no se encuentra en la funcionalidad activa, intente más tarde.';
		$correcto = 0;
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');
		
		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		
		foreach ($_POST as $key => $value) {
			if(strpos($key,"concepto")!== false){
				$concepto[]=$value;
			}
		}
			$conn->query("START TRANSACTION;");

			$sql = "INSERT INTO seccion(seccion, seccion_base) VALUES('{$nombre}', 1)";
			
			$conn->query($sql);
			
			if($conn->affected_rows == 1){
				$last_id = $conn -> insert_id;

				$returnJs['ingresado'] = 'true';

				for($i=0; $i < count($concepto); $i++){

						$sql = "INSERT INTO seccion_pregunta(fk_seccion, fk_pregunta) VALUES({$last_id}, {$concepto[$i]});";
							
							$conn->query($sql);
							
							if($conn->affected_rows != 1){
								$correcto = 1;
								$returnJs['ingresado']="1.Por el momento no se encuentra disponible el módulo, por favor contacte al administrador del sistema.";
							}
					}



			
			}
			
			if($correcto == 0){
				$conn->query("COMMIT;");
			} else {
				$conn->query("ROLLBACK;");

			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}