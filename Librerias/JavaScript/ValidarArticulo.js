$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codarticulo').on('click',function(){
		$('#codarticulo').popover('hide');
	});
	$('#categoria').on('click',function(){
		$('#categoria').popover('hide');
	});	
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Articulo");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'Articulo/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODARTICULO'] == null){
			if (codigo[0]['codarticulo']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codarticulo']);
			}
		}else{
			if (codigo[0]['CODARTICULO']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODARTICULO']);
			}
		}
		$("#codarticulo").val(codigo+1);
		$("#categoria").removeAttr("disabled").focus();
		$("#descripcion").removeAttr("disabled");

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codarticulo").val('');
	$("#categoria > option[value='categoria']").attr('selected', 'selected');
	$("#descripcion").val('');

	$("#codtipohabitacion").attr("disabled","disabled");
	$("#categoria").attr("disabled","disabled");
	$("#descripcion").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codarticulo.value==""){
		$('#codarticulo').focus();
		$('#codarticulo').popover('show'); return 0;
	}
	if(obj.categoria.value=="categoria"){
		$('#categoria').focus();
		$('#categoria').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codarticulo").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForArticulo').serialize(),
		url:BASEURL+'Articulo/Guardar',
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
		url:BASEURL+'Articulo/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codarticulo").val(datos[0]['codarticulo']);
			$("#categoria > option[value='"+datos[0]['codcategoria']+"']").attr('selected', 'selected');
			$("#descripcion").val(datos[0]['descripcionart']);

			$("#categoria").removeAttr("disabled").focus();
			$("#descripcion").removeAttr("disabled");

			$("#ModificarC").removeAttr("disabled");
			$("#CancelarC").removeAttr("disabled");

			$("#NuevoC").attr("disabled","disabled");
			$("#GuardarC").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
	if(obj.codarticulo.value==""){
		$('#codarticulo').focus();
		$('#codarticulo').popover('show'); return 0;
	}
	if(obj.categoria.value=="categoria"){
		$('#categoria').focus();
		$('#categoria').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	$("#codarticulo").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForArticulo').serialize(),
		url:BASEURL+'Articulo/Modificar',
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
			url:BASEURL+'Articulo/Eliminar',
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
