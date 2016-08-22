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
	$("#ContenidoPrincipal").load(BASEURL+"Datosmaestros");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Editar(){
	$("#mision").removeAttr("disabled").focus();
	$("#vision").removeAttr("disabled");

	$("#GuardarC").removeAttr("disabled");
	$("#CancelarC").removeAttr("disabled");

	$("#EditarC").attr("disabled","disabled");			
}

function Cancelar(){
	$.ajax({
        url: BASEURL + 'Datosmaestros/Cancelar',
        success: function (data) {
            var datos = eval(data);
            $("#mision").val(datos[0]['mision']);
            $("#vision").val(datos[0]['vision']);

            $("#mision").attr("disabled","disabled");
			$("#vision").attr("disabled","disabled");

			$("#GuardarC").attr("disabled","disabled");
			$("#CancelarC").attr("disabled","disabled");

			$("#EditarC").removeAttr("disabled");
        }
    });
}

function Guardar(obj){
	if(obj.mision.value==""){
		alert("Debe Ingresar La Mision");
		$('#mision').focus();return 0;
	}
	if(obj.vision.value==""){
		alert("Debe Ingresar La Vision");
		$('#vision').focus();return 0;
	}

	$.ajax({
		type:"POST",
		data:$('#ForDatosMaestros').serialize(),
		url:BASEURL+'Datosmaestros/Guardar',
		success: function(data){
			$("#Mensaje").html(data);
			$('#Alerta').modal({
				show:true,
				backdrop:'static'
			});
		}
	});
}