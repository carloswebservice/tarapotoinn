$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codtipoproducto').on('click',function(){
		$('#codtipoproducto').popover('hide');
	});
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"TipoProducto");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'TipoProducto/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODTIPOPRODUCTO'] == null){
			if (codigo[0]['codtipoproducto']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codtipoproducto']);
			}
		}else{
			if (codigo[0]['CODTIPOPRODUCTO']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODTIPOPRODUCTO']);
			}
		}
		$("#codtipoproducto").val(codigo+1);
		$("#descripcion").removeAttr("disabled").focus();

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codtipoproducto").val('');
	$("#descripcion").val('');

	$("#codtipoproducto").attr("disabled","disabled");
	$("#descripcion").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codtipoproducto.value==""){
		$('#codtipoproducto').focus();
		$('#codtipoproducto').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codtipoproducto").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForTipoProducto').serialize(),
		url:BASEURL+'TipoProducto/Guardar',
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
		url:BASEURL+'TipoProducto/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codtipoproducto").val(datos[0]['codtipoproducto']);
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
	if(obj.codtipoproducto.value==""){
		$('#codtipoproducto').focus();
		$('#codtipoproducto').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codtipoproducto").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForTipoProducto').serialize(),
		url:BASEURL+'TipoProducto/Modificar',
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
			url:BASEURL+'TipoProducto/Eliminar',
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
