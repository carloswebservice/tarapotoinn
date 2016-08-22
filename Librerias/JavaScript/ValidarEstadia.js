$(function (){
    $('[data-toggle="popover"]').popover();
    $("#Credito").hide();


    $('#cliente').on('click', function () {
        $('#cliente').popover('hide');
    });
    $('#pago').on('click', function () {
        $('#pago').popover('hide');
    });
    $('#fechafinal').on('click', function () {
        $('#fechafinal').popover('hide');
    });
    $('#nrocuotas').on('click', function () {
        $('#nrocuotas').popover('hide');
    });
    $('#intervalodias').on('click', function () {
        $('#intervalodias').popover('hide');
    });
    $('#fechasalida').on('click', function () {
        $('#fechasalida').popover('hide');
    });
    $('#horasalida').on('click', function () {
        $('#horasalida').popover('hide');
    });
    $('#tipohabitacion').on('click', function () {
        $('#tipohabitacion').popover('hide');
    });
    $('#codhabitacion').on('click', function () {
        $('#codhabitacion').popover('hide');
    });
    $('#dni').on('click', function () {
        $('#dni').popover('hide');
    });
    $('#nombre').on('click', function () {
        $('#nombre').popover('hide');
    });
    $('#apellidop').on('click', function () {
        $('#apellidop').popover('hide');
    });
    $('#apellidom').on('click', function () {
        $('#apellidom').popover('hide');
    });

    $("#procesareserva").on("change",function(){
        if($(this).is(':checked')){
            $("#fechaingreso").attr("disabled",false);
            $("#horaingreso").attr("disabled",false);
            $("#fr").text("F.Reserva");
            $("#hr").text("H.Reserva");
            $("#fechaingreso").focus();
        }else{
            $("#fr").text("Fecha");
            $("#fechaingreso").attr("disabled",true);
            $("#horaingreso").attr("disabled",true);
            $("#hr").text("hora");

            var fec = new Date();
            if(fec.getDate()<10){
                var fechaac=fec.getFullYear()+"-"+(fec.getMonth() +1) +"-0"+fec.getDate();
            }else{
                var fechaac=fec.getFullYear()+"-"+(fec.getMonth() +1) +"-"+fec.getDate();
            }
            $("#fechaingreso").val(fechaac);
        }
    });

    $("#horasalida").on("change",function(){
        var fechaingreso = $("#fechaingreso").val();
        var fechafinal = $("#fechasalida").val();

        if(fechafinal == ""){
            alert("seleccione la fecha");
            return 0;
        }else{
            if(fechaingreso == fechafinal){
                var horaini = $("#horaingreso").val();
                var horafin = $("#horasalida").val();

                var jiji = (new Date(fechafinal+" "+horafin) - new Date(fechaingreso+" "+horaini) ) / 1000 / 60 / 60;
                if(parseFloat(jiji) > 0){
                }else{
                   alert("La hora debe ser mayor a la hora de ingreso");
                   $("#horasalida").val("");
                   return false;
                }
            }else{
            }
        }
    });
});

function actualiza_contenido() {
    $("#ContenidoPrincipal").load(BASEURL + "Estadia");
}

function Actualizando() {
    $('#Alerta').modal('hide');
    setTimeout("actualiza_contenido()", 200);
}

function Nuevo() {
    $("#ContenidoPrincipal").load(BASEURL + "Estadia/Nuevo");
}

function AgregaConsumo(codestadia){
    $("#ContenidoPrincipal").load(BASEURL + "Estadia/Consumo",{id:codestadia});
}

function Cancelar() {
    $("#ContenidoPrincipal").load(BASEURL + "Estadia");
}

$("#tipohabitacion").on("change", function () {
    $("#precio").val('');
    $.ajax({
        url: BASEURL + 'Estadia/BuscarHab',
        type: "POST",
        data: 'tipohab=' + $(this).val()+'&reserva='+$("#procesareserva").val()+'&fecha='+$("#fechaingreso").val(),
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

$("#pago").on("change", function () {
    if($(this).val()==2){
        $.ajax({
            type:"POST",
            data:"codcliente="+$("#codcliente").val(),
            url:BASEURL+"Estadia/DeudasTodas",
            success: function(data){               
                $("#debetotal").attr("placeholder", "Deuda: S/. "+data);
                $("#Credito").show();                    
            }
        });
    }else{
        $("#Credito").hide();
    } 
});

$("#codhabitacion").on("change", function () {
    $.ajax({
        url: BASEURL + 'Estadia/BuscarPrecio',
        type: "POST",
        data: 'codhab=' + $(this).val(),
        success: function (data) {
            var datos = eval(data);
            $("#precio").val(datos[0]['precio']);
        }
    });
});

$("#dni").on("keyup", function () {
    $.ajax({
        url: BASEURL + 'Estadia/ClienteExiste',
        type: "POST",
        data: 'codcliente=' + $(this).val(),
        success: function (data) {
            var datos = eval(data);
            if (datos == "") {
                $("#nombre").val('');
                $("#apellidop").val('');
                $("#apellidom").val('');
                $("#idcliente").val('');
            } else {
                $("#idcliente").val(datos[0]['codcliente']);
                $("#nombre").val(datos[0]['nombre']);
                $("#apellidop").val(datos[0]['appaterno']);
                $("#apellidom").val(datos[0]['apmaterno']);
            }
        }
    });
});

function Asignando(obj) {
    if (obj.cliente.value == "") {
        $('#cliente').popover('show');return 0;
    }
    if (obj.fechasalida.value == "") {
        $('#fechasalida').popover('show');return 0;
    }

    if (obj.fechasalida.value < obj.fechaingreso.value) {
        alert("Por Favor Fecha Salida Mayor A La Fecha Ingreso");return 0;
    }

    $("#Form_DetalleEstadia").trigger("reset");
    $("#ListaClientes tbody").empty();

    $("#codestadia").removeAttr("disabled");

    $('#Asignar').modal({
        show: true,
        backdrop: 'static'
    });
}

html = "";htlm2 = "";
function AgregarPersonas(obj) {
    if (obj.tipohabitacion.value == "tipohab") {
        $('#tipohabitacion').popover('show');return 0;
    }
    if (obj.codhabitacion.value == "codhabit") {
        $('#codhabitacion').popover('show');return 0;
    }
    if (obj.dni.value == "" || obj.dni.value.length<8) {
        $('#dni').popover('show');return 0;
    }
    if (obj.nombre.value == "") {
        $('#nombre').popover('show');return 0;
    }
    if (obj.apellidop.value == "") {
        $('#apellidop').popover('show');return 0;
    }
    if (obj.apellidom.value == "") {
        $('#apellidom').popover('show');return 0;
    }


    if($(".validni[value="+$("#dni").val()+"]").length){
        alert("Ya Agrego este cliente a una habitacion");
        return false;
    }else{

        html ="<tr id='Cliente_"+$("#dni").val()+"'>"+
            "<td> <input type='hidden' name='idclientes[]' value='"+$("#idcliente").val()+"'><input type='hidden' class='validni' name='dniclientes[]' value='"+$("#dni").val()+"'><input type='hidden' name='nombres_d[]' value='"+$("#nombre").val()+"'><input type='hidden' name='apellidop_d[]' value='"+$("#apellidop").val()+"'><input type='hidden' name='apellidom_d[]' value='"+$("#apellidom").val()+"'> "+$("#dni").val()+"</td>"+
            "<td> "+$("#nombre").val()+"</td>"+
            "<td> "+$("#apellidop").val()+" "+$("#apellidom").val()+"</td>"+
            "<td><a onclick=$(this).closest('tr').remove();><span class='glyphicon glyphicon-remove' style='color:#D01111'></span> </a></td>"+
        "</tr>";
        $("#ListaClientes tbody").append(html);
    }
    //Limpiando Los Campos
    $("#dni").val("");$("#nombre").val("");$("#apellidop").val("");$("#apellidom").val("");
}

//Para La Bandera
function ActualizaBandera(){
    var tipo=$("#tipohabitacion").val();
    if (tipo==1) {
        if ($("#ListaClientes tbody tr").length==1) {
            $("#bandera").css({'color':'green'});
        }else{
            $("#bandera").css({'color':'red'});
        }
    }
    if (tipo==2 || tipo==6) {
        if ($("#ListaClientes tbody tr").length==2) {
            $("#bandera").css({'color':'green'});
        }else{
            $("#bandera").css({'color':'red'});
        }
    }
    if (tipo==3) {
        if ($("#ListaClientes tbody tr").length==3) {
            $("#bandera").css({'color':'green'});
        }else{
            $("#bandera").css({'color':'red'});
        }
    }
    if (tipo==4) {
        if ($("#ListaClientes tbody tr").length==4) {
            $("#bandera").css({'color':'green'});
        }else{
            $("#bandera").css({'color':'red'});
        }
    }
    if (tipo==5) {
        if ($("#ListaClientes tbody tr").length>1) {
            $("#bandera").css({'color':'green'});
        }else{
            $("#bandera").css({'color':'red'});
        }
    }
}
$(function (){
    setInterval(ActualizaBandera, 3000);
});

function GuardandoHabitacion(obj) {
    if ($("#ListaClientes tbody tr").length==0) {
        alert('No Hay Ningun Cliente En Esta Habitacion');return 0;
    }

    var codehab = $("#codhabitacion").val();
    var numhabit = $("#codhabitacion option:selected").text();
    var numpersonas = $('tbody#ListaClientesD tr:last').index()+1;
    var precio = $("#precio").val();

    //Diferencia de fechas y cantidad de dias de hospedaje
    var f = new Date();
    var fecha= $("#fechaingreso").val();
    fecha=formatoFecha(fecha);
    var fechafin=$("#fechasalida").val();
    fechafin = formatoFecha(fechafin);
    var cantidaddias=restaFechas(fecha,fechafin);

    //informacion de las personas alojadas en esa habirtacion
    setTotal(precio*cantidaddias, 1);
    //alert(codehab+"--"+numpersonas+"--"+precio);myModal
    var html = "";
    html = html+"<tr>";
        html = html+"<td>"+numhabit+"</td>";
        html = html+"<td>";
        $('input[name^="idclientes"]').each(function() {
            html = html+"<input type='hidden' class='precios' name='preciodd[]' value='"+precio*cantidaddias+"' /><input class='codehab' type='hidden' name='codehabd[]' value='"+codehab+"' /><input type='hidden' name='idcliented[]' value='"+$(this).val()+"' />";
        });
        $('input[name^="dniclientes"]').each(function() {
            html = html+"<input class='validni' type='hidden' name='dnid[]' value='"+$(this).val()+"' />";
        });
        $('input[name^="nombres_d"]').each(function() {
            html = html+"<input type='hidden' name='nombresd[]' value='"+$(this).val()+"' />";
        });
        $('input[name^="apellidop_d"]').each(function() {
            html = html+"<input type='hidden' name='apellidopd[]' value='"+$(this).val()+"' />";
        });
        $('input[name^="apellidom_d"]').each(function() {
            html = html+"<input type='hidden' name='apellidomd[]' value='"+$(this).val()+"' />";
        });

        //   html = html+"<input type='hidden' name='nombresd[]' />";
        //   html = html+"<input type='hidden' name='apellidopd[]' />";
        //   html = html+"<input type='hidden' name='apellidomd[]' />";

        html = html+numpersonas+"</td>";
        html = html+"<td ><input type='hidden' class='precios' name='preciod[]' value='"+precio*cantidaddias+"' />"+precio*cantidaddias+"</td>";
        html = html+"<td><a onclick='deleterow($(this))'><span class='glyphicon glyphicon-remove' style='color:#D01111'></span> </a></td>";
    html = html+"</tr>";

    $("#HabEstadiaD").append(html);

    $("#Asignar").modal('hide');
}

formatoFecha=function(date) {
    var d = new Date(date || Date.now()),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    day=parseInt(day)+1;
    return [day, month, year].join('-');
}

restaFechas = function(f1,f2){
    var aFecha1 = f1.split('-');
    var aFecha2 = f2.split('-');
    var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
    var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    return dias;
}

function Guardar(obj) {
    if (obj.cliente.value == "") {
        $('#cliente').popover('show');return 0;
    }
    if (obj.pago.value == "pago") {
        $('#pago').popover('show');return 0;
    }
    if (obj.fechasalida.value == "") {
        $('#fechasalida').popover('show');return 0;
    }
    if (obj.horasalida.value == "") {
        $('#horasalida').popover('show');return 0;
    }
    if(obj.pago.value==2){
        if (obj.nrocuotas.value=="") {
            $('#nrocuotas').popover('show'); return 0;
        }
        if (obj.intervalodias.value=="") {
            $('#intervalodias').popover('show'); return 0;
        }
    }
    if ($("#listahabitacion tbody tr").length==0) {
        alert('No Hay Ninguna Habitacion Alquilada');return 0;
    }

    if (obj.pago.value==2) {
        $("#tablacuotas tbody").empty();
        var intervaldias = $('#intervalodias').val();
        var nrocuotas = parseInt($('#nrocuotas').val());
        var montocuota = $("#totalestadia").val()/nrocuotas;
        subtotal = Math.round(montocuota * 100) / 100;
        montocuota=subtotal.toFixed(2);

        var fecha= $("#fechaingreso").val();
        fecha =  formatoFecha(fecha);
        var html="";

        var f = new Date();
        if (f.getDate()<10) {
            var fechabase= f.getFullYear() + "-" + (f.getMonth() +1) + "-0" + f.getDate();
        }else{
            var fechabase= f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();
        }

        for(var i = 1;i<= nrocuotas; i++){
            var diasadd = parseInt(intervaldias);
            fecha = sumaFecha(diasadd,fecha);
            var fecha1=fecha.split("-");
            fecha1=fecha1[2]+"-"+fecha1[1]+"-"+fecha1[0];
            html+="<tr>";
            html+="<td> <input type='hidden' name='idcuota[]' value='"+i+"'/>"+i+"</td>";
            html+="<td> <input type='text' name='montocuota[]' class='form-control' onkeypress='return NumerosCuota(event)' value='"+montocuota+"'/> </td>";
            html+="<td> <input type='date' name='fechavence[]' class='form-control' min='"+fechabase+"' value='"+fecha1+"'/> </td>";
            html+="</tr>";
        }
        $("#tablacuotas tbody").append(html);
        $('#ListaCuotas').modal({
            show:true,
            backdrop:'static'
        });
    }else{
        $.ajax({
            type:"POST",
            data:$("#ForEstadia").serialize(),
            url:BASEURL+"Estadia/GuardarEstadia",
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

function Formato(input) {
  var datePart = input.match(/\d+/g),
  year = datePart[0].substring(2), // get only two digits
  month = datePart[1], day = datePart[2];

  return year+'/'+month+'/'+day;
}


sumaFecha = function(d, fecha){
    var Fecha = new Date();
    var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
    var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
    var aFecha = sFecha.split(sep);
    var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
    fecha= new Date(fecha);
    fecha.setDate(fecha.getDate()+parseInt(d));
    var anno=fecha.getFullYear();
    var mes= fecha.getMonth()+1;
    var dia= fecha.getDate();
    mes = (mes < 10) ? ("0" + mes) : mes;
    dia = (dia < 10) ? ("0" + dia) : dia;
    var fechaFinal = dia+sep+mes+sep+anno;
    return (fechaFinal);
}

function AhoraMandaGuardar(obj){
    var sum=0;
    $('input[name^="montocuota"]').each(function() {
        sum=sum+parseFloat($(this).val());
    });
    if (obj.totalestadia.value!=sum) {
        alert("Distribucion Incorrecta - El Total Es "+obj.totalestadia.value); return 0;
    }

    $("#ListaCuotas").modal("hide");
    $.ajax({
        type:"POST",
        data:$("#ForEstadia").serialize(),
        url:BASEURL+"Estadia/GuardarEstadia",
        success: function(data){
            $("#Mensaje").html(data);
            $('#Alerta').modal({
                show:true,
                backdrop:'static'
            });
        }
    });
}
function NumerosCuota(e){
    tecla = e.keyCode || e.which;
    base =/[0-9.]/;
    teclado = String.fromCharCode(tecla).toLowerCase();
    return base.test(teclado);
}


function setTotal(importe, aumenta) {
    var subtotal = $("#totalestadia").val();
    subtotal = parseFloat(subtotal);

    importe = parseFloat(importe);

    if (aumenta) {
        subtotal = subtotal + importe;
    } else {
        subtotal = subtotal - importe;
    }
    subtotal = Math.round(subtotal * 100) / 100;
    $("#totalestadia").val(subtotal.toFixed(2));
}

function deleterow(t) {
    var i = t.parent().parent().index();

    var importe = $("#HabEstadiaD tr:eq(" + i + ") td .precios").val();
    setTotal(importe, 0);
    t.parent().parent().remove();
}


var htmlestadia="";
function verdetalle(codestadia,dni,cliente,app,apm,ruc,razon,direc,ingreso,salida,monto){
    $.post(BASEURL+"Estadia/detalleestadia",{ide:codestadia},function(response){
        htmlestadia = htmlestadia+"<div style='margin-left:50px;'>";
        if (razon=="") {
            htmlestadia = htmlestadia + "<p><b>DNI Cliente &nbsp; &nbsp; &nbsp;</b> : "+dni+" &nbsp;&nbsp;&nbsp;&nbsp; <b>Cliente</b> : "+cliente+" "+app+" "+apm+"</p>";
        }else{
            htmlestadia = htmlestadia + "<p><b>RUC Empresa</b> : "+ruc+" &nbsp;&nbsp;&nbsp;&nbsp; <b>Empresa</b> : "+razon+"</p>";
        }
        htmlestadia = htmlestadia +"<p><b>Fecha Ingreso</b> : "+ingreso+" &nbsp;&nbsp;&nbsp;&nbsp; <b>Fecha Salida</b> : "+salida+"</p>";
        htmlestadia = htmlestadia +"<p><b>Direccion &nbsp; &nbsp; &nbsp; &nbsp;</b> : "+direc+" &nbsp;&nbsp;&nbsp;&nbsp; <b>Monto Total</b> : "+monto+"</p>";
        htmlestadia = htmlestadia +"</div>";

        htmlestadia += "<table class='table table-bordered table-condensed' id='listas'>";
        htmlestadia = htmlestadia+"<tr>";
            htmlestadia = htmlestadia+"<th>Cliente</th>";
            htmlestadia = htmlestadia+"<th>N° Habitacion</th>";
        htmlestadia = htmlestadia+"</tr>";
        $.each(response, function(i, item) {
            htmlestadia = htmlestadia+"<tr>";
            htmlestadia = htmlestadia+"<td>";
            htmlestadia = htmlestadia+item.nombre+" "+item.appaterno+" "+item.apmaterno;
            htmlestadia = htmlestadia+"</td>";
            htmlestadia = htmlestadia+"<td>"+item.nrohabitacion+"</td>";
            htmlestadia = htmlestadia+"</tr>";
        });
        htmlestadia = htmlestadia+"</table>";
        $("#modalbebe").empty();
        $("#modalbebe").append(htmlestadia);
        $('#myModal').modal("show");
        htmlestadia="";
    },"json");
}


//  Para agregar un nuevo cliente
$("#departamento").on("change", function () {
    $.ajax({
        url: BASEURL + 'Estadia/UbigeoPro',
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
        url: BASEURL + 'Estadia/UbigeoDis',
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
htmlc="";cont=0;cont1=0;

function TraerClientes() {
    $("#TablaClientes tbody").empty();
    $.ajax({
        url: BASEURL + 'Estadia/TraerClientes',
        success: function (data) {
            var datos = eval(data);
            for (var i = 0; i < datos.length; i++){
                if (datos[i]['razonsocial']==null) {
                    htmlc += "<tr>";
                    htmlc += "<td>"+datos[i]['dnicliente'] + "</td>";
                    htmlc += "<td>"+datos[i]['nombre']+ " "+ datos[i]['appaterno'] + " "+datos[i]['apmaterno']+"</td>";
                    htmlc += "<td> <center> <a data-dismiss='modal' onclick=ClienteSeleccionado("+datos[i]['codcliente']+",'"+datos[i]['nombre'].split(" ").join("_")+"','"+datos[i]['appaterno'].split(" ").join("_")+"','"+datos[i]['apmaterno'].split(" ").join("_")+"'); >"+
                    "<span class='glyphicon glyphicon-ok'></span></a></center></td>";
                    htmlc += "</tr>";
                }else{
                    htmlc += "<tr>";
                    htmlc += "<td>"+datos[i]['ruc'] + "</td>";
                    htmlc += "<td>"+datos[i]['razonsocial'] + "</td>";
                    htmlc += "<td> <center> <a data-dismiss='modal' onclick=EmpresaSeleccionado("+datos[i]['codcliente']+",'"+datos[i]['razonsocial'].split(" ").join("_")+"'); >"+
                    "<span class='glyphicon glyphicon-ok'></span></a></center></td>";
                    htmlc += "</tr>";
                }

            }
            $("#TablaClientes tbody").append(htmlc);
            htmlc="";
            setdatatablescliente(cont);
            cont=cont+1;
        }
    });
}

function ClienteSeleccionado(cod,nom,apep,apem){
    $("#cliente").val(nom.split("_").join(" ")+' '+apep.split("_").join(" ")+' '+apem.split("_").join(" "));
    $("#codcliente").val(cod);
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

    $('#AgregarOtroCliente').on( 'click', function () {
        var table = $('#TablaClientes').DataTable();
        table.destroy();
        cont=0;
        var table1 = $('#TablaEmpresas').DataTable();
        table1.destroy();
        cont1=0;
    });
});

function EmpresaSeleccionado(cod,razon){
    razon=razon.split("_").join(" ");
    $("#cliente").val(razon);
    $("#codcliente").val(cod);
}

function setdatatablescliente(cont){
    if (cont==0) {
        $('#TablaClientes').DataTable({
                "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "",
                        "sInfoEmpty":      "",
                        "sInfoFiltered":   "",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        }
                }
        });
    }
}
function setdatatablesempresa(cont){
    if (cont1==0) {
        $('#TablaEmpresas').DataTable({
                "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "",
                        "sInfoEmpty":      "",
                        "sInfoFiltered":   "",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        }
                }
        });
    }
}

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
            alert(data);
            $("#AgregarCliente").modal('hide');
            $("#ForNuevoCliente").trigger("reset");
        }
    });
}

//Terminar Estadia
function Terminarestadia(codestadia,fechafinal){
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

//Para consumos de Estadia
$(function(){
    $('#cantidad').on('click',function(){
        $('#cantidad').popover('hide');
    });
    $('#precio').on('click',function(){
        $('#precio').popover('hide');
    });
});
function ProductoSeleccionado(cod,des,pre){
    $("#producto").val(des);
    $("#codproducto").val(cod);
    $("#precio").val(pre);
}

htmlcon = "";var subtotalventa=[];var igvconsumo=[];var c_sub_total=0;subtotales1=0;
var igvconsumo1=0; var igv=0;

function Agregar(obj){
    if(obj.producto.value==""){
        $('#producto').focus();
        $('#producto').popover('show'); return 0;
    }
    if(obj.precio.value==""){
        $('#precio').focus();
        $('#precio').popover('show'); return 0;
    }
    if(obj.cantidad.value==""){
        $('#cantidad').focus();
        $('#cantidad').popover('show'); return 0;
    }

    if(obj.cantidad.value!=""){
        $.ajax({
            type:"POST",
            data:$('#consumocliente').serialize(),
            url:BASEURL+"Estadia/Cantidadstock",
            success: function(data){
                var datos = eval(data);
                var stock=datos[0]['stockactual'];
                var cobrarigv=datos[0]['cobrarigv'];
                if ((stock-eval($("#cantidad").val()))>=0) {
                    var rpta=1;
                }else{
                    var rpta=0;
                }
                if (rpta==1){
                    if($("#Producto_"+$("#codproducto").val()).length==false){
                        subtotalventa[c_sub_total]=eval($("#cantidad").val()*$("#precio").val());
                        if (cobrarigv=="SI") {
                            var totaligv=eval($("#cantidad").val()*$("#precio").val()*0.18);
                        }else{
                            var totaligv=0.0;
                        }
                        igvconsumo[c_sub_total]=totaligv;

                        html ="<tr id='Producto_"+$("#codproducto").val()+"'>"+
                        "<td> <input type='hidden' name='cantidadconsumo[]' value='"+$("#cantidad").val()+"'> "+$("#cantidad").val()+"</td>"+
                        "<td> <input type='hidden' name='idproductoconsumo[]' value='"+$("#codproducto").val()+"'> "+$("#producto").val()+"</td>"+
                        "<td> <input type='hidden' name='precioconsumo[]' value='"+$("#precio").val()+"'> "+$("#precio").val()+"</td>"+
                        "<td> "+$("#precio").val()*$("#cantidad").val()+"</td>"+
                        "<td> <input type='hidden' name='igvconsumo[]' value='"+totaligv+"'> "+decimales(totaligv)+"</td>"+
                        "<td><a onclick=$(this).closest('tr').remove();QuitarSubtotal("+c_sub_total+");><span class='glyphicon glyphicon-remove' style='color:#D01111'></span> </a></td></tr>";

                        $("#tablaconsumos tbody").append(html);

                        subtotales1=subtotales1+$("#cantidad").val()*$("#precio").val();
                        igvconsumo1=decimales(igvconsumo1+totaligv);
                        $("#subtotal").val(subtotales1);
                        $("#igv").val(igvconsumo1);
                        var tot=decimales(igvconsumo1+subtotales1);
                        $("#total").val(tot);
                        c_sub_total ++;
                    }else{
                        alert("Ya Agrego Este Producto");
                    }
                }else{
                    alert("Cantidad Insufiente En Stock");
                }
            }
        });
    }
}

QuitarSubtotal=function(i){
    subtotal1=eval($("#subtotal").val());
    subtotal1=subtotal1-eval(subtotalventa[i]);
    subtotales1=subtotales1-eval(subtotalventa[i]);

    igvcons=eval($("#igv").val());
    igvcons=igvcons-eval(igvconsumo[i]);
    igvconsumo1=igvconsumo1-eval(igvconsumo[i]);

    subtott=decimales(subtotal1);
    $("#subtotal").val(subtott);
    igvcom=decimales(igvcons);
    $("#igv").val(igvcom);
    tota1=decimales(igvcons+subtotal1)
    $("#total").val(tota1);
}


function decimales(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

function GuardarConsumo(obj){
    if ($("#tablaconsumos tbody tr").length==0) {
        alert('No Ha Vendido Ningun Producto');return 0;
    }

    $("#codventa").removeAttr("disabled");
    var forConsumo= $("#consumocliente").serialize();
    if (confirm('Desea Añadir A La Cuenta De Su Estadia')==true) {
        $.ajax({
            type:"POST",
            data:$('#consumocliente').serialize()+"&pagarahora=no",
            url:BASEURL+"Estadia/GuardarConsumo",
            success: function(data){
                $("#Mensaje").html(data);
                $('#Alerta').modal({
                    show:true,
                    backdrop:'static'
                });
            }
        });
    }else{
        $.ajax({
            type:"POST",
            data:$('#consumocliente').serialize()+"&pagarahora=si",
            url:BASEURL+"Estadia/GuardarConsumo",
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


$(function(){
    $("#Credito").hide();
});

function Scoring(){
    var cliente=$("#cliente").val();
    if (cliente=="") {
        alert("No As seleccionado Cliente");
    }else{
        $.ajax({
            type:"POST",
            data:"codcliente="+$("#codcliente").val(),
            dataType: "json",
            url:BASEURL+"Estadia/Grafico",
            success: function(data){
                if (data=="nada") {                   
                    alert("El Cliente No Tiene Historial ... Cliente Nuevo");
                }else{
                    $('#Scoring').modal({
                        show:true
                    });

                    $('#scoring').highcharts({
                            title: {
                                text: $("#cliente").val(),
                                x: -20 //center
                            },
                            subtitle: {
                                text: data.calif,
                                x: -20
                            },
                            xAxis: {
                                categories: data.categories
                            },
                            yAxis: {
                                min: 0,
                                max: 20,
                                tickInterval: 1,
                                title: {
                                    text: 'Nota'
                                },
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                            },
                            tooltip: {
                                valueSuffix: ''
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle',
                                borderWidth: 0
                            },
                            series: [{
                                name: 'Nota',
                                data: data.nota
                            },{
                                name: 'Pend',
                                data: data.pendiente
                            }]
                    });
                }
            }
        });
    }
    
}