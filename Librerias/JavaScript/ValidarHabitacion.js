$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codhabitacion').on('click',function(){
		$('#codhabitacion').popover('hide');
	});
	$('#numero').on('click',function(){
		$('#numero').popover('hide');
	});	
	$('#tipohabitacion').on('click',function(){
		$('#tipohabitacion').popover('hide');
	});	
	$('#tarifa').on('click',function(){
		$('#tarifa').popover('hide');
	});	
	$('#articulo').on('click',function(){
		$('#articulo').popover('hide');		
	});
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Habitacion");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$("#ContenidoPrincipal").load(BASEURL+"Habitacion/nuevo");
}

function Cancelar(){
	$("#ContenidoPrincipal").load(BASEURL+"Habitacion");
}

function Seleccionado(cod){
	$.ajax({
		url:BASEURL+'Habitacion/Seleccion',
		type:"POST",
		data:'seleccionar='+cod,
		success: function(data){
			var datos = eval(data);
			$("#codarticulo").val(datos[0]['codarticulo']);
			$("#articulo").val(datos[0]['descripcionart']);
		}
	});
}

function Verhabitacion(codhabitacion){
    $("#ContenidoPrincipal").load(BASEURL + "Habitacion/Verhabitacion",{id:codhabitacion});
}

function Agregar(obj){
	if(obj.articulo.value==""){
		$('#articulo').focus();
		$('#articulo').popover('show'); return 0;
	}

	if($("#Articulo_"+$("#codarticulo").val()).length==false){
		html ="<tr id='Articulo_"+$("#codarticulo").val()+"'>"+
		"<td> <input type='hidden' name='idarticulo[]' value='"+$("#codarticulo").val()+"'> "+$("#codarticulo").val()+"</td>"+
		"<td> "+$("#articulo").val()+"</td>"+
		"<td><a onclick=$(this).closest('tr').remove();><span class='glyphicon glyphicon-remove' style='color:#D01111'></span> </a></td></tr>";

		$("#tablaarticulos tbody").append(html);
	}else{
		alert("Ya Agrego Este Articulo");
	}
}

function nrohabitacion(qq){
	numero = $(qq).val();
	
	$.get("Habitacion/nrohabitacion",{'nrohabitacion':numero},function(data){
		if (data == "1"){
				alert("LA HABITACION YA ESTA REGISTRADA")
				$(qq).val("");
		}
	},'json');
}

function Guardar(obj){
	if(obj.numero.value==""){
		$('#numero').focus();
		$('#numero').popover('show'); return 0;
	}
	if(obj.tipohabitacion.value=="tipohabitacion"){
		$('#tipohabitacion').focus();
		$('#tipohabitacion').popover('show'); return 0;
	}
	if(obj.tarifa.value==""){
		$('#tarifa').focus();
		$('#tarifa').popover('show'); return 0;
	}
	
	$.ajax({
		type:"POST",
		data:$('#ForHabitacion').serialize(),
		url:BASEURL+"Habitacion/GuardarHabitacion",
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});	
		}
	});
}

function Actualizar(obj){
	if(obj.tarifa.value==""){
		$('#tarifa').focus();
		$('#tarifa').popover('show'); return 0;
	}
	
	$.ajax({
		type:"POST",
		data:$('#articulosnuevo').serialize(),
		url:BASEURL+"Habitacion/ActualizarHabitacion",
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});	
		}
	});
}

function EliminarAH(hab,art){
	if (confirm('Seguro Que Desea Eliminar')==true) {
		$.ajax({
			type:"POST",
			data:"codhabi="+hab+"&codarticulo="+art,
			url:BASEURL+"Habitacion/Eliminarartic",
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