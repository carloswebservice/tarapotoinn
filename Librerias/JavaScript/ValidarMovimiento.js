$(document).ready(function(){
    $(".maxmin").each(function () {
        var thisJ = $(this);
        var max = thisJ.attr("max") * 1;
        var min = thisJ.attr("min") * 1;
        var intOnly = String(thisJ.attr("intOnly")).toLowerCase() == "true";

        var test = function (str) {
            return str == "" || /* (!intOnly && str == ".") || */
            ($.isNumeric(str) && str * 1 <= max && str * 1 >= min &&
            (!intOnly || str.indexOf(".") == -1) && str.match(/^0\d/) == null);
            // commented out code would allow entries like ".7"
        };

        thisJ.keydown(function () {
            var str = thisJ.val();
            if (test(str)) thisJ.data("dwnval", str);
        });

        thisJ.keyup(function () {
            var str = thisJ.val();
            if (!test(str)) thisJ.val(thisJ.data("dwnval"));
        })
    });

    $("#tipomov").on("change",function(){
        var tipov = $(this).val();
        $("#dis").text("Distribuir");
        $("#cliente").attr("disabled","disabled");
        $.post(BASEURL+'Movimiento/cargaconceptos',{id:tipov},function(response){
            $("#conceptos").empty();
            $("#conceptos").append(response);
        });
    });

    $("#conceptos").on("change",function(){
        var conid = $(this).val();
        if (conid == "1" || conid == "2" || conid=="3"){
            $("#labeln").text("Cliente");
            $("#dis").text("Distribuir");
            $("#cliente").removeAttr("disabled");
        }else{
            if (conid == "6") {
                $("#labeln").text("Proveedor");
                $("#dis").text("Distribuir");
                $("#cliente").removeAttr("disabled");
            }else{
                $("#labeln").text("");
                $("#dis").text("Guardar");
                $("#cliente").attr("disabled","disabled");
            }
        }       
    });

    $("#tablapagos").hide();
    $("#tablaproductos").hide();

    $('[data-toggle="popover"]').popover();

    $('#tipocomprobante2').on('click', function () {
        $('#tipocomprobante2').popover('hide');
    });
    $('#formapago').on('click', function () {
        $('#formapago').popover('hide');
    });

    $('#dnicliente').on('click', function () {
        $('#dnicliente').popover('hide');
    });
    $('#cliente').on('click', function () {
        $('#cliente').popover('hide');
        if($("#tipomov").val() == "1"){
            $('#Clientes').modal({
                show:true,
                backdrop:'static'
            });
        }else{
            $('#Proveedores').modal({
                show:true,
                backdrop:'static'
            });
        }
    });

    $("#tipocomprobante2").on("change",function(){
        var idd = $(this).val();
        var tipomov = $("#tipomov").val();
        if(tipomov == ""){
            alert("Seleccione un tipo de movimiento");
            return 0;
        }else{
            if(tipomov == "1" ){
                if(idd == ""){
                    return 0;
                }else{
                    $.ajax({
                        url: BASEURL + "Movimiento/getTIPODOC",
                        type: 'POST',
                        data: {"pk": idd},
                        success: function (msg) {
                            var result = JSON.parse(msg);
                            var serie = addLeadingZeros(result.serie, 3);
                            var correlativo = addLeadingZeros(result.correlativo, 7);

                            $("#correlativo").val(serie+"-"+correlativo);
                        }
                    });
                }
            }else{
                $("#correlativo").val("");
            }
        }
    });
});

function Selecciona(cod,nom) {
    $("#Clientes").modal("hide");
    $("#Proveedores").modal("hide");
    $("#cliente").val(nom);
    $("#codcliente").val(cod);
}

function actualiza_contenido() {
    $("#ContenidoPrincipal").load(BASEURL + "Movimiento/VerMovimiento");
}

function Actualizando() {
    $('#Alerta').modal('hide');
    setTimeout("actualiza_contenido()", 200);
}

function actualiza_contenido1() {
    $("#ContenidoPrincipal").load(BASEURL + "Movimiento");
}

function Actualizando1() {
    $('#Alerta1').modal('hide');
    setTimeout("actualiza_contenido1()", 200);
}

function Nuevo() {
    $("#ContenidoPrincipal").load(BASEURL + "Estadia/Nuevo");
}
html="";

function RecordCliente() {
    var tipoxd = $("#tipomov").val();
    var cod=$("#codcliente").val();
    var cliente=$("#cliente").val();
    if(tipoxd == "1"){
        if(cliente.length==''){
            alert("No A Ingresado Cliente o Proveedor");
        }else{
            if ($("#conceptos").val()=="3") {
                
            }else{
                $("#tablapagos").show();
                $("#tablapagos tbody").empty();
                $.ajax({
                    url: BASEURL+'Movimiento/VerRecord',
                    type: "POST",
                    dataType:"json",
                    data: "cliente="+cod,
                    success: function (data) {
                        var datos = eval(data);
                        for(i=0;i<datos.length;i++){
                            var param = 2;
                            if(datos[i]['concepto'] == "estadia"){
                                param = 1;
                            }

                            html+="<tr>"+
                            "<td>"+datos[i]['concepto']+"</td>"+
                            "<td>"+datos[i]['fechaingreso']+"</td>"+
                            "<td>"+datos[i]['total']+"</td>"+
                            "<td>"+datos[i]['montocobrado']+"</td>"+
                             "<td>"+decimales(datos[i]['total']-datos[i]['montocobrado'])+"</td>"+
                            "<td><input type='radio'  name='cuotas' class='chk' id='cuotas' onclick='VerCuotas("+datos[i]['codestadia']+","+(datos[i]['total']-datos[i]['montocobrado'])+","+param+");'></td>";

                            html+="</tr>";
                        }
                        $("#tablapagos tbody").append(html);
                        html="";
                    }
                });
            }        
        }
    }else{
        if(cliente.length==''){
            alert("No A Ingresado Cliente o Proveedor");
        }else{
            $("#tablapagos").show();
            $("#tablapagos tbody").empty();
            $.ajax({
                url: BASEURL+'Movimiento/VerRecordC',
                type: "POST",
                dataType:"json",
                data: "cliente="+cod,
                success: function (data) {
                    var datos = eval(data);
                    //$("#lbln").text("Proveedor: "+datos[0]['razonsocial']);
                    //$("#lbld").text("Direccion:"+datos[0]['direccion']);
                    for(i=0;i<datos.length;i++){
                        html+="<tr>"+
                        "<td>"+datos[i]['concepto']+"</td>"+
                        "<td>"+datos[i]['fechacompra']+"</td>"+
                        "<td>"+datos[i]['importe']+"</td>"+
                        "<td>"+datos[i]['montopagado']+"</td>"+
                        "<td>"+decimales(datos[i]['importe']-datos[i]['montopagado'])+"</td>"+
                        "<td><input type='radio'  name='cuotas' class='chk' id='cuotas' onclick='VerCuotasC("+datos[i]['codcompra']+","+(datos[i]['importe']-datos[i]['montopagado'])+");'></td>";

                        html+="</tr>";
                    }
                    $("#tablapagos tbody").append(html);
                    html="";
                }
            });
        }
    }
}

function decimales(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

html1="";

function VerCuotas(codventa,monto,concepto){
     //$("#tablapagos").show();
    $("#idestadiaxd").val(codventa);
    $("#conceptoxd").val(concepto);
    $("#tablaproductos").show();

    $("input:checkbox").prop('checked', false);

    $("#tablaproductos  tbody").empty();
    $.ajax({
        url: BASEURL+'Cronogcobro/vercuota',
        type: "POST",
        data: {ide:codventa,conc:concepto} ,//"ide="+codventa,
        success: function (data) {
            var datos = eval(data);
            for(i=0;i<datos.length;i++){
                html1+="<tr>"+
                    "<td>"+datos[i]['nrocuota']+"</td>"+
                    "<td>"+datos[i]['monto']+"</td>"+
                    "<td>"+datos[i]['monto_cobrado']+"</td>"+
                    "<td>"+datos[i]['fecha']+"</td>";
                    if (parseFloat(datos[i]['monto'])  <= parseFloat(datos[i]['monto_cobrado']) ){
                        html1+="<td>Cancelado</td>";
                    }else{
                        html1+="<td>Falta Cencelar</td>";
                    }
                html1+="</tr>";
            }
            //html1 = html1+"<tr><td colspan='5'><button class='btn btn-succes btn-xs' onclick='amortiza("+monto+")' >Amortizar</button></td></tr>";
            monto=decimales(monto);
            $("#montoamortiza").val("");
            $("#montoquedebe").val(monto);
           // $("#montoamortiza").attr("max",monto);
            $("#tablaproductos tbody").append(html1);
            html1="";
        }
    });
}


function VerCuotasC(codcompra,monto){
     //$("#tablapagos").show();
    $("#idestadiaxd").val(codcompra);
    $("#tablaproductos").show();

    $("input:checkbox").prop('checked', false);

    $("#tablaproductos  tbody").empty();
    $.ajax({
        url: BASEURL+'Cronogcobro/vercuotaC',
        type: "POST",
        data: {ide:codcompra} ,//"ide="+codventa,
        success: function (data) {
            var datos = eval(data);
            for(i=0;i<datos.length;i++){
                html1+="<tr>"+
                    "<td>"+datos[i]['nrocuota']+"</td>"+
                    "<td>"+datos[i]['monto']+"</td>"+
                    "<td>"+datos[i]['monto_pagado']+"</td>"+
                    "<td>"+datos[i]['fechavencimiento']+"</td>";
                    if (parseFloat(datos[i]['monto'])  <= parseFloat(datos[i]['monto_pagado']) ){
                        html1+="<td>Cancelado</td>";
                    }else{
                        html1+="<td>Falta Cencelar</td>";
                    }
                html1+="</tr>";
            }
            //html1 = html1+"<tr><td colspan='5'><button class='btn btn-succes btn-xs' onclick='amortiza("+monto+")' >Amortizar</button></td></tr>";
            monto=decimales(monto);
            $("#montoamortiza").val(monto);
            $("#montoquedebe").val(monto);
            // $("#montoamortiza").attr("max",monto);
            $("#tablaproductos tbody").append(html1);
            html1="";
        }
    });
}

/*
function amortizaya(){
    var ide = $("#idestadiaxd").val();
    var monto = $("#montoamortiza").val();
    $.post(BASEURL+"Cronogcobro/amortiza",{id:ide,montoa:monto},function(response){
        $("#ContenidoPrincipal").load(BASEURL+"Cronogcobro");
    },"json");
}
*/

function amortiza(obj){
    var montodebe = $("#montoquedebe").val();
    var debe =  $("#montoamortiza").val();
    var concccc = $("#conceptos").val();

    if (parseFloat($("#montoamortiza").val()) > parseFloat($("#montoquedebe").val())) {
        var estado=1;
    }else{
        var estado=0;
    }
    
    if(obj.tipomov.value=="tmov"){
        $('#tipomov').focus(); return 0;
    }
    if (obj.concepto.value=="selec") {
        $('#conceptos').focus(); return 0;
    }
    if(obj.formapago.value=="formapago"){
        $('#formapago').focus();
        $('#formapago').popover('show'); return 0;
    }
    if(obj.tipocomprobante2.value==""){
        $('#tipocomprobante2').focus();
        $('#tipocomprobante2').popover('show'); return 0;
    }
    if(obj.correlativo.value==""){
        $('#correlativo').focus();
        $('#correlativo').popover('show'); return 0;
    }

    if (obj.montoamortiza.value=="") {
        alert("Ingrese Monto A Distribuir");$('#montoamortiza').focus();return 0;
    }else{
        if (estado == 1) {
            alert("Mucho Dinero A distribuir Solo Debe "+montodebe);$('#montoamortiza').focus();return 0;
        }
    }

    if(concccc == "1" || concccc == "2" || concccc == "6"){
        $("#montoamortiza").val(debe);
        //$("#idestadiaxd").val(codestadia);
        // $('#myModal2').modal("show");
        var ide = $("#idestadiaxd").val();
        var monto = $("#montoamortiza").val();
        var concepto  = concccc;
        var tipocomprobante = $("#tipocomprobante2").val();
        var correlativo = $("#correlativo").val();
        var formadepago = $("#formapago").val();
        var idcliente = $("#codcliente").val();

        if(concepto == "6"){
            $.post(BASEURL+"Cronogcobro/amortizaC",{id:ide,montoa:monto,con:concepto,tc:tipocomprobante,c:correlativo,fp:formadepago,idcli:10},function(response){
                if(response){
                    alert(response);
                    $("#dis").attr("disabled","disabled");
                    $('input[name=cuotas]:checked').trigger("click");
                    RecordCliente();
                }
            });
        }else{
            concepto=$("#conceptoxd").val();
            $.post(BASEURL+"Cronogcobro/amortiza",{id:ide,montoa:monto,con:concepto,tc:tipocomprobante,c:correlativo,fp:formadepago,idcli:idcliente},function(response){
                if(response){
                    alert(response);
                    var montonuevo= parseFloat($("#montoquedebe").val())-parseFloat($("#montoamortiza").val());
                    $("#dis").attr("disabled","disabled");
                    $('input[name=cuotas]:checked').trigger("click");
                    RecordCliente();                   
                }
            });
        }
    }else{
        if ($("#conceptos").val()=="3") {
            var monto = $("#montoamortiza").val();
            var concepto  = $("#conceptos").val();
            var tipocomprobante = $("#tipocomprobante2").val();
            var correlativo = $("#correlativo").val();
            var formadepago = $("#formapago").val();
            var tipomov = $("#tipomov").val();
            var idcliente = $("#codcliente").val();
            $.post(BASEURL+"Cronogcobro/pagamov",{montoa:monto,con:concepto,tc:tipocomprobante,c:correlativo,fp:formadepago,tm:tipomov,idcli:idcliente},function(response){
                if(response){
                    $("#Mensaje1").html("Consumo Cancelado Correctamente");
                    $('#Alerta1').modal({
                        show:true,
                        backdrop:'static'
                    });
                }
            });
        }else{
            var monto = $("#montoamortiza").val();
            var concepto  = $("#conceptos").val();
            var tipocomprobante = $("#tipocomprobante2").val();
            var correlativo = $("#correlativo").val();
            var formadepago = $("#formapago").val();
            var tipomov = $("#tipomov").val();
            var idcliente = 10;
            $.post(BASEURL+"Cronogcobro/pagamov",{montoa:monto,con:concepto,tc:tipocomprobante,c:correlativo,fp:formadepago,tm:tipomov,idcli:idcliente},function(response){
                if(response){
                    alert(response);
                    $("#Mensaje1").html("Operacion Realizada Correctamente");
                    $('#Alerta1').modal({
                        show:true,
                        backdrop:'static'
                    });
                }
            });
        }
    }
}

function addLeadingZeros(n, length){
    var str = (n > 0 ? n : -n) + "";
    var zeros = "";
    for (var i = length - str.length; i > 0; i--)
        zeros += "0";
    zeros += str;
    return n >= 0 ? zeros : "-" + zeros;
}


//Extornar
function Extornar(cod){
    $('input:hidden[name=movimiento]').val(cod);
    $('#Permiso').modal({
        show:true,
        backdrop:'static'
    });
}

function AhoraExtornar(obj){
    $.ajax({
        url: BASEURL+'Movimiento/LoginAdmin',
        type: "POST",
        data: $('#loginadmin').serialize(),
        success: function (data) {
            if (data=="Incorrecto") {
                alert("no eres el Administrador");
            }else{
                AhoraExtornamos($('input:hidden[name=movimiento]').val());
            }
        }
    });
}

function AhoraExtornamos(cod){
    $.ajax({
        url: BASEURL+'Movimiento/Extornar',
        type: "POST",
        data: 'movimiento='+cod,
        success: function (data) {
            $('#Permiso').modal('hide');
            $("#Mensaje").html(data);
            $('#Alerta').modal({
                show:true,
                backdrop:'static'
            });
        }
    });
}



