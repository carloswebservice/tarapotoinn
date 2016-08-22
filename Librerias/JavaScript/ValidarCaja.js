$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codcaja').on('click',function(){
		$('#codcaja').popover('hide');
	});
	$('#fecha').on('click',function(){
		$('#fecha').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Caja");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Apertura(){
	$.ajax({
		url:BASEURL+'Caja/aperturar',
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});
		}
	});
}

function Caja(accion){
	$.ajax({
		url:BASEURL+'Caja/'+accion,
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});
		}
	});
}

function reportarmovimientos(obj){
	if (obj.fechahoy.value=="") {
		alert("Seleccione La Fecha");
        $('#fechahoy').focus(); return 0;
    }
    obj.submit();
}