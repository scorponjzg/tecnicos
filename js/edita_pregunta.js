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

function validaForm(){
	var correcto = false;
	 if($("#nombre").val() == ''){
		alert("Debe de ingresar un nombre de medición");
		$("#nombre").focus();
	} else {
		correcto =  true;
	}
	return correcto;
}

function redireccion(){

	window.location.href="pregunta.php";
	
}

function obtenerMedicion(){
	var pregunta = getQueryVariable('pregunta');
	
	$.ajax({

		method: "POST",
		url:"php/obtener_pregunta_id_mtd.php",
		dataType: "json",
		data: {"pregunta":pregunta}

	}).done(function(data){
		console.log(data);
		if (data.pregunta.estado == "1"){
			$("#estado").attr('checked', true);
		}
		$("#nombre").val(data.pregunta.pregunta);
		$("#clave").val(data.pregunta.id);
		$("#opt"+data.pregunta.tipo).attr('checked', true);
			
	}).fail(function(error){
		console.log(error.responseText);
	});
}

function editarMedicion(){
	if(validaForm()){	
		
		var serializada = $("#formulario").serialize();
		
		$.ajax({
			method: "POST",
			url:"php/editar_pregunta_mtd.php",
			dataType: "json",
			data: serializada
		}).done(function(data){
			if(data.editado == 'true'){
				alert("Pregunta editada correctamente");
				window.location.href="pregunta.php";
			} else {
				alert(data.editado);
			}
		}).fail(function(error){
			console.log(error.responseText);
		});
	} 
}
$(function(){

	obtenerMedicion();
	
	$("#cancelar").on("click",redireccion);
	
	$("#editar").on("click",editarMedicion);
	
	
	
});