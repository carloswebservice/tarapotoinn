$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codtipohabitacion').on('click',function(){
		$('#codtipohabitacion').popover('hide');
	});
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"TipoHabitacion");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'TipoHabitacion/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODTIPOHABITACION'] == null){
			if (codigo[0]['codtipohabitacion']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codtipohabitacion']);
			}
		}else{
			if (codigo[0]['CODTIPOHABITACION']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODTIPOHABITACION']);
			}
		}
		$("#codtipohabitacion").val(codigo+1);
		$("#descripcion").removeAttr("disabled").focus();
		$("#imagen").removeAttr("disabled").focus();

		$("#GuardarTH").removeAttr("disabled");
		$("#CancelarTH").removeAttr("disabled");

		$("#NuevoTH").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codtipohabitacion").val('');
	$("#descripcion").val('');
	$("#imagen").val('');

	$("#codtipohabitacion").attr("disabled","disabled");
	$("#descripcion").attr("disabled","disabled");
	$("#imagen").attr("disabled","disabled");

	$("#GuardarTH").attr("disabled","disabled");
	$("#ModificarTH").attr("disabled","disabled");
	$("#CancelarTH").attr("disabled","disabled");

	$("#NuevoTH").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codtipohabitacion.value==""){
		$('#codtipohabitacion').focus();
		$('#codtipohabitacion').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#imagen').focus();
		$('#imagen').popover('show'); return 0;
	}

	$("#codtipohabitacion").removeAttr("disabled");

	$.ajax({
		type:"POST",
		async:false,
		mimeType:"multipart/form-data",
		processData:false,
		cache:false,
		contentType:false,
		data:new FormData($("#ForTipoHabitacion")[0]),
		url:BASEURL+'TipoHabitacion/Guardar',
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
		url:BASEURL+'TipoHabitacion/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codtipohabitacion").val(datos[0]['codtipohabitacion']);
			$("#descripcion").val(datos[0]['descripcion']);

			$("#descripcion").removeAttr("disabled").focus();

			$("#ModificarTH").removeAttr("disabled");
			$("#CancelarTH").removeAttr("disabled");

			$("#NuevoTH").attr("disabled","disabled");
			$("#GuardarTH").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
	if(obj.codtipohabitacion.value==""){
		$('#codtipohabitacion').focus();
		$('#codtipohabitacion').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codtipohabitacion").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForTipoHabitacion').serialize(),
		url:BASEURL+'TipoHabitacion/Modificar',
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
			url:BASEURL+'TipoHabitacion/Eliminar',
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
