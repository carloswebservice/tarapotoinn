$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codtipocomprobante').on('click',function(){
		$('#codtipocomprobante').popover('hide');
	});
	$('#serie').on('click',function(){
		$('#serie').popover('hide');
	});	
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"TipoComprobante");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'TipoComprobante/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODTIPOCOMPROBANTE'] == null){
			if (codigo[0]['codtipocomprobante']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codtipocomprobante']);
			}
		}else{
			if (codigo[0]['CODTIPOCOMPROBANTE']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODTIPOCOMPROBANTE']);
			}
		}
		$("#codtipocomprobante").val(codigo+1);
		$("#serie").removeAttr("disabled").focus();
		$("#descripcion").removeAttr("disabled");

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codtipocomprobante").val('');
	$("#serie").val('');
	$("#descripcion").val('');

	$("#codtipohabitacion").attr("disabled","disabled");
	$("#serie").attr("disabled","disabled");
	$("#descripcion").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codtipocomprobante.value==""){
		$('#codtipocomprobante').focus();
		$('#codtipocomprobante').popover('show'); return 0;
	}
	if(obj.serie.value==""){
		$('#serie').focus();
		$('#serie').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codtipocomprobante").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForTipoComprobante').serialize(),
		url:BASEURL+'TipoComprobante/Guardar',
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
		url:BASEURL+'TipoComprobante/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codtipocomprobante").val(datos[0]['codtipocomprobante']);
			$("#serie").val(datos[0]['serie']);
			$("#descripcion").val(datos[0]['descripcion']);

			$("#serie").removeAttr("disabled").focus();
			$("#descripcion").removeAttr("disabled");

			$("#ModificarC").removeAttr("disabled");
			$("#CancelarC").removeAttr("disabled");

			$("#NuevoC").attr("disabled","disabled");
			$("#GuardarC").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
	if(obj.codtipocomprobante.value==""){
		$('#codtipocomprobante').focus();
		$('#codtipocomprobante').popover('show'); return 0;
	}
	if(obj.serie.value==""){
		$('#serie').focus();
		$('#serie').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codtipocomprobante").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForTipoComprobante').serialize(),
		url:BASEURL+'TipoComprobante/Modificar',
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
			url:BASEURL+'TipoComprobante/Eliminar',
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
