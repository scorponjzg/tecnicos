
function obtener_parametro(){
		

		$.ajax({
			method: "POST",
			url: "php/obtener_pregunta_mtd.php",
			dataType:"json"
		}).done(function(data){
			
			var resultado = "";
			data.pregunta.forEach(function(entry){
				//console.log(entry);
				var tipo = "Campo de texto";
				if(entry.tipo == 1){

					tipo = "Campo de selección"
				} else if (entry.tipo == 2){

					tipo = "Consulta";
				}

			resultado += '<tr><td>' + entry.pregunta + '</td>'+
							 '<td>' + tipo + '</td>';

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
  
	window.location.replace("editar_pregunta.php?"+btoa("pregunta="+$(this).attr("data-id")));
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
		$("#get_parametro tr").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
	
});