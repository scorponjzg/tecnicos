<?php 
session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["usuario_corpoteg"])) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nuevo cliente</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.ico">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nuevo_cliente.js"></script>
</head>
<body> 
 <style>
 	
 	input, textarea {
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
  <div class="panel panel-default" style="width:50%; margin: 80px auto; text-align:center" id="panel">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">		
			
			 <div class="form-group">		
				<label for="nombre">*Nombre del cliente o raz&oacute;n social:</label>
				<input type="text" class="form-control editar" id="nombre" name="nombre" placeholder="Ingrese nombre o razón social">
			 </div>	
			 <div class="form-group">	
				<label for="dir">Direcci&oacute;n:</label>
				<textarea rows="3" class="form-control editar" id="dir" name="dir" placeholder="Ingrese la dirección del cliente"></textarea>
			 </div>
					  
			  <button type="commit" class="btn btn-info btnEditar" style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-warning btnEditar" style="margin: 0 auto;" onclick="window.location.replace('cliente.php');">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>