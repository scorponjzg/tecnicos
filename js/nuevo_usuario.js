
function upload_image(){//Funcion encargada de enviar el archivo via AJAX
	$(".upload-msg").text('Cargando...');
	var inputFileImage = document.getElementById("fileToUpload");
	var file = inputFileImage.files[0];
	var data = new FormData();
	data.append('fileToUpload',file);
	
	/*jQuery.each($('#fileToUpload')[0].files, function(i, file) {
		data.append('file'+i, file);
	});*/
				
	$.ajax({
		url: "upload.php",        // Url to which the request is send
		type: "POST",             // Type of request to be send, called as method
		data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,        // To send DOMDocument or non processed data file it is set to false
		success: function(data)   // A function to be called if request succeeds
		{
			$(".upload-msg").html(data);
			window.setTimeout(function() {
			$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove();
			});	}, 5000);
		}
	});
	
}
function obtener_servicio(){
	
	var resultado = '<option value="0">Seleccione un servicio</option>';
		
		$.ajax({
			method: "POST",
			url: "php/obtener_servicio_mtd.php",
			dataType:"json"
		}).done(function(data){
			
			data.servicio.forEach(function(entry){
				
				resultado += '<option value="'+entry.id+'">'+entry.nombre+'</option>';
				
			});
			$('#servicio').empty();
			$('#servicio').append(resultado);
					
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
   
}
			
function previewImage(nb) {        
    var reader = new FileReader();         
    reader.readAsDataURL(document.getElementById('uploadImage'+nb).files[0]);         
    reader.onload = function (e) {             
        document.getElementById('uploadPreview'+nb).src = e.target.result;         
    };     
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

	} else if($("#clave").val() == ''){
		alert("Debe de ingresar la clave");
		$("#clave").focus();
	} else if($("#clave").val() != $("#confirmacion").val()){
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

function regresar(){
	
	if(confirm("Realmente quiere salir de la captura?"))
	window.location.replace("usuario.php");
	
}

function resolucion_pantalla(){	
 
	if (screen.width<1024){
		
		$(".panel").css("width","100%");
	} 
	
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
					
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
}


$(function(){
	obtenerPerfil();
	
   $("#regresar").on('click',regresar);
	
	$("#formulario").submit(function(event){
			
		event.preventDefault();
		if(valida_formulario()){
			
			var serializada = $(this).serialize();
			
			$.ajax({
				method: "POST",
				url: "php/nuevo_usuario_mtd.php",
				dataType: "json",
				data: serializada 
				}).done(function(entry){
					
					if(entry.ingresado == 'true'){
						alert("Usuario creado correctamente.");
						window.location.replace("usuario.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		}
	});
});