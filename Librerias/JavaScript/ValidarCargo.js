$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codcargo').on('click',function(){
		$('#codcargo').popover('hide');
	});
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Cargo");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'Cargo/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODCARGO'] == null){
			if (codigo[0]['codcargo']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codcargo']);
			}
		}else{
			if (codigo[0]['CODCARGO']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODCARGO']);
			}
		}
		$("#codcargo").val(codigo+1);
		$("#descripcion").removeAttr("disabled").focus();

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codcargo").val('');
	$("#descripcion").val('');

	$("#codcargo").attr("disabled","disabled");
	$("#descripcion").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codcargo.value==""){
		$('#codcargo').focus();
		$('#codcargo').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codcargo").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForCargo').serialize(),
		url:BASEURL+'Cargo/Guardar',
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
		url:BASEURL+'Cargo/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codcargo").val(datos[0]['codcargo']);
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
	if(obj.codcargo.value==""){
		$('#codcargo').focus();
		$('#codcargo').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codcargo").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForCargo').serialize(),
		url:BASEURL+'Cargo/Modificar',
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
			url:BASEURL+'Cargo/Eliminar',
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
