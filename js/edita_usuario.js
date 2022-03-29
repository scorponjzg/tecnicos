function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = atob(query).split("&");
  
  for (var i=0; i < vars.length; i++) {
       var pair = vars[i].replace('=','/').split("/");
      
       if(pair[0] == variable) {
           return pair[1];
       }
   }
   return false;
}
function valida_formulario(){
	var correcto = false;
	if($("#nombre").val() ==""){
		alert("Debe ingresar un nombre");
			$("#nombre").focus();

	} else if($("#a_paterno").val() ==""){	
		alert("Debe ingresar el apellido paterno");
			$("#a_paterno").focus();
		
	} else if($("#perfil").val() == '0'){
		alert("Debe seleccionar un perfil para el usuario");
		$("#perfil").focus();
	} else if($("#usuario").val() ==""){
		alert("Debe ingresar el nombre de usuario para ingresar al sistema");
			$("#usuario").focus();

	} else if($("#clave").val() != '' && $("#clave").val() != $("#confirmacion").val()){
		alert("Las claves no son iguales");
		$("#confirmacion").focus();
	} else if($("#correo").val() ==""){
		alert("Debe ingresar el correo electrónico");
			$("#correo").focus();

	} else if($("#telefono").val() ==""){
		alert("Debe ingresar el número de teléfono");
			$("#usuario").focus();

	} else {
		correcto =  true;
	}
	return correcto;

	
}
function redireccion(){

	window.location.href="usuario.php";
	
}

function obtenerUsuario(){
	var id = getQueryVariable('identificador');
	
	$.ajax({

		method: "POST",
		url:"php/obtener_usuario_id_mtd.php",
		dataType: "json",
		data: {"id":id}

	}).done(function(data){
		
		$("#identificador").val(data.usuario.id);
		$("#nombre").val(data.usuario.nombre);
		$("#a_paterno").val(data.usuario.paterno);
		$("#a_materno").val(data.usuario.materno);
		$("#perfil").val(data.usuario.perfil);
		$("#telefono").val(data.usuario.telefono);
		$("#correo").val(data.usuario.correo);
		$("#usuario").val(data.usuario.usuario);
		
	}).fail(function(error){
		console.log(error.responseText);

	});
}
function obtenerPerfil(){

	var resultado = '<option value="0">Seleccione un perfil</option>';
		
		$.ajax({
			method: "POST",
			url: "php/obtener_perfil_mtd.php",
			dataType:"json",
			data: {servicio: $("#servicio").val()}

		}).done(function(data){
			
			data.perfil.forEach(function(entry){
				
				resultado += '<option value="'+entry.id+'">'+entry.nombre+ '</option>';
				
			});
			$('#perfil').empty();
			$('#perfil').append(resultado);
			obtenerUsuario();		
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
}

function editarUsuario(){

	var serializada = $("#formulario").serialize();
	
	if(valida_formulario()){
		$.ajax({
			method: "POST",
			url:"php/editar_usuario_mtd.php",
			dataType: "json",
			data: serializada
		}).done(function(data){
			if(data.editado == 'true'){
				alert("Usuario editado correctamente");
				window.location.href="usuario.php";
			} else {
				alert(data.editado);
			}
		}).fail(function(error){
			console.log(error.responseText);
		});
	}
}
$(function(){

	obtenerPerfil();
	
	$("#cancelar").on("click",redireccion);
	$("#editar").on("click",editarUsuario);
	
	
	
});