$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codtipomovimiento').on('click',function(){
		$('#codtipomovimiento').popover('hide');
	});
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"TipoMovimiento");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'TipoMovimiento/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODTIPOMOVIMIENTO'] == null){
			if (codigo[0]['codtipomovimiento']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codtipomovimiento']);
			}
		}else{
			if (codigo[0]['CODTIPOMOVIMIENTO']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODTIPOMOVIMIENTO']);
			}
		}
		$("#codtipomovimiento").val(codigo+1);
		$("#descripcionmov").removeAttr("disabled").focus();

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codtipomovimiento").val('');
	$("#descripcionmov").val('');

	$("#codtipomovimiento").attr("disabled","disabled");
	$("#descripcionmov").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codtipomovimiento.value==""){
		$('#codtipomovimiento').focus();
		$('#codtipomovimiento').popover('show'); return 0;
	}
	if(obj.descripcionmov.value==""){
		$('#descripcionmov').focus();
		$('#descripcionmov').popover('show'); return 0;
	}
	$("#codtipomovimiento").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForTipoMovimiento').serialize(),
		url:BASEURL+'TipoMovimiento/Guardar',
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
		url:BASEURL+'TipoMovimiento/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codtipomovimiento").val(datos[0]['codtipomovimiento']);
			$("#descripcionmov").val(datos[0]['descripcionmov']);

			$("#descripcionmov").removeAttr("disabled").focus();

			$("#ModificarC").removeAttr("disabled");
			$("#CancelarC").removeAttr("disabled");

			$("#NuevoC").attr("disabled","disabled");
			$("#GuardarC").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
	if(obj.codtipomovimiento.value==""){
		$('#codtipomovimiento').focus();
		$('#codtipomovimiento').popover('show'); return 0;
	}
	if(obj.descripcionmov.value==""){
		$('#descripcionmov').focus();
		$('#descripcionmov').popover('show'); return 0;
	}
	$("#codtipomovimiento").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForTipoMovimiento').serialize(),
		url:BASEURL+'TipoMovimiento/Modificar',
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
			url:BASEURL+'TipoMovimiento/Eliminar',
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
