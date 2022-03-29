r<?php 
session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["tipo_corpoteg"])) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edita medición</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/edita_pregunta.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;
 	}

 	.read{
 		border: #ccc 1px solid;
 		padding: 6px 12px;
 		border-radius: 4px;
 		font-size: 14px;
 		color: #555;
 	}
 </style>
<div class="container">
  <?php include 'navMenu.php'?>
  <div class="panel panel-default" style="width:50%; margin: 70px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">		
				<input type="hidden" id="clave" name="clave">
			<div class="form-group">		 
				<label for="nombre">*Nombre de la medición:</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="No Registrado">
				
			</div>
			  <div class="form-group">	
				<label for="dir">Tipo de campo (Campo de texto, Lista de selección o Consulta):</label>
				<div class="radio">
					  <label><input type="radio" name="optradio" checked value="0" id="opt0">Campo de texto</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="optradio" value="1" id="opt1">Lista de selección</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="optradio" value="2" id="opt2">Consulta</label>
				</div>
			 </div>
			 <div class="form-group checkbox">        
		        <label><input type="checkbox" name="estado" id="estado" value="1">Activo </label>

		      </div>
			 
			  <button type="button" class="btn btn-info" style="margin-right:25px;" id="editar">Guardar cambios</button>
			   <!--button type="button" class="btn btn-danger" style="margin-right:25px;" id="eliminar" >Eliminar</button-->
			  <button type="button" class="btn btn-warning" style="margin: 0 auto;" id="cancelar">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>