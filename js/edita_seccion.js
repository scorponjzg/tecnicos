var array_concepto= new Array();
var pregunta_asignado = 0;
var id_incremental = 1;
var bandera_eliminar = 0;
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

function eliminarPregunta(){

	var id = $(this).attr("data-id");
	
	if(bandera_eliminar == 0){
		bandera_eliminar = 1;
		if(confirm("¿Quiere dar de baja la pregunta?")){
		
			$.ajax({
			  method: "POST",
			  url: "php/baja_pregunta_asignada_mtd.php",
			  dataType: "json",
			  data: {"id": id}
			  
			}).done(function(data){
				
				if(data.eliminado == 'true'){
					alert("Pregunta eliminada correctamente");
					//window.location.href="servicio.php";
					$( "#"+id).remove();
					

				} else {

					alert(data.eliminado);
				}
				bandera_eliminar = 0;
				
				}).fail(function(error){
				   console.log(error)
					alert("Por el momento no esta disponible el servicio, intente m\u00E1s tarde");
					bandera_eliminar = 0;
					  
			});
		} else {

			setTimeout(function(){

				bandera_eliminar = 0;

			}, 3000);
		}

	} 

	
}

function obtenerSeccionId(){
	var seccion = getQueryVariable('seccion');
	$.ajax({

		method: "POST",
		url:"php/obtener_seccion_id_mtd.php",
		dataType: "json",
		data: {"seccion":seccion}

	}).done(function(data){
		
		$("#nombre").val(data.seccion.seccion);
		$("#identificador").val(data.seccion.id);
		var listado = "";

		data.seccion.pregunta.forEach(function(entry){

		listado = '<tr id="'+entry.id+'" style="background : #5bc0de;"><td>'+entry.pregunta+'</td>'
				+'<td>'+entry.tipo+'</td>'
				+'<td><a href="#" class="btn btn-danger btn-sm eliminarPregunta" role="button" data-id="'+entry.id+'">'+'<input type="hidden" value="'+entry.id+'">'
				+'<span class="glyphicon glyphicon-remove"></span></a></td></tr>';
				id_incremental ++;
				$("#table-body").append(listado);
				//array_concepto['id'+id_incremental].activo = false;
				pregunta_asignado ++;
		

	$(".eliminarPregunta").on("click",eliminarPregunta);


		});
		
		
	}).fail(function(error){
		console.log(error.responseText);

	});
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
		//array_concepto['id'+id_incremental].activo = false;
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
				obtenerSeccionId();
			
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

	//$("#categoria").on("change",obtenerMedicion);
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
				url: "php/edita_seccion_mtd.php",
				dataType: "json",
				data: formulario 
				}).done(function(entry){
					
					if(entry.editado == 'true'){
						alert("Seccion editada correctamente.");
						window.location.replace("seccion.php");
					} else {
						alert(entry.editado);
					}
				}).fail(function(error){
					console.log(error.responseText);
				});
			
		} 
	})
	
});