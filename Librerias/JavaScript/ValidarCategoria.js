$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codcategoria').on('click',function(){
		$('#codcategoria').popover('hide');
	});
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Categoria");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'Categoria/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODCATEGORIA'] == null){
			if (codigo[0]['codcategoria']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codcategoria']);
			}
		}else{
			if (codigo[0]['CODCATEGORIA']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODCATEGORIA']);
			}
		}

		$("#codcategoria").val(codigo+1);
		$("#descripcion").removeAttr("disabled").focus();

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codcategoria").val('');
	$("#descripcion").val('');

	$("#codcategoria").attr("disabled","disabled");
	$("#descripcion").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codcategoria.value==""){
		$('#codcategoria').focus();
		$('#codcategoria').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codcategoria").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForCategoria').serialize(),
		url:BASEURL+'Categoria/Guardar',
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
		url:BASEURL+'Categoria/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codcategoria").val(datos[0]['codcategoria']);
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
	if(obj.codcategoria.value==""){
		$('#codcategoria').focus();
		$('#codcategoria').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codcategoria").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForCategoria').serialize(),
		url:BASEURL+'Categoria/Modificar',
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
			url:BASEURL+'Categoria/Eliminar',
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
