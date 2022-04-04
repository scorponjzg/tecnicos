
function obtener_parametro(){
		

		$.ajax({
			method: "POST",
			url: "php/obtener_seccion_mtd.php",
			dataType:"json"
		}).done(function(data){
			var resultado = "";
			
			data.seccion.forEach(function(entry){
				
			var preguntas = "";	

				entry.pregunta.forEach(function(pregunta){

					preguntas += pregunta.pregunta + "<br>";

				});

			resultado += '<tr><td>'+entry.seccion+'</td>'+
							 '<td>'+preguntas+'</td>';
			if(data.show == 'true'){
				resultado += '<td><a href="#" class="btn btn-default ver" role="button" data-id="'+entry.id+'">'+
					  '<span class="glyphicon glyphicon-eye-open"></span></a></td>';
			}
						resultado += '</tr>';
			
		    } );
		    
			$('#get_parametro').empty();
			$('#get_parametro').append(resultado);
			$(".ver").on("click",verDetalle);
			

			
		}).fail(function(error){
			alert("Funcionalidad no disponible por el momento, intente mas tarde");
			
		});
   
}

function verDetalle(){
  
	window.location.replace("editar_seccion.php?"+btoa("seccion="+$(this).attr("data-id")));
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
	responsive_menu();
	$(window).resize(function(){
		responsive_menu();
	});
	obtener_parametro();

	$("#buscar").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#get_cliente tr").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
	
});