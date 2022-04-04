<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['tipo_corpoteg']) && ($_SESSION['tipo_corpoteg'] == 1 || $_SESSION['tipo_corpoteg'] == 3)){

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
		
		$id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
			
			$sql = "DELETE FROM seccion_pregunta WHERE pk_seccion_pregunta={$id}";
				
			$noCambios = $conn->query($sql);
			if($conn->affected_rows == 1){
			
				$returnJs['eliminado'] = 'true';
			
			} else {

				if($noCambios == 1){
					$returnJs['eliminado']="No realizó ningún cambio.";
				}
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}