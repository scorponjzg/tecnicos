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
  <title>Registro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nuevo_usuario.js"></script>
</head>
<body> 
<style>
 .btn-file {
  position: relative;
  overflow: hidden;
  }
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

.row {

	margin-bottom : 10px !important; 
}
</style>
<div class="container">
  
  <div class="panel panel-default" style="width:50%; margin: 50px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off" enctype="multipart/form-data">
		<div class="well">	
		
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
					<label for="clave">*Clave de acceso al sistema:</label>
					<input type="text" class="form-control" id="clave" name="clave" placeholder="Ingrese la contraseña con la que se ingresara al sistema">
				 </div>
				 <div class="form-group">	
					<label for="confirmacion">*Confirmar clave:</label>
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
			
			 					
			  <button type="submit" class="btn btn-success" style="margin-right:25px">Registrarse</button>
			  <button type="button" class="btn btn-warning"  style="margin: 0 auto;" id="regresar">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>