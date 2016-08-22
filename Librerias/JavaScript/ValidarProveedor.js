$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codproveedor').on('click',function(){
		$('#codproveedor').popover('hide');
	});
	$('#ruc').on('click',function(){
		$('#ruc').popover('hide');
	});	
	$('#razonsocial').on('click',function(){
		$('#razonsocial').popover('hide');
	});	
	$('#celular').on('click',function(){
		$('#celular').popover('hide');
	});	
	$('#direccion').on('click',function(){
		$('#direccion').popover('hide');
	});	
	$('#email').on('click',function(){
		$('#email').popover('hide');
	});	
	$('#telefono').on('click',function(){
		$('#telefono').popover('hide');
	});	
	$('#rpm').on('click',function(){
		$('#rpm').popover('hide');
	});	
	$('#zona').on('click',function(){
		$('#zona').popover('hide');
	});
	$('#rpc').on('click',function(){
		$('#rpc').popover('hide');
	});		
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Proveedor");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'Proveedor/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODPROVEEDOR'] == null){
			if (codigo[0]['codproveedor']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codproveedor']);
			}
		}else{
			if (codigo[0]['CODPROVEEDOR']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODPROVEEDOR']);
			}
		}
		$("#codproveedor").val(codigo+1);
		$("#ruc").removeAttr("disabled").focus();
		$("#razonsocial").removeAttr("disabled");
		$("#celular").removeAttr("disabled");
		$("#direccion").removeAttr("disabled");
		$("#email").removeAttr("disabled");
		$("#telefono").removeAttr("disabled");
		$("#rpm").removeAttr("disabled");
		$("#rpc").removeAttr("disabled");
		$("#zona").removeAttr("disabled");

		$("#GuardarE").removeAttr("disabled");
		$("#CancelarE").removeAttr("disabled");

		$("#NuevoE").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codproveedor").val('');
	$("#razonsocial").val('');
	$("#ruc").val('');
	$("#direccion").val('');
	$("#email").val('');
	$("#telefono").val('');
	$("#celular").val('');
	$("#rpm").val('');
	$("#rpc").val('');
	$("#zona").val('');

	$("#codproveedor").attr("disabled","disabled");
	$("#razonsocial").attr("disabled","disabled");
	$("#ruc").attr("disabled","disabled");
	$("#direccion").attr("disabled","disabled");
	$("#email").attr("disabled","disabled");
	$("#telefono").attr("disabled","disabled");
	$("#celular").attr("disabled","disabled");
	$("#rpm").attr("disabled","disabled");
	$("#rpc").attr("disabled","disabled");
	$("#zona").attr("disabled","disabled");
	
	$("#GuardarE").attr("disabled","disabled");
	$("#ModificarE").attr("disabled","disabled");
	$("#CancelarE").attr("disabled","disabled");

	$("#NuevoE").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codproveedor.value==""){
		$('#codproveedor').focus();
		$('#codproveedor').popover('show'); return 0;
	}
	if(obj.ruc.value=="" || obj.ruc.value.length<11){
		$('#ruc').focus();
		$('#ruc').popover('show'); return 0;
	}
	if(obj.razonsocial.value==""){
		$('#razonsocial').focus();
		$('#razonsocial').popover('show'); return 0;
	}
	if(obj.celular.value=="" || obj.celular.value.length<9){
		$('#celular').focus();
		$('#celular').popover('show'); return 0;
	}
	if(obj.direccion.value==""){
		$('#direccion').focus();
		$('#direccion').popover('show'); return 0;
	}
	if(obj.email.value==""){
		$('#email').popover('show'); return 0;
	}else{
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        if(!regex.test($('#email').val().trim())) {
            $('#email').popover('show'); return 0;
        }
	}
	if(obj.telefono.value=="" || obj.telefono.value.length<6){
		$('#telefono').focus();
		$('#telefono').popover('show'); return 0;
	}
	if(obj.rpm.value=="" || obj.rpm.value.length<10){
		$('#rpm').focus();
		$('#rpm').popover('show'); return 0;
	}
	if(obj.zona.value==""){
		$('#zona').focus();
		$('#zona').popover('show'); return 0;
	}
	if(obj.rpc.value=="" || obj.rpc.value.length<10){
		$('#rpc').focus();
		$('#rpc').popover('show'); return 0;
	}

	$("#codproveedor").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForProveedor').serialize(),
		url:BASEURL+'Proveedor/Guardar',
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});
		}
	});
}

function RUCempresa(qq){
	ruc = $(qq).val();
	
	$.get("Proveedor/RUCempresa",{'ruc':ruc},function(data){
		if (data == "1"){
				alert("EL PROV PROVEEDOR YA ESTA REGISTRADA")
				$(qq).val("");
		}
	},'json');

}

function Modifica(codigo){
	$.ajax({
		url:BASEURL+'Proveedor/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codproveedor").val(datos[0]['codproveedor']);
			$("#razonsocial").val(datos[0]['razonsocial']);
			$("#ruc").val(datos[0]['ruc']);
			$("#direccion").val(datos[0]['direccion']);
			$("#email").val(datos[0]['email']);
			$("#telefono").val(datos[0]['telefono']);
			$("#celular").val(datos[0]['celular']);
			$("#rpm").val(datos[0]['rpm']);
			$("#rpc").val(datos[0]['rpc']);
			$("#epb").val(datos[0]['epb']);
			$("#zona").val(datos[0]['zonareferencial']);

			$("#razonsocial").removeAttr("disabled").focus();
			$("#ruc").removeAttr("disabled");
			$("#direccion").removeAttr("disabled");
			$("#email").removeAttr("disabled");
			$("#telefono").removeAttr("disabled");
			$("#celular").removeAttr("disabled");
			$("#rpm").removeAttr("disabled");
			$("#rpc").removeAttr("disabled");
			$("#epb").removeAttr("disabled");
			$("#zona").removeAttr("disabled");

			$("#ModificarE").removeAttr("disabled");
			$("#CancelarE").removeAttr("disabled");

			$("#NuevoE").attr("disabled","disabled");
			$("#GuardarE").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
		if(obj.codproveedor.value==""){
		$('#codproveedor').focus();
		$('#codproveedor').popover('show'); return 0;
	}
	if(obj.ruc.value=="" || obj.ruc.value.length<11){
		$('#ruc').focus();
		$('#ruc').popover('show'); return 0;
	}
	if(obj.razonsocial.value==""){
		$('#razonsocial').focus();
		$('#razonsocial').popover('show'); return 0;
	}
	if(obj.celular.value=="" || obj.celular.value.length<9){
		$('#celular').focus();
		$('#celular').popover('show'); return 0;
	}
	if(obj.direccion.value==""){
		$('#direccion').focus();
		$('#direccion').popover('show'); return 0;
	}
	if(obj.email.value==""){
		$('#email').popover('show'); return 0;
	}else{
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        if(!regex.test($('#email').val().trim())) {
            $('#email').popover('show'); return 0;
        }
	}
	if(obj.telefono.value=="" || obj.telefono.value.length<6){
		$('#telefono').focus();
		$('#telefono').popover('show'); return 0;
	}
	if(obj.rpm.value=="" || obj.rpm.value.length<10){
		$('#rpm').focus();
		$('#rpm').popover('show'); return 0;
	}
	if(obj.zona.value==""){
		$('#zona').focus();
		$('#zona').popover('show'); return 0;
	}
	if(obj.rpc.value=="" || obj.rpc.value.length<10){
		$('#rpc').focus();
		$('#rpc').popover('show'); return 0;
	}
	
	$("#codproveedor").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForProveedor').serialize(),
		url:BASEURL+'Proveedor/Modificar',
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
			url:BASEURL+'Proveedor/Eliminar',
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
