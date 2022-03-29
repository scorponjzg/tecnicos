var array_concepto= new Array();
var pregunta_asignado = 0;
var id_incremental = 1;
function validaForm(){
	var correcto = false;
	 if($("#nombre").val() == ''){
		alert("Debe de ingresar el nombre del parametro");
		$("#nombre").focus();
	}else if(pregunta_asignado == 0){
		alert("Debe asignar por lo menos un concepto");
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
	//if(tabla.activo == true){
		var listado = '<tr id="row'+id_incremental+'"><td>'+tabla.pregunta+'</td>'
		+'<td>'+tipo+'</td>'
		+'<td><a href="#" class="btn btn-danger btn-sm remover" role="button" data-id="'+id_incremental+'">'+'<input type="hidden" name="concepto'+id_incremental+'" value="'+id+'">'
		+'<span class="glyphicon glyphicon-remove"></span></a></td></tr>';
		id_incremental ++;
		$("#table-body").append(listado);
		//array_concepto['id'+id_incremental].activo = false;
		pregunta_asignado ++;
		
	//}
	$(".remover").on("click",remover);
}
function remover(){

	var id = $(this).attr("data-id");
	$( "#row"+id).remove();
	
	//if(array_concepto['id'+id].activo == false){
		
		pregunta_asignado --;
	//}
	//array_concepto['id'+id].activo = true;
		
}
function obtenerSeccion(){
		
		$.ajax({
			method:"POST",
			url: "php/obtener_pregunta_mtd.php",
			dataType: "json"
		}).done(function(data){
			console.log(data);
					
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
	obtenerSeccion();
	responsive_menu();
	$(window).resize(function(){
		responsive_menu();
	});

	//$("#categoria").on("change",obtenerMedicion);
	$("#buscar").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#get_categoria tr").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});


	$("#formulario").submit(function(event){
		event.preventDefault();
		//console.log(estudios);
		var formulario = $(this).serialize();
		console.log(formulario);
		if(validaForm()){	
				
				$.ajax({
				method: "POST",
				url: "php/nuevo_parametro_mtd.php",
				dataType: "json",
				data: formulario 
				}).done(function(entry){
					console.log(entry);
					if(entry.ingresado == 'true'){
						//alert("Orden creada correctamente.");
						//window.open('imprimir_orden.php?orden='+entry.nueva, '_self');
						window.location.replace("parametros.php");
					} else {
						alert(entry.ingresado);
					}
				}).fail(function(error){
					console.log(error.responseText);
				});
			
		} 
	})
	
});