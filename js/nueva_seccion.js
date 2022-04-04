var array_concepto= new Array();
var pregunta_asignado = 0;
var id_incremental = 1;
function validaForm(){
	var correcto = false;
	 if($("#nombre").val() == ''){
		alert("Debe de ingresar el nombre de la sección");
		$("#nombre").focus();
	}else if(pregunta_asignado == 0){
		alert("Debe asignar por lo menos una pregunta");
		$('#select').data('selectpicker').$button.focus();

	} else {
		
		correcto =  true;
	}
	return correcto;
}


function verDetalle(){
  
	window.location.replace("editar_seccion.php?"+btoa("servicio="+$(this).attr("data-id")));
}
function agregarPregunta(){
	var id = $("#select").val();
	tipo = "";
	var tabla = array_concepto['id'+id];
	if(tabla.tipo == 0){
			tipo = "Campo de texto"
		} else if(tabla.tipo == 1){
			tipo = "Lista de selección"
		} else {
			tipo = "Consulta"
		}

		var listado = '<tr id="row'+id_incremental+'"><td>'+tabla.pregunta+'</td>'
		+'<td>'+tipo+'</td>'
		+'<td><a href="#" class="btn btn-danger btn-sm remover" role="button" data-id="'+id_incremental+'">'+'<input type="hidden" name="concepto'+id_incremental+'" value="'+id+'">'
		+'<span class="glyphicon glyphicon-remove"></span></a></td></tr>';
		id_incremental ++;
		$("#table-body").append(listado);
		
		pregunta_asignado ++;
		
	
	$(".remover").on("click",remover);
}
function remover(){

	var id = $(this).attr("data-id");
	$( "#row"+id).remove();
	
		pregunta_asignado --;
		
}

function obtenerPregunta(){
		
		$.ajax({
			method:"POST",
			url: "php/obtener_pregunta_mtd.php",
			dataType: "json"
		}).done(function(data){
					
				var pregunta = "";
				data.pregunta.forEach(function(entry){
					pregunta += '<option value="'+entry.id+'">'+entry.pregunta+'</option>';
					
					if(typeof(array_concepto['id'+entry.id]) == "undefined"){
				 array_concepto['id'+entry.id] = {id: entry.id, pregunta: entry.pregunta, tipo : entry.tipo, activo:true};
				}
				
				});
				$("#select").append(pregunta);
				$('.selectpicker').selectpicker('refresh');
			
		}).fail(function(error){
			alert(error.responseText);
		});
		
	
   
}

function responsive_menu(){
	
   if($(window).width() < 800){
	   
	   $('.navbar-right').hide();
	   $('#fecha').css('width','60%');
   } else {
	   
	   $('.navbar-right').show();
	   
   }
	
}
$('#fecha').css('width','40%');

$(function(){
	obtenerPregunta();
	responsive_menu();
	$(window).resize(function(){
		responsive_menu();
	});

	$("#buscar").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#get_categoria tr").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});


	$("#formulario").submit(function(event){
		event.preventDefault();
		var formulario = $(this).serialize();
		if(validaForm()){	
				
				$.ajax({
				method: "POST",
				url: "php/nueva_seccion_mtd.php",
				dataType: "json",
				data: formulario 
				}).done(function(entry){
					
					if(entry.ingresado == 'true'){
						
						window.location.replace("seccion.php");
						
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error.responseText);
				});
			
		} 
	})
	
});