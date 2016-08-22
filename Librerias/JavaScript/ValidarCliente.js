$(function(){	
	$('[data-toggle="popover"]').popover();

	$('#codcliente').on('click',function(){
		$('#codcliente').popover('hide');
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
	$('#rpm').on('click',function(){
		$('#rpm').popover('hide');
	});	
	$('#gruposanguineo').on('click',function(){
		$('#gruposanguineo').popover('hide');
	});	
	$('#zona').on('click',function(){
		$('#zona').popover('hide');
	});	
	$('#fecha').on('click',function(){
		$('#fecha').popover('hide');
	});	
	$('#estadocivil').on('click',function(){
		$('#estadocivil').popover('hide');
	});	
	$('#sexo').on('click',function(){
		$('#sexo').popover('hide');
	});
	$('#grado').on('click',function(){
		$('#grado').popover('hide');
	});	
	$('#ruc').on('click',function(){
		$('#ruc').popover('hide');
	});
	$('#razons').on('click',function(){
		$('#razons').popover('hide');
	});
	$('#ubigeo').on('click',function(){
		$('#ubigeo').popover('hide');
	});
	$('#departamento').on('click',function(){
		$('#departamento').popover('hide');
	});
	$('#provincia').on('click',function(){
		$('#provincia').popover('hide');
	});
	$('#distrito').on('click',function(){
		$('#distrito').popover('hide');
	});
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Cliente");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$("#ContenidoPrincipal").load(BASEURL+"Cliente/nuevo");
}

$("#iddepartamento").on("change", function () {
    $("#precio").val('');
    $.ajax({
        url: BASEURL + 'Estadia/BuscarHab',
        type: "POST",
        data: 'tipohab=' + $(this).val(),
        success: function (data) {
            var datos = eval(data);
            
            var html = html + "<option value='codhabit'>Numero ...</option>";
            for (var i = 0; i < datos.length; i++) {
                    if($(".codehab[value="+datos[i].codhabitacion+"]").length){
                        
                    }else{
                        html = html + "<option value='" + datos[i].codhabitacion + "'>" + "Hab. " + datos[i].nrohabitacion + "</option>";
                    }
                    
            }
            $("#codhabitacion").html(html);
        }
    });
});

function Agregar(){
	$.ajax({
		url:BASEURL+'Cliente/Nuevo',
		type:'POST',
	}).done(function(resp){
		var codigo = eval(resp);
		if(codigo[0]['CODCLIENTE'] == null){
			if (codigo[0]['codcliente']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['codcliente']);
			}
		}else{
			if (codigo[0]['CODCLIENTE']==null) {
				codigo=0;
			}else{
				codigo=parseInt(codigo[0]['CODCLIENTE']);
			}
		}
		$("#codcliente").val(codigo+1);
				
	});
}

$("#departamento").on("change", function () {
    $.ajax({
        url: BASEURL + 'Cliente/UbigeoProvincias',
        type: "POST",
        data: 'departamento=' + $(this).val(),
        success: function (data) {
            var datos = eval(data);        
            var html = html + "<option value='provincia'>PROVINCIA</option>";
            for (var i = 0; i < datos.length; i++){
                html = html + "<option value='" + datos[i].ubiprovincia + "'>"+datos[i].provincia + "</option>";                
            }
            $("#provincia").html(html);
        }
    });
});

$("#provincia").on("change", function () {
    var dep=$("#departamento").val();
    $.ajax({
        url: BASEURL + 'Cliente/UbigeoDistritos',
        type: "POST",
        data: 'departamento=' +dep+' &provincia='+$(this).val(),
        success: function (data) {
            var datos = eval(data);        
            var html = html + "<option value='distrito'>DISTRITO</option>";
            for (var i = 0; i < datos.length; i++){
                html = html + "<option value='" + datos[i].ubidistrito + "'>"+datos[i].distrito + "</option>";                
            }
            $("#distrito").html(html);
        }
    });
});

function Cancelar() {
    $("#ContenidoPrincipal").load(BASEURL + "Cliente");
}

function Guardar(obj) {
    if($('input:radio[id=persona]:checked').val()) {
        if(obj.dni.value=="" || obj.dni.value.length<8){
			$('#dni').popover('show'); return 0;
		}	
		if(obj.nombre.value==""){
			$('#nombre').popover('show'); return 0;
		}
		if(obj.apellidop.value==""){
			$('#apellidop').popover('show'); return 0;
		}
		if(obj.apellidom.value==""){
			$('#apellidom').popover('show'); return 0;
		}
		if(obj.estadocivil.value=="estadocivil"){
			$('#estadocivil').popover('show'); return 0;
		}
		if(obj.sexo.value=="sexo"){
			$('#sexo').popover('show'); return 0;
		}
		if(obj.gruposanguineo.value==""){
			$('#gruposanguineo').popover('show'); return 0;
		}
		if(obj.grado.value=="grado"){
			$('#grado').popover('show'); return 0;
		}
		if(obj.fecha.value==""){
			$('#fecha').popover('show'); return 0;
		}
    }else{ 
        if (obj.ruc.value == "" || obj.ruc.value.length<11){
			$('#ruc').popover('show'); return 0;
		}
        if (obj.razons.value == "") {
            $('#razons').popover('show');return 0;
        }
    }
	if(obj.celular.value=="" || obj.celular.value.length<9){
		$('#celular').popover('show'); return 0;
	}
	if(obj.email.value==""){
		$('#email').popover('show'); return 0;
	}else{
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        if(!regex.test($('#email').val().trim())) {
            $('#email').popover('show'); return 0;
        }
	}
	if(obj.rpm.value=="" || obj.rpm.value.length<10){
		$('#rpm').popover('show'); return 0;
	}
	if(obj.direccion.value==""){
		$('#direccion').popover('show'); return 0;
	}
	if(obj.telefono.value=="" || obj.telefono.value.length<6){
		$('#telefono').popover('show'); return 0;
	}
	if(obj.zona.value==""){
		$('#zona').popover('show'); return 0;
	}
    if (obj.departamento.value == "departamento") {
        alert("Seleccione Correctamente Su Ubigeo");
        obj.departamento.focus();return 0;
    }
    if (obj.departamento.value == "departamento") {
        alert("Seleccione Correctamente Su Ubigeo");
        obj.departamento.focus();return 0;
    }
    if (obj.provincia.value == "provincia") {
        alert("Seleccione Correctamente Su Ubigeo");
        obj.provincia.focus();return 0;
    }
    if (obj.distrito.value == "distrito") {
        alert("Seleccione Correctamente Su Ubigeo");
        obj.distrito.focus();return 0;
    }

    $.ajax({
        type:"POST",
        data:$("#ForCliente").serialize(),
        url:BASEURL+"Cliente/GuardarClienteNuevo",
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
	
	$.get("Cliente/dnicliente",{'dni':dni},function(data){
		if (data == "1"){
				alert("EL CLIENTE YA ESTA REGISTRADO")
				$(qq).val("");
		}
	},'json');
}

function RUCempresa(qq){
	ruc = $(qq).val();
	
	$.get("Cliente/RUCempresa",{'ruc':ruc},function(data){
		if (data == "1"){
				alert("LA EMPRESA YA ESTA REGISTRADA")
				$(qq).val("");
		}
	},'json');
}

function Modifica(codigo){
	$.ajax({
		url:BASEURL+'Cliente/Modificando',
		type:"POST",
		data:'modificar='+codigo,
		success: function(data){
			var datos = eval(data);
			

			$("#idclientee").val(datos[0]['codcliente']);
			$("#dni").val(datos[0]['dnicliente']);
			$("#direccion").val(datos[0]['direccion']);
			$("#nombre").val(datos[0]['nombre']);
			$("#apellidop").val(datos[0]['appaterno']);
			$("#apellidom").val(datos[0]['apmaterno']);
			$("#email").val(datos[0]['email']);
			$("#telefono").val(datos[0]['telefono']);
			$("#celular").val(datos[0]['celular']);
			$("#gruposanguineo").val(datos[0]['gruposanguineo']);
			$("#rpm").val(datos[0]['rpm']);
			$("#ruc").val(datos[0]['ruc']);
			$("#fecha").val(datos[0]['fechanacimiento']);
			$("#zona").val(datos[0]['zonareferencial']);
			$("#grado > option[value='"+datos[0]['gradoinstruccion']+"']").attr('selected', 'selected');
			$("#departamento > option[value='"+datos[0]['ubidepartamento']+"']").attr('selected', 'selected');
			$("#provincia > option[value='"+datos[0]['ubiprovincia']+"']").attr('selected', 'selected');
			$("#distrito > option[value='"+datos[0]['ubidistrito']+"']").attr('selected', 'selected');
			$("#estadocivil > option[value='"+datos[0]['estadocivil']+"']").attr('selected', 'selected');
			$("#sexo > option[value='"+datos[0]['sexo']+"']").attr('selected', 'selected');
			$("#razons").val(datos[0]['razonsocial']);
			$("#accion").val(datos[0]['razonsocial']);

			if (datos[0]['razonsocial'] == null){
				$(".ee").addClass('pp');
				 $("#clienteempresa").hide();
			    $("#clientepersona").show();
			}else{
				$(".per").addClass('pp');
			    $("#clienteempresa").show();
			    $("#clientepersona").hide();
			}
		}
	});
}

function Modificar(obj){
	var campo=$("#accion").val();
	if(campo=="") {
        if(obj.dni.value=="" || obj.dni.value.length<8){
			$('#dni').popover('show'); return 0;
		}	
		if(obj.nombre.value==""){
			$('#nombre').popover('show'); return 0;
		}
		if(obj.apellidop.value==""){
			$('#apellidop').popover('show'); return 0;
		}
		if(obj.apellidom.value==""){
			$('#apellidom').popover('show'); return 0;
		}
		if(obj.estadocivil.value=="estadocivil"){
			$('#estadocivil').popover('show'); return 0;
		}
		if(obj.sexo.value=="sexo"){
			$('#sexo').popover('show'); return 0;
		}
		if(obj.gruposanguineo.value==""){
			$('#gruposanguineo').popover('show'); return 0;
		}
		if(obj.grado.value=="grado"){
			$('#grado').popover('show'); return 0;
		}
		if(obj.fecha.value==""){
			$('#fecha').popover('show'); return 0;
		}
    }else{ 
        if (obj.ruc.value == "" || obj.ruc.value.length<11){
			$('#ruc').popover('show'); return 0;
		}
        if (obj.razons.value == "") {
            $('#razons').popover('show');return 0;
        }
    }
	if(obj.celular.value=="" || obj.celular.value.length<9){
		$('#celular').popover('show'); return 0;
	}
	if(obj.email.value==""){
		$('#email').popover('show'); return 0;
	}else{
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        if(!regex.test($('#email').val().trim())) {
            $('#email').popover('show'); return 0;
        }
	}
	if(obj.rpm.value=="" || obj.rpm.value.length<10){
		$('#rpm').popover('show'); return 0;
	}
	if(obj.direccion.value==""){
		$('#direccion').popover('show'); return 0;
	}
	if(obj.telefono.value=="" || obj.telefono.value.length<6){
		$('#telefono').popover('show'); return 0;
	}
	if(obj.zona.value==""){
		$('#zona').popover('show'); return 0;
	}
    if (obj.departamento.value == "departamento") {
        alert("Seleccione Correctamente Su Ubigeo");
        obj.departamento.focus();return 0;
    }
    if (obj.departamento.value == "departamento") {
        alert("Seleccione Correctamente Su Ubigeo");
        obj.departamento.focus();return 0;
    }
    if (obj.provincia.value == "provincia") {
        alert("Seleccione Correctamente Su Ubigeo");
        obj.provincia.focus();return 0;
    }
    if (obj.distrito.value == "distrito") {
        alert("Seleccione Correctamente Su Ubigeo");
        obj.distrito.focus();return 0;
    }

	$.ajax({
		type:"POST",
		data:$('#ForNuevoCliente').serialize(),
		url:BASEURL+'Cliente/Modificar',
		success: function(data){			
			$('#ModificarCliente').modal('hide');
			
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
			url:BASEURL+'Cliente/Eliminar',
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

//Agregar Cliente o Empresa
$("#clienteempresa").hide(); 
$("#persona").on("click",function(){
    $("#clientepersona").show();
    $("#clienteempresa").hide(); 
}); 
$("#empresa").on("click",function(){
    $("#clienteempresa").show();
    $("#clientepersona").hide();    
});

