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
  <title>Edita usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/edita_usuario.js"></script>
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
				<input type="hidden" id="identificador" name="identificador">	
			<div class="form-group">		 
				<label for="nombre">*Nombre:</label>
				<input type="text" class="form-control" id="nombre" name="nombre">
			</div>
			 <div class="form-group">		
				<label for="a_paterno">*Apellido paterno:</label>
				<input type="text" class="form-control" id="a_paterno" name="a_paterno">
			 </div>	
			 <div class="form-group">	
				<label for="a_materno">Apellido materno:</label>
				<input type="text" class="form-control" id="a_materno" name="a_materno">
			 </div>
			

			 <!--div class="form-group" style="text-align: center">
				<span class="btn btn-default btn-file">
			    Seleccione foto del usuario <input type="file" name="file" onchange="previewImage(1);" id="uploadImage1">
			</span>
				<br>
				<br>
				<img id="uploadPreview1" width="110" height="150" src="img/image_not_available.png" />
			</div-->
			
			 <div class="form-group">
			</div>	
			<div class="form-group">		 
				<label for="servicio">*Perfil:</label>
				<select  class="form-control" id="perfil" name="perfil">
					<option value="0">Seleccione un perfil</option>
				</select>
				
			</div> 	
			<div class="well">
				 <div class="form-group">	
					<label for="usuario">*Usuario para acceder al sistema:</label>
					<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese el nombre de usuario con el que se accederá al sistema">
				 </div>
				  <div class="form-group">	
					<label for="clave">Clave de acceso al sistema:</label>
					<input type="text" class="form-control" id="clave" name="clave" placeholder="Ingrese una contraseña si desea cambiar la actual">
				 </div>
				 <div class="form-group">	
					<label for="confirmacion">Confirmar clave:</label>
					<input type="text" class="form-control" id="confirmacion" placeholder="Confirme la contraseña de arriba">
				 </div>
			</div>
			 <div class="form-group">	
				<label for="correo">*Correo electr&oacute;nico:</label>
				<input type="text" class="form-control" id="correo" name="correo">
			 </div> 
			 <div class="form-group">	
				<label for="telefono">N&uacute;mero telef&oacute;nico:</label>
				<input type="text" class="form-control" id="telefono" name="telefono">
			 </div>
			
			 
			  <button type="button" class="btn btn-info" style="margin-right:25px;" id="editar">Guardar cambios</button>
			  <button type="button" class="btn btn-warning" style="margin: 0 auto;" id="cancelar">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>