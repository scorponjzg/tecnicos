<?php 
session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["tipo_corpoteg"])) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reclutamiento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/usuario.js"></script>
  <script src="js/excellentexport.js"></script>
</head>
<body>

<style>

th, td{
	
	text-align:center !important;
}

</style>
	
<div class="container">
	 <?php include 'navMenu.php'?>
 <div id="resultados" class="tab-pane fade in active">
			<div class="centrado">
				
				<div class="panel panel-default" style="width: 60%; margin:6% auto 0 auto; ">
					
						<div class="panel panel-body" style="margin-bottom: 0px;">
						
							<div style="text-align: center; margin-top: 12px" id="boton_nuevo">
								
								<button id="nuevo" type="button" class="btn btn-info" data-accion="1" style="width:45%;text-align:center; color: white"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Nuevo usuario</button>
								<br>
								<br>
								
								<input type="text" placeholder="Ingrese el nombre o una parte para buscar" style="width:60%;margin: 18px auto ;text-align: center" id="buscar">
								<br>
								<!--button onclick="crearCSV('reclutados','reclutados')">Exportar a CSV</button-->
								<br>
								<a download="usuarios.xls" href="#" onclick="return ExcellentExport.excel(this, 'reclutados', 'Hoja1');" id="descargar">Exportar excel</a>
							</div>
						</div>
					
				</div>
				

				<div class="tab-content">
					
						<div class="table-responsive">
							<table class="table table-bordered"style="margin-top: 20px;" id="reclutados" name="reclutados">
								<thead >
								  <tr class="info">
								    <th style="width:44%;">Nombre</th>
									<th style="width:20%;">Tel&eacute;fono / Celular</th>
									<th style="width:20%;">Correo electr&oacute;nico</th>
									<th style="width:8%;">Editar</th>
									<th style="width:8%;">Baja</th>
								  </tr>
								</thead>
								<tbody id="reporte">
								  
								</tbody>
							</table>
						
							<br>
					</div>
				</div>
			</div>
		</div>
</div>

</body>
</html>