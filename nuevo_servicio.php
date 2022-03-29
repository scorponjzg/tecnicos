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
  <title>Nueva orden</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap-select.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nuevo_servicio.js"></script>
 
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

			<select class="form-control" style="width:80%;margin:auto;" id="cliente">
				<option value="0">Seleccione un cliente</option>
			</select>
			<br>
			<br>
			<select class="form-control" style="width:80%;margin:auto;" id="categoria">
				<option value="0">Seleccione una categoria</option>
			</select>
			<label >Seleccione los conceptos:</label>
			<!--input name="concepto" id="concepto" type="hidden" value="0"-->
			<div class="row" style="width:84%;margin:auto;">
				<div class="col-sm-9" style="padding-right:0px;">
					<div class="form-group" style="width:100%">
					 	<select class="selectpicker" data-live-search="true" data-width="100%" id="select">
						</select>

					</div>
				</div>
				<div class="col-sm-3" style="padding-left:0px;">
					<div class="form-group" style="width:100%">
						 <button type="button" class="btn btn-success" style="width:100%" onclick="agregarConcepto()">Agregar estudio</button>
					</div>
				</div>
			
			</div>
		<div class="row" style="width: 80%;margin: auto;">
  				
			 <div class="form-group">		
				<label for="nombre">Nombre del servicio:</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el apellido materno">
			 </div>	
			
		</div>
		<div class="row" style="width: 84%;margin: auto;">
  			<div class="col-sm-6">
				  <div class="form-group">		
				<label for="fecha">Fecha de inicio:</label>
				<input type="date" class="form-control" id="fecha" name="fecha" placeholder="">
			 </div>	
			 </div>
			 <div class="col-sm-6">
				  <div class="form-group">		
				<label for="repite">Días de periodicidad:</label>
				<input type="number" min="1" class="form-control" id="repite" name="repite" placeholder="Ingrese cada cuantos días se repite el servicio">
			 </div>	
			 </div>
		</div>
		
			 <div class="form-group">
			 	<table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th class="info" style="width:30%">Concepto</th>
			 				<th class="info" style="width:10%; text-align: center">Valor optimo</th>
			 				<th class="info" style="width:10%">Valor máximo</th>
			 				<th class="info" style="width:10%">Valor mínimo</th>
			 				<th class="info" style="width:10%">Unidad de medida</th>
			 				<th class="info" style="width:10%">Remover</th>
			 			</tr>
			 		</thead>
			 		<tbody id="conceptoSeleccionado">
			 			
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