<?php 
session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["usuario_corpoteg"]) && $_SESSION['tipo_corpoteg'] == 1) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nueva sección</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap-select.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nueva_seccion.js"></script>
 
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;

 	}

 </style>
<div class="container">
  <?php include 'navMenu.php'?>
  <div class="panel panel-default" style="width:60%; margin: 80px auto; text-align:center">
    <form action="#" style="margin: 0px;" id='formulario' autocomplete="off">
		<div class="well" style="margin: 0px">

		<div class="row" style="width: 80%;margin: auto;">
  				
			 <div class="form-group">		
				<label for="nombre">Nombre de la secci&oacute;n:</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la sección">
			 </div>	
			
		</div>
			<label >Seleccione las preguntas:</label>
			<!--input name="pregunta" id="pregunta" type="hidden" value="0"-->
			<div class="row" style="width:84%;margin:auto;">
				<div class="col-sm-8" style="padding-right:0px;">
					<div class="form-group" style="width:100%">
					 	<select class="selectpicker" data-live-search="true" data-width="100%" id="select">
						</select>

					</div>
				</div>
				<div class="col-sm-4" style="padding-left:0px;">
					<div class="form-group" style="width:100%">
						 <button type="button" class="btn btn-success" style="width:100%" onclick="agregarPregunta()">Agregar pregunta</button>
					</div>
				</div>
			
			</div>
		
			 <div class="form-group">
			 	<table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th class="info" style="width:60%; text-align: center">nombre</th>
			 				<th class="info" style="width:20%; text-align: center">Tipo</th>
			 				<th class="info" style="width:20%; text-align: center">Remover</th>
			 			</tr>
			 		</thead>
			 		<tbody id="table-body">
			 			
			 		</tbody>
			 	</table>
			 	
			 </div>
					  
			  <button type="commit" class="btn btn-info " style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-warning " style="margin: 0 auto;" onclick="window.location.replace('servicio.php');">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>