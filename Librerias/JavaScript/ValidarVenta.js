$(function(){	
	$('[data-toggle="popover"]').popover();
	$("#credito").hide();

	$('#cliente').on('click',function(){
		$('#cliente').popover('hide');
	});
	$('#formapago').on('click',function(){
		$('#formapago').popover('hide');
	});	
	$('#producto').on('click',function(){
		$('#producto').popover('hide');
	});	
	$('#nrocuotas').on('click',function(){
		$('#nrocuotas').popover('hide');
	});	
	$('#intervalodias').on('click',function(){
		$('#intervalodias').popover('hide');
	});	

	$('#cantidad').on('click',function(){
		$('#cantidad').popover('hide');
	});	
	$('#precio').on('click',function(){
		$('#precio').popover('hide');
	});

	//Agregar Cliente o Empresa

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
    });
});


//  Para agregar un nuevo cliente
$("#departamento").on("change", function () {
    $.ajax({
        url: BASEURL + 'Venta/UbigeoPro',
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
        url: BASEURL + 'Venta/UbigeoDis',
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


$("#formapago").on("change",function(){
    if($(this).val()==2){
        $.ajax({
            type:"POST",
            data:"codcliente="+$("#codcliente").val(),
            url:BASEURL+"Estadia/DeudasTodas",
            success: function(data){               
                $("#debetotal").attr("placeholder", "Deuda: S/. "+data);
                $("#credito").show();                    
            }
        });
    }else{
        $("#credito").hide();
    } 
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Venta");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$("#ContenidoPrincipal").load(BASEURL+"Venta/nuevo");
}

function Verlaventa(codventa){
    $("#ContenidoPrincipal").load(BASEURL + "Venta/Verventa",{id:codventa});
}
function Modificar(){
	$("#ContenidoPrincipal").load(BASEURL+"Venta/modificar");
}

function Cancelar(){
	$("#ContenidoPrincipal").load(BASEURL+"Venta");
}

function ProductoSeleccionado(cod,des,pre){
	$("#producto").val(des);
	$("#codproducto").val(cod);
	$("#precio").val(pre);
}

var cont=0;var htmlc="";
function TraerCliente() { 
    $("#tablacliente tbody").empty();
    $.ajax({
        url: BASEURL + 'Venta/TraerClientes',
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
            $("#tablacliente tbody").append(htmlc);
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

function EmpresaSeleccionado(cod,razon){
    razon=razon.split("_").join(" ");
    $("#cliente").val(razon);
    $("#codcliente").val(cod);
}

function setdatatablescliente(cont){
    if (cont==0) {
        $('#tablacliente').DataTable({
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
    if(obj.correoelec.value==""){
        $('#correoelec').popover('show'); return 0;
    }else{
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        if(!regex.test($('#correoelec').val().trim())) {
            $('#correoelec').popover('show'); return 0;
        }
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
        url:BASEURL+"Venta/GuardarClienteNuevo",
        success: function(data){
            alert("Cliente Registrado Correctamente");
            $("#AgregarCliente").modal('hide');
            $("#ForNuevoCliente").trigger("reset");
        }
    });
}


html= "";var subtotalventa=[];var igvventa=[];var c_sub_total=0;subtotales1=0;
var igvventa1=0; var igv=0;

function Agregar(obj){
	if(obj.producto.value==""){
		$('#producto').focus();
		$('#producto').popover('show'); return 0;
	}
	if(obj.cantidad.value==""){
		$('#cantidad').focus();
		$('#cantidad').popover('show'); return 0;
	}
	if(obj.precio.value==""){
		$('#precio').focus();
		$('#precio').popover('show'); return 0;
	}
	if(obj.cantidad.value!=""){
		$.ajax({
			type:"POST",
			data:$('#ForVenta').serialize(),
			url:BASEURL+"Venta/Cantidadstock",
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
                            totaligv = decimales(totaligv);
                        }else{
                            var totaligv=0.0;
                        }
                        igvventa[c_sub_total]=totaligv;

						html ="<tr id='Producto_"+$("#codproducto").val()+"'>"+
						"<td> <input type='hidden' name='cantidaddetalle[]' value='"+$("#cantidad").val()+"'> "+$("#cantidad").val()+"</td>"+
						"<td> <input type='hidden' name='idproductodetalle[]' value='"+$("#codproducto").val()+"'> "+$("#producto").val()+"</td>"+
						"<td> <input type='hidden' name='preciodetalle[]' value='"+$("#precio").val()+"'> "+$("#precio").val()+"</td>"+
						"<td> "+$("#precio").val()*$("#cantidad").val()+"</td>"+ 
                        "<td> <input type='hidden' name='igvdetalle[]' value='"+totaligv+"'> "+totaligv+"</td>"+ 
						"<td><a onclick=$(this).closest('tr').remove();QuitarSubtotal("+c_sub_total+");><span class='glyphicon glyphicon-remove' style='color:#D01111'></span> </a></td></tr>";

						$("#tabladetalleventas tbody").append(html);
						subtotales1=subtotales1+$("#cantidad").val()*$("#precio").val();
                        igvventa1=decimales(igvventa1+totaligv);
                        $("#subtotal").val(subtotales1);
                        $("#igv").val(igvventa1);
                        var tot=decimales(igvventa1+subtotales1);
                        $("#total").val(tot);
                        c_sub_total ++;
					}else{
						alert("Ya Agrego Este Producto");
					}

                    //Limpiando Los Campos
                    $("#producto").val("");$("#cantidad").val("");$("#precio").val("");
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
    igvcons=igvcons-eval(igvventa[i]);
    igvventa1=igvventa1-eval(igvventa[i]);

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

function Guardar(obj){
	if(obj.cliente.value==""){
		$('#cliente').popover('show'); return 0;
	}
	if(obj.formapago.value=="formapago"){
		$('#formapago').popover('show'); return 0;
	}
	if(obj.formapago.value==2){
		if (obj.nrocuotas.value=="") {
			$('#nrocuotas').popover('show'); return 0;
		}
		if (obj.intervalodias.value=="") {
			$('#intervalodias').popover('show'); return 0;
		}
	}
	if ($("#tabladetalleventas tbody tr").length==0) {
        alert('No Ha Vendido Ningun Producto');return 0;
    }

	$("#codventa").removeAttr("disabled");
	
	if (obj.formapago.value==2) {
        $("#tablacuotas tbody").empty();
        var intervaldias = $('#intervalodias').val();
        var nrocuotas = parseInt($('#nrocuotas').val());
        var montocuota = $("#total").val()/nrocuotas;
        subtotal = Math.round(montocuota * 100) / 100;
        montocuota=subtotal.toFixed(2);

        var f = new Date();
        var fecha= f.getDate() + "-" + (f.getMonth() +1) + "-" + f.getFullYear();

        if (f.getDate()<10) {
            var fechabase= f.getFullYear() + "-" + (f.getMonth() +1) + "-0" + f.getDate();
        }else{
            var fechabase= f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();
        }

        var html="";
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
            data:$('#ForVenta').serialize(),
			url:BASEURL+"Venta/GuardarVenta",
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

function AhoraMandaGuardar(obj){
    var sum=0;
    $('input[name^="montocuota"]').each(function() {
        sum=sum+parseFloat($(this).val());
    });
    if (obj.total.value!=sum) {
        alert("Distribucion Incorrecta - El Total Es "+obj.total.value); return 0;
    }

    $("#ListaCuotas").modal("hide");
    $.ajax({
        type:"POST",
        data:$('#ForVenta').serialize(),
		url:BASEURL+"Venta/GuardarVenta",
        success: function(data){
            $("#Mensaje").html(data);
            $('#Alerta').modal({
                show:true,
                backdrop:'static'
            });
        }
    });
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
function NumerosCuota(e){
    tecla = e.keyCode || e.which; 
    base =/[0-9.]/; 
    teclado = String.fromCharCode(tecla).toLowerCase(); 
    return base.test(teclado); 
}


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