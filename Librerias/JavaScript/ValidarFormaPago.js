$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codformapago').on('click',function(){
		$('#codformapago').popover('hide');
	});
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"FormaPago");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'FormaPago/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODFORMAPAGO'] == null){
			if (codigo[0]['codformapago']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codformapago']);
			}
		}else{
			if (codigo[0]['CODFORMAPAGO']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODFORMAPAGO']);
			}
		}
		$("#codformapago").val(codigo+1);
		$("#descripcion").removeAttr("disabled").focus();

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codformapago").val('');
	$("#descripcion").val('');

	$("#codformapago").attr("disabled","disabled");
	$("#descripcion").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codformapago.value==""){
		$('#codformapago').focus();
		$('#codformapago').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codformapago").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForFormaPago').serialize(),
		url:BASEURL+'FormaPago/Guardar',
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});
		}
	});
}

function Modifica(codigo){
	$.ajax({
		url:BASEURL+'FormaPago/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codformapago").val(datos[0]['codformapago']);
			$("#descripcion").val(datos[0]['descripcion']);

			$("#descripcion").removeAttr("disabled").focus();

			$("#ModificarC").removeAttr("disabled");
			$("#CancelarC").removeAttr("disabled");

			$("#NuevoC").attr("disabled","disabled");
			$("#GuardarC").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
	if(obj.codformapago.value==""){
		$('#codformapago').focus();
		$('#codformapago').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codformapago").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForFormaPago').serialize(),
		url:BASEURL+'FormaPago/Modificar',
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});	
		}
	});
}
function Eliminar(codigo){
	if (confirm('Seguro Que Desea Eliminar')==true) {
		$.ajax({
			url:BASEURL+'FormaPago/Eliminar',
			type:"POST",
			data:'eliminar='+codigo,		
			success: function(data){
				$("#Mensaje").html(data);
				$('#Alerta').modal({
					show:true,
					backdrop:'static'
				});	
			}
		});
	}
}
