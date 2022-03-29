
var resolucion = "60%";

function obtenerUsuario(){
	limpia_tabla();
	
	$.ajax({
	  method: "POST",
	  url: "php/obtener_usuario_mtd.php",
	  dataType: "json"
	  
	}).done(function(data){
		
		$("#nombre_usuario").html(data.nombre);
		var fila = "";
		var credencial = '';
		var referencia = '';
		data.usuario.forEach(function(entry){
			
			fila += '<tr class="success" id="row'+entry.identificador+'">'+
			'<td><b>'+safe_tags_replace(entry.nombre)+'</b></td>'+
			'<td><b>'+safe_tags_replace(entry.telefono)+'</b></td>'+
			'<td><b>'+safe_tags_replace(entry.correo)+'</b></td>'+
			'<td style="text-align: center;"><button id="ver'+entry.identificador+'" type="button" class="btn btn-success actualizar" data-codigo="'+entry.identificador+'" data-accion="1" style="width:'+resolucion+'; color: white; padding: 0 0 0 0;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>'+
			'<td style="text-align: center;"><button id="baja'+entry.identificador+'" type="button" class="btn btn-danger baja" data-codigo="'+entry.identificador+'" data-accion="1" style="width:'+resolucion+'; color: white; padding: 0 0 0 0;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
			
	});
					 
	$("#reporte").append(fila);
	//$("#info").append(credencial);
	$(".actualizar").on('click',actualizar);
	$(".baja").on('click',baja);
				
		
	}).fail(function(error){
	  console.log(error)
			alert("Por el momento no esta disponible el servicio, intente m\u00E1s tarde");
		  
	});
}

function actualizar(){
	
	//alert("se están realizando midificaciones, por el momento no disponible")
	var identificador = $(this).attr("data-codigo");
	identificador = btoa("identificador="+identificador)
	window.location.replace("editar_usuario.php?"+identificador);
}

var tagsToReplace = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;'
};

function replaceTag(tag) {
    return tagsToReplace[tag] || tag;
}

function safe_tags_replace(str) {
    return str.replace(/[&<>]/g, replaceTag);
}


function baja(){
	var id = $(this).attr("data-codigo");
	console.log(id);
	if(confirm("¿Quiere dar de baja al usuario?")){
		$.ajax({
		  method: "POST",
		  url: "php/baja_usuario_mtd.php",
		  dataType: "json",
		  data: {"id": id}
		  
		}).done(function(data){

			if(data.eliminado == 'true'){
				alert("Empleado eliminado correctamente");
				//window.location.href="servicio.php";
				$("#row"+id).remove();
			} else {

				alert(data.eliminado);
			}
			
			
			}).fail(function(error){
			   console.log(error)
				alert("Por el momento no esta disponible el servicio, intente m\u00E1s tarde");
				  
		});
	}
}

function llenar_tabla(reporte){
	
	};
	
function nuevoUsuario(){
	
	window.location.replace("nuevo_usuario.php");
}



function resolucion_pantalla(){	
    
	if (screen.width<1024){
		
		$(".panel-default").css("width","100%");
	    $(".panel-default").css("margin-top","100px");
		resolucion = "100%"
	}
		   	
}

function limpia_tabla(){
	$("#reporte").empty();
}

$(function(){
	obtenerUsuario();
	
	resolucion_pantalla();
	$("#servicio").on("change",limpia_tabla);
    
	$("#nuevo").on('click',nuevoUsuario);	

	$("#buscar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#reporte tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });	
	
});