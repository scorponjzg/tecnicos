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
		$concepto = [];
		$correcto = 1;
		$id = isset($_POST['identificador']) ?  $_POST['identificador']+0 : '0';
		$seccion = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';

		foreach ($_POST as $key => $value) {
			if(strpos($key,"concepto")!== false){
				$concepto[]=$value;
			}
		}
		

		$sql = "UPDATE seccion SET seccion='{$seccion}' WHERE pk_seccion={$id}";
				
			$noCambios = $conn->query($sql);
			//error_log($sql."---".$noCambios);
			if($conn->affected_rows == 1){
			
				$returnJs['editado'] = 'true';
			
			} else {

				if($noCambios == 1){
					$returnJs['editado']="No realizó ningún cambio.";
				}
			}


			if(count($concepto) > 0){

				for($i=0; $i < count($concepto); $i++){

						$sql = "INSERT INTO seccion_pregunta(fk_seccion, fk_pregunta) VALUES({$id}, {$concepto[$i]});";
							
							$conn->query($sql);
							
							if($conn->affected_rows != 1){
								$correcto = 0;
								
							}
					}

			}

			if($correcto == 0){// hubo un error al insertar en seccion_pregunta

				$returnJs['ingresado']="1.Por el momento no se encuentra disponible el módulo, por favor contacte al administrador del sistema.";

			} else if (count($concepto) == 0 && $noCambios == 1){

				$returnJs['editado']="No realizó ningún cambio.";

			} else {

				$returnJs['editado'] = 'true';
			}

			
			
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}