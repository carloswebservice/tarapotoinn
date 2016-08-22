
$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codempleado').on('click',function(){
		$('#codempleado').popover('hide');
	});
	$('#dni').on('click',function(){
		$('#dni').popover('hide');
	});	
	$('#direccion').on('click',function(){
		$('#direccion').popover('hide');
	});	
	$('#nombre').on('click',function(){
		$('#nombre').popover('hide');
	});	
	$('#apellidop').on('click',function(){
		$('#apellidop').popover('hide');
	});	
	$('#apellidom').on('click',function(){
		$('#apellidom').popover('hide');
	});	
	$('#email').on('click',function(){
		$('#email').popover('hide');
	});	
	$('#telefono').on('click',function(){
		$('#telefono').popover('hide');
	});	
	$('#celular').on('click',function(){
		$('#celular').popover('hide');
	});	
	$('#zona').on('click',function(){
		$('#zona').popover('hide');
	});	
	$('#cargo').on('click',function(){
		$('#cargo').popover('hide');
	});	
	$('#estadocivil').on('click',function(){
		$('#estadocivil').popover('hide');
	});	
	$('#sexo').on('click',function(){
		$('#sexo').popover('hide');
	});	
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Empleado");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$.ajax({
		url:BASEURL+'Empleado/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODEMPLEADO'] == null){
			if (codigo[0]['codempleado']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codempleado']);
			}
		}else{
			if (codigo[0]['CODEMPLEADO']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODEMPLEADO']);
			}
		}
		$("#codempleado").val(codigo+1);
		$("#dni").removeAttr("disabled");
		$("#direccion").removeAttr("disabled");
		$("#nombre").removeAttr("disabled").focus();
		$("#apellidop").removeAttr("disabled");
		$("#apellidom").removeAttr("disabled");
		$("#email").removeAttr("disabled");
		$("#telefono").removeAttr("disabled");
		$("#celular").removeAttr("disabled");
		$("#zona").removeAttr("disabled");
		$("#cargo").removeAttr("disabled");
		$("#estadocivil").removeAttr("disabled");
		$("#sexo").removeAttr("disabled");

		$("#GuardarE").removeAttr("disabled");
		$("#CancelarE").removeAttr("disabled");

		$("#NuevoE").attr("disabled","disabled");			
	});
}

function Cancelar(){
	$("#codempleado").val('');
	$("#dni").val('');
	$("#direccion").val('');
	$("#nombre").val('');
	$("#apellidop").val('');
	$("#apellidom").val('');
	$("#email").val('');
	$("#telefono").val('');
	$("#celular").val('');
	$("#zona").val('');
	$("#cargo > option[value='cargo']").attr('selected', 'selected');
	$("#estadocivil > option[value='estadocivil']").attr('selected', 'selected');
	$("#sexo > option[value='sexo']").attr('selected', 'selected');

	$("#codempleado").attr("disabled","disabled");
	$("#dni").attr("disabled","disabled");
	$("#direccion").attr("disabled","disabled");
	$("#nombre").attr("disabled","disabled");
	$("#apellidop").attr("disabled","disabled");
	$("#apellidom").attr("disabled","disabled");
	$("#email").attr("disabled","disabled");
	$("#telefono").attr("disabled","disabled");
	$("#celular").attr("disabled","disabled");
	$("#zona").attr("disabled","disabled");
	$("#cargo").attr("disabled","disabled");
	$("#estadocivil").attr("disabled","disabled");
	$("#sexo").attr("disabled","disabled");

	$("#GuardarE").attr("disabled","disabled");
	$("#ModificarE").attr("disabled","disabled");
	$("#CancelarE").attr("disabled","disabled");

	$("#NuevoE").removeAttr("disabled");
}

function Guardar(obj){
	if(obj.codempleado.value==""){
		$('#codempleado').focus();
		$('#codempleado').popover('show'); return 0;
	}
	if(obj.nombre.value==""){
		$('#nombre').focus();
		$('#nombre').popover('show'); return 0;
	}
	if(obj.apellidop.value==""){
		$('#apellidop').focus();
		$('#apellidop').popover('show'); return 0;
	}
	if(obj.dni.value=="" || obj.dni.value.length<8){
		$('#dni').focus();
		$('#dni').popover('show'); return 0;
	}
	if(obj.apellidom.value==""){
		$('#apellidom').focus();
		$('#apellidom').popover('show'); return 0;
	}
	if(obj.direccion.value==""){
		$('#direccion').focus();
		$('#direccion').popover('show'); return 0;
	}
	if(obj.cargo.value=="cargo"){
		$('#cargo').focus();
		$('#cargo').popover('show'); return 0;
	}
	if(obj.celular.value=="" || obj.celular.value.length<9){
		$('#celular').focus();
		$('#celular').popover('show'); return 0;
	}
	if(obj.telefono.value=="" || obj.telefono.value.length<6){
		$('#telefono').focus();
		$('#telefono').popover('show'); return 0;
	}
	if(obj.sexo.value=="sexo"){
		$('#sexo').focus();
		$('#sexo').popover('show'); return 0;
	}
	if(obj.estadocivil.value=="estadocivil"){
		$('#estadocivil').focus();
		$('#estadocivil').popover('show'); return 0;
	}
	if(obj.email.value==""){
		$('#email').popover('show'); return 0;
	}else{
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        if(!regex.test($('#email').val().trim())) {
            $('#email').popover('show'); return 0;
        }
	}
	if(obj.zona.value==""){
		$('#zona').focus();
		$('#zona').popover('show'); return 0;
	}
	
	$("#codempleado").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForEmpleado').serialize(),
		url:BASEURL+'Empleado/Guardar',
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});
		}
	});
}

function dnicliente(qq){
	dni = $(qq).val();
	
	$.get("Empleado/dnicliente",{'dni':dni},function(data){
		if (data == "1"){
				alert("EL EMPLEADO YA ESTA REGISTRADO")
				$(qq).val("");
		}
	},'json');

}


function Modifica(codigo){
	$.ajax({
		url:BASEURL+'Empleado/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			$("#codempleado").val(datos[0]['codempleado']);
			$("#dni").val(datos[0]['dniempleado']);
			$("#direccion").val(datos[0]['direccion']);
			$("#nombre").val(datos[0]['nombre']);
			$("#apellidop").val(datos[0]['appaterno']);
			$("#apellidom").val(datos[0]['apmaterno']);
			$("#email").val(datos[0]['email']);
			$("#telefono").val(datos[0]['telefono']);
			$("#celular").val(datos[0]['celular']);
			$("#zona").val(datos[0]['zonareferencial']);
			$("#cargo > option[value='"+datos[0]['codcargo']+"']").attr('selected', 'selected');
			$("#estadocivil > option[value='"+datos[0]['estadocivil']+"']").attr('selected', 'selected');
			$("#sexo > option[value='"+datos[0]['sexo']+"']").attr('selected', 'selected');

			$("#dni").removeAttr("disabled").focus();
			$("#direccion").removeAttr("disabled");
			$("#nombre").removeAttr("disabled");
			$("#apellidop").removeAttr("disabled");
			$("#apellidom").removeAttr("disabled");
			$("#email").removeAttr("disabled");
			$("#telefono").removeAttr("disabled");
			$("#celular").removeAttr("disabled");
			$("#zona").removeAttr("disabled");
			$("#cargo").removeAttr("disabled");
			$("#estadocivil").removeAttr("disabled");
			$("#sexo").removeAttr("disabled");

			$("#ModificarE").removeAttr("disabled");
			$("#CancelarE").removeAttr("disabled");

			$("#NuevoE").attr("disabled","disabled");
			$("#GuardarE").attr("disabled","disabled");
		}
	});
}

function Modificar(obj){
	if(obj.codempleado.value==""){
		$('#codempleado').focus();
		$('#codempleado').popover('show'); return 0;
	}
	if(obj.nombre.value==""){
		$('#nombre').focus();
		$('#nombre').popover('show'); return 0;
	}
	if(obj.apellidop.value==""){
		$('#apellidop').focus();
		$('#apellidop').popover('show'); return 0;
	}
	if(obj.dni.value=="" || obj.dni.value.length<8){
		$('#dni').focus();
		$('#dni').popover('show'); return 0;
	}
	if(obj.apellidom.value==""){
		$('#apellidom').focus();
		$('#apellidom').popover('show'); return 0;
	}
	if(obj.direccion.value==""){
		$('#direccion').focus();
		$('#direccion').popover('show'); return 0;
	}
	if(obj.cargo.value=="cargo"){
		$('#cargo').focus();
		$('#cargo').popover('show'); return 0;
	}
	if(obj.celular.value=="" || obj.celular.value.length<9){
		$('#celular').focus();
		$('#celular').popover('show'); return 0;
	}
	if(obj.telefono.value=="" || obj.telefono.value.length<6){
		$('#telefono').focus();
		$('#telefono').popover('show'); return 0;
	}
	if(obj.sexo.value=="sexo"){
		$('#sexo').focus();
		$('#sexo').popover('show'); return 0;
	}
	if(obj.estadocivil.value=="estadocivil"){
		$('#estadocivil').focus();
		$('#estadocivil').popover('show'); return 0;
	}
	if(obj.email.value==""){
		$('#email').popover('show'); return 0;
	}else{
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        if(!regex.test($('#email').val().trim())) {
            $('#email').popover('show'); return 0;
        }
	}
	if(obj.zona.value==""){
		$('#zona').focus();
		$('#zona').popover('show'); return 0;
	}
	
	$("#codempleado").removeAttr("disabled");
	$.ajax({
		type:"POST",
		data:$('#ForEmpleado').serialize(),
		url:BASEURL+'Empleado/Modificar',
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
			url:BASEURL+'Empleado/Eliminar',
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
