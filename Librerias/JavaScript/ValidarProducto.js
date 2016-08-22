$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codproducto').on('click',function(){
		$('#codproducto').popover('hide');
	});
	$('#descripcion').on('click',function(){
		$('#descripcion').popover('hide');
	});	
	$('#tipoproducto').on('click',function(){
		$('#tipoproducto').popover('hide');
	});	
	$('#stockmin').on('click',function(){
		$('#stockmin').popover('hide');
	});	
	$('#stockact').on('click',function(){
		$('#stockact').popover('hide');
	});	
	$('#stockmax').on('click',function(){
		$('#stockmax').popover('hide');
	});	
	$('#igv').on('click',function(){
		$('#igv ').popover('hide');
	});
	$('#precio').on('click',function(){
		$('#precio').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Producto");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'Producto/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODPRODUCTO'] == null){
			if (codigo[0]['codproducto']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codproducto']);
			}
		}else{
			if (codigo[0]['CODPRODUCTO']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODPRODUCTO']);
			}
		}
		$("#codproducto").val(codigo+1);
		$("#descripcion").removeAttr("disabled").focus();
		$("#descripcion").removeAttr("disabled");
		$("#tipoproducto").removeAttr("disabled");
		$("#stockmin").removeAttr("disabled");
		$("#stockact").removeAttr("disabled");
		$("#stockmax").removeAttr("disabled");
		$("#igv").removeAttr("disabled");
		$("#precio").removeAttr("disabled");

		$("#GuardarC").removeAttr("disabled");
		$("#CancelarC").removeAttr("disabled");

		$("#NuevoC").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codproducto").val('');
	$("#descripcion").val('');
	$("#tipoproducto > option[value='tipoproducto']").attr('selected', 'selected');
	$("#stockmin").val('');
	$("#stockact").val('');
	$("#stockmax").val('');
	$("#igv > option[value='igv']").attr('selected', 'selected');
	$("#precio").val('');

	$("#codproducto").attr("disabled","disabled");
	$("#descripcion").attr("disabled","disabled");
	$("#tipoproducto").attr("disabled","disabled");
	$("#stockmin").attr("disabled","disabled");
	$("#stockact").attr("disabled","disabled");
	$("#stockmax").attr("disabled","disabled");
	$("#igv").attr("disabled","disabled");
	$("#precio").attr("disabled","disabled");

	$("#GuardarC").attr("disabled","disabled");
	$("#ModificarC").attr("disabled","disabled");
	$("#CancelarC").attr("disabled","disabled");

	$("#NuevoC").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codproducto.value==""){
		$('#codproducto').focus();
		$('#codproducto').popover('show'); return 0;
	}
	if(obj.stockmin.value==""){
		$('#stockmin').focus();
		$('#stockmin').popover('show'); return 0;
	}
	if(obj.stockact.value==""){
		$('#stockact').focus();
		$('#stockact').popover('show'); return 0;
	}
	if(obj.stockmax.value==""){
		$('#stockmax').focus();
		$('#stockmax').popover('show'); return 0;
	}
	if(obj.tipoproducto.value=="tipoproducto"){
		$('#tipoproducto').focus();
		$('#tipoproducto').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	if(obj.igv.value=="igv"){
		$('#igv').focus();
		$('#igv').popover('show'); return 0;
	}
	if(obj.precio.value==""){
		$('#precio').focus();
		$('#precio').popover('show'); return 0;
	}
	$("#codproducto").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForProducto').serialize(),
		url:BASEURL+'Producto/Guardar',
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
		url:BASEURL+'Producto/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codproducto").val(datos[0]['codproducto']);
			$("#descripcion").val(datos[0]['descripcion']);
			$("#tipoproducto > option[value='"+datos[0]['codtipoproducto']+"']").attr('selected', 'selected');
			$("#stockmin").val(datos[0]['stockminimo']);
			$("#stockact").val(datos[0]['stockactual']);
			$("#stockmax").val(datos[0]['stockmaximo']);
			$("#igv > option[value='"+datos[0]['cobrarigv']+"']").attr('selected', 'selected');
			$("#precio").val(datos[0]['precio']);

			$("#descripcion").removeAttr("disabled").focus();
			$("#descripcion").removeAttr("disabled");
			$("#tipoproducto").removeAttr("disabled");
			$("#stockmin").removeAttr("disabled");
			$("#stockact").removeAttr("disabled");
			$("#stockmax").removeAttr("disabled");
			$("#igv").removeAttr("disabled");
			$("#precio").removeAttr("disabled");

			$("#ModificarC").removeAttr("disabled");
			$("#CancelarC").removeAttr("disabled");

			$("#NuevoC").attr("disabled","disabled");
			$("#GuardarC").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
	if(obj.codproducto.value==""){
		$('#codproducto').focus();
		$('#codproducto').popover('show'); return 0;
	}
	if(obj.descripcion.value==""){
		$('#descripcion').focus();
		$('#descripcion').popover('show'); return 0;
	}
	if(obj.tipoproducto.value=="tipoproducto"){
		$('#tipoproducto').focus();
		$('#tipoproducto').popover('show'); return 0;
	}
	if(obj.stockmin.value==""){
		$('#stockmin').focus();
		$('#stockmin').popover('show'); return 0;
	}
	if(obj.stockact.value==""){
		$('#stockact').focus();
		$('#stockact').popover('show'); return 0;
	}
	if(obj.stockmax.value==""){
		$('#stockmax').focus();
		$('#stockmax').popover('show'); return 0;
	}
	if(obj.igv.value=="igv"){
		$('#igv').focus();
		$('#igv').popover('show'); return 0;
	}
	if(obj.precio.value==""){
		$('#precio').focus();
		$('#precio').popover('show'); return 0;
	}
	$("#codproducto").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForProducto').serialize(),
		url:BASEURL+'Producto/Modificar',
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
			url:BASEURL+'Producto/Eliminar',
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
