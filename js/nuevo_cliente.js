function validaForm(){
	var correcto = false;
	 if($("#nombre").val() == ''){
		alert("Debe de ingresar un nombre");
		$("#nombre").focus();
	} else {
		correcto =  true;
	}
	return correcto;
}

function ancho_pantalla(){
	var ventana_ancho = $(window).width();
    var ventana_alto = $(window).height();
   
    if(ventana_ancho < 801){
    	$("#panel").css('width', '80%');
   		
    } else {
    	$("#panel").css('width', '50%');
    	

    }
}

$(function(){
	ancho_pantalla();
	$(window).resize(function(){

		ancho_pantalla();
	});

	$("#formulario").submit(function(event){
		event.preventDefault();
		var estudio = $(this).serialize();
		//console.log(estudio);
		if(validaForm()){	
				
				$.ajax({
				method: "POST",
				url: "php/nuevo_cliente_mtd.php",
				dataType: "json",
				data: estudio 
				}).done(function(entry){
					console.log(entry);
					if(entry.ingresado == 'true'){
						alert("Cliente creado correctamente.");
						window.location.replace("cliente.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error);
				});
			
		} 
	})
	
});