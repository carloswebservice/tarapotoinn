$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codconcepto').on('click',function(){
		$('#codconcepto').popover('hide');
	});
	$('#tipomovimiento').on('click',function(){
		$('#tipomovimiento').popover('hide');
	});
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Concepto");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'Concepto/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODCONCEPTO'] == null){
			if (codigo[0]['codconcepto']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codconcepto']);
			}
		}else{
			if (codigo[0]['CODCONCEPTO']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODCONCEPTO']);
			}
		}
		$("#codconcepto").val(codigo+1);
		$("#tipomovimiento").removeAttr("disabled").focus();
		$("#descripcion").removeAttr("disabled").focus();

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codconcepto").val('');
	$("#tipomovimiento").val('');
	$("#descripcion").val('');

	$("#codconcepto").attr("disabled","disabled");
	$("#tipomovimiento> option[value='tipomovimiento']").attr('selected', 'selected');
	$("#descripcion").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codconcepto.value==""){
		$('#codconcepto').focus();
		$('#codconcepto').popover('show'); return 0;
	}
	if(obj.tipomovimiento.value=="tipomovimiento"){
		$('#tipomovimiento').focus();
		$('#tipomovimiento').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codconcepto").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForConceptos').serialize(),
		url:BASEURL+'Concepto/Guardar',
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
		url:BASEURL+'Concepto/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codconcepto").val(datos[0]['codconcepto']);
			$("#tipomovimiento > option[value='"+datos[0]['codtipomovimiento']+"']").attr('selected', 'selected');
			$("#descripcion").val(datos[0]['descripcion']);

			$("#tipomovimiento").removeAttr("disabled");
			$("#descripcion").removeAttr("disabled").focus();

			$("#ModificarC").removeAttr("disabled");
			$("#CancelarC").removeAttr("disabled");

			$("#NuevoC").attr("disabled","disabled");
			$("#GuardarC").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
	if(obj.codconcepto.value==""){
		$('#codconcepto').focus();
		$('#codconcepto').popover('show'); return 0;
	}
	if(obj.tipomovimiento.value=="tipomovimiento"){
		$('#tipomovimiento').focus();
		$('#tipomovimiento').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codconcepto").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForConceptos').serialize(),
		url:BASEURL+'Concepto/Modificar',
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
			url:BASEURL+'Concepto/Eliminar',
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
