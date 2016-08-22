$(function (){
    $('[data-toggle="popover"]').popover();

    $('#fechaingreso').on('click', function () {
        $('#fechaingreso').popover('hide');
    });
    $('#tipohabitacion').on('click', function () {
        $('#tipohabitacion').popover('hide');
    });
});

function actualiza_contenido() {
    $("#ContenidoPrincipal").load(BASEURL + "Reserva");
}

function Actualizando() {
    $('#Alerta').modal('hide');
    setTimeout("actualiza_contenido()", 200);
}

function Nuevo() {
    $("#ContenidoPrincipal").load(BASEURL + "Reserva/Nuevo");
}

function Ver(codestadia){
    $("#ContenidoPrincipal").load(BASEURL + "Reserva/VerReserva",{id:codestadia});
}

function Cancelar() {
    $("#ContenidoPrincipal").load(BASEURL + "Reserva");
}

//Reservando desde la pagina 
function Asignando(obj) {

    if (obj.tipohabitaciones.value =="hab") {
        alert("Seleccione Tipo De Habitacion"); return 0;
    }   
    if (obj.fechaingreso.value == "") {
        alert("Ingrese La Fecha Ingreso"); return 0;
    }
    
    if (obj.fechaingreso.value < obj.fechaactu.value) {
        alert("La Fecha Ingreso No Es Válida ... Mayor A La Fecha Actual"); return 0;
    }

    if (obj.fechasalida.value == "") {
        alert("Ingrese La Fecha Salida"); return 0;
    }
    if (obj.fechasalida.value < obj.fechaingreso.value) {
        alert("La Fecha Salida Tiene Que Ser Mayor");return 0;
    }

    var fechares=$("#fechaingreso").val();
    var fechasa=$("#fechasalida").val();

    $.ajax({
        type:"POST",
        data:$('#reservahoy').serialize(),
        url:BASEURL+'Reserva/TraeHabitacion',
        success: function(data){
            var habitacion = eval(data);
            if (habitacion.length==0) {
                $("#codhabi").val("");
                $("#datos").hide();
                $('#aviso').html("No hay habitaciones Disponibles Seleccione Otro Tipo Habitacion");
                $('#AgregarCliente').modal({
                    show:true,
                    backdrop:'static'
                });
            }else{
                $("#aviso").html("");
                $("#datos").show();
                $("#codhabi").val(habitacion[0]['codhabitacion']);
                $("#fechaing").val(fechares);
                $("#fechasal").val(fechasa);
                $('#AgregarCliente').modal({
                    show:true,
                    backdrop:'static'
                });
            }
        }
    });
}

function ReservarAhora(obj){
    if (obj.dni.value == "") {
        alert("Ingrese Su DNI");return 0;
    }
    if (obj.nombre.value == "") {
        alert("Ingrese Su Nombre");return 0;
    }
    if (obj.apellidop.value == "") {
        alert("Ingrese Su Apellido");return 0;
    }
    if (obj.apellidom.value == "") {
        alert("Ingrese Su apellido");return 0;
    }
    if (obj.direccion.value == "") {
        alert("Ingrese Su Direccion");return 0;
    }
    if (obj.email.value == "") {
        alert("Ingrese Su Email");return 0;
    }

    $.ajax({
        type:"POST",
        data:$('#reservas1').serialize(),
        url:BASEURL+'Reserva/GuardarReserva',
        success: function(data){
            alert(data);
            $('#AgregarCliente').modal('hide');
        }
    });
}

$(function (){
    $('[data-toggle="popover"]').popover();

    $('#dnicli').on('click', function () {
        $('#dnicli').popover('hide');
    });
    $('#nom').on('click', function () {
        $('#nom').popover('hide');
    });
    $('#apep').on('click', function () {
        $('#apep').popover('hide');
    });
    $('#apem').on('click', function () {
        $('#apem').popover('hide');
    });
    $('#dire').on('click', function () {
        $('#dire').popover('hide');
    });
    $('#correoelec').on('click', function () {
        $('#correoelec').popover('hide');
    });
    $('#ruc').on('click', function () {
        $('#ruc').popover('hide');
    });
    $('#razons').on('click', function () {
        $('#razons').popover('hide');
    });

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
});


function GuardarCliente(obj) {
    if($('input:radio[id=persona]:checked').val()) {
        if (obj.dnicli.value == "" || obj.dnicli.value.length <8) {
            $('#dnicli').popover('show');return 0;
        }
        if (obj.nom.value == "") {
            $('#nom').popover('show');return 0;
        }
        if (obj.apep.value == "") {
            $('#apep').popover('show');return 0;
        }
        if (obj.apem.value == "") {
            $('#apem').popover('show');return 0;
        }
    }else{
        if (obj.ruc.value == "" || obj.ruc.value.length <11) {
            $('#ruc').popover('show');return 0;
        }
        if (obj.razons.value == "") {
            $('#razons').popover('show');return 0;
        }
    }

    if (obj.dire.value == "") {
        $('#dire').popover('show');return 0;
    }
    if (obj.correoelec.value == "") {
        $('#correoelec').popover('show');return 0;
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
        data:$("#ForNuevoCliente").serialize(),
        url:BASEURL+"Estadia/GuardarClienteNuevo",
        success: function(data){
            alert("Cliente Registrado Correctamente");
            $("#AgregarCliente").modal('hide');
            $("#ForNuevoCliente").trigger("reset");
        }
    });
}


//Pasar a Estadia
 function pres(idreserva){
        $.ajax({
            type:"POST",
            data:{id:idreserva},
            url:BASEURL+"Estadia/GuardarEstadiaReserva",
            success: function(data){
                $("#Mensaje").html(data);
                $('#Alerta').modal({
                    show:true,
                    backdrop:'static'
                });
            }
        });
    }


//Anular Reserva
function Anular(codestadia,fechafinal){
    var f = new Date();
    var fechaactual=f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();

    if (fechafinal > fechaactual) {
        if (confirm('LA ESTADIA TERMINA EL '+fechafinal+' SEGURO QUE DESEA TERMINAR ESTADIA')==true) {
            $.ajax({
                type:"POST",
                data:"codestadia="+codestadia,
                url:BASEURL+"Estadia/TerminarEstadia",
                success: function(data){
                    $("#Mensaje").html(data);
                    $('#Alerta').modal({
                        show:true,
                        backdrop:'static'
                    });
                }
            });
        }
    }else{
        $.ajax({
            type:"POST",
            data:"codestadia="+codestadia,
            url:BASEURL+"Estadia/TerminarEstadia",
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



