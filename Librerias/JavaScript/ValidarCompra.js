$(function(){	
	$('[data-toggle="popover"]').popover();
	$("#credito").hide();

	$('#proveedor').on('click',function(){
		$('#proveedor').popover('hide');
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
    $('#factura').on('click',function(){
        $('#factura').popover('hide');
    }); 
    $('#fechacompra').on('click',function(){
        $('#fechacompra').popover('hide');
    }); 

	$('#cantidad').on('click',function(){
		$('#cantidad').popover('hide');
	});	
	$('#precio').on('click',function(){
		$('#precio').popover('hide');	
	});
});

$("#formapago").on("change",function(){
	if($(this).val()==2){
		$("#credito").show();
	}else{
		$("#credito").hide();
	}
});

function actualiza_contenido(){
	$("#ContenidoPrincipal").load(BASEURL+"Compra");
}

function Actualizando(){
	$('#Alerta').modal('hide');
	setTimeout("actualiza_contenido()", 200);
}

function Nuevo(){
	$("#ContenidoPrincipal").load(BASEURL+"Compra/nuevo");
}

function Verlacompra(codcompra){
    $("#ContenidoPrincipal").load(BASEURL + "Compra/Vercompra",{id:codcompra});
}

function Cancelar(){
	$("#ContenidoPrincipal").load(BASEURL+"Compra");
}

var cont1=0;var htmlpro="";
function TraerProveedores() { 
    $("#listaproveedores tbody").empty();
    $.ajax({
        url: BASEURL + 'Compra/TraerProveedores',
        success: function (data) {
            var datos = eval(data);           
            for (var i = 0; i < datos.length; i++){
                htmlpro += "<tr>";
                htmlpro += "<td>"+datos[i]['ruc'] + "</td>"; 
                htmlpro += "<td>"+datos[i]['razonsocial']+ "</td>"; 
                htmlpro += "<td>"+datos[i]['direccion']+ "</td>"; 
                htmlpro += "<td> <center> <a data-dismiss='modal' onclick=ProveedorSeleccionado("+datos[i]['codproveedor']+",'"+datos[i]['razonsocial'].split(" ").join("_")+"'); >"+
                "<span class='glyphicon glyphicon-ok'></span></a></center></td>";
                htmlpro += "</tr>";              
            }
            $("#listaproveedores tbody").append(htmlpro);
            htmlpro="";
            setdatatablesproveedores(cont1);
            cont1=cont1+1;
        }
    }); 
}

function setdatatablesproveedores(cont){
    if (cont1==0) {
        $('#listaproveedores').DataTable({
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

function ProveedorSeleccionado(cod,razon){
	$("#proveedor").val(razon.split("_").join(" "));
	$("#codproveedor").val(cod);
}

var cont=0;var htmlc="";
function TraerProductos() { 
    $("#listaproductos tbody").empty();
    $.ajax({
        url: BASEURL + 'Compra/TraerProductos',
        success: function (data) {
            var datos = eval(data);
            for (var i = 0; i < datos.length; i++){
                htmlc += "<tr>";
                htmlc += "<td>"+datos[i]['descripcion'] + "</td>"; 
                htmlc += "<td>"+datos[i]['stockactual']+ "</td>"; 
                htmlc += "<td>"+datos[i]['cobrarigv']+ "</td>"; 
                htmlc += "<td> <center> <a data-dismiss='modal' onclick=ProductoSeleccionado("+datos[i]['codproducto']+","+datos[i]['precio']+",'"+datos[i]['cobrarigv']+"','"+datos[i]['descripcion'].split(" ").join("_")+"'); >"+
                "<span class='glyphicon glyphicon-ok'></span></a></center></td>";
                htmlc += "</tr>";                
            }
            $("#listaproductos tbody").append(htmlc);
            htmlc="";
            setdatatablesproductos(cont);
            cont=cont+1;
        }
    }); 
}

function setdatatablesproductos(cont){
    if (cont==0) {
        $('#listaproductos').DataTable({
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

function ProductoSeleccionado(cod,precio,igv,des){
	$("#producto").val(des.split("_").join(" "));
	$("#precio").val(precio);
	$("#conigv").val(igv);
	$("#codproducto").val(cod);
}

html= "";var subtotalcompra=[];var igvcompra=[];var c_sub_total=0;subtotales1=0;
var igvcompra1=0; var igv=0;

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

	if($("#Producto_"+$("#codproducto").val()).length==false){
		subtotalcompra[c_sub_total]=eval($("#cantidad").val()*$("#precio").val());
		if ($("#conigv").val()=="SI") {
	        var totalig = eval($("#cantidad").val()*$("#precio").val()*0.18);
            var totaligv = decimales(totalig);
        }else{
            var totaligv=0.0;
        }
        igvcompra[c_sub_total]=totaligv;

		html ="<tr id='Producto_"+$("#codproducto").val()+"'>"+
			"<td> <input type='hidden' name='cantidaddetalle[]' value='"+$("#cantidad").val()+"'> "+$("#cantidad").val()+"</td>"+
			"<td> <input type='hidden' name='idproductodetalle[]' value='"+$("#codproducto").val()+"'> "+$("#producto").val()+"</td>"+
			"<td> <input type='hidden' name='preciodetalle[]' value='"+$("#precio").val()+"'> "+$("#precio").val()+"</td>"+
			"<td> "+$("#precio").val()*$("#cantidad").val()+"</td>"+ 
            "<td> <input type='hidden' name='igvdetalle[]' value='"+totaligv+"'> "+totaligv+"</td>"+ 
			"<td><a onclick=$(this).closest('tr').remove();QuitarSubtotal("+c_sub_total+");><span class='glyphicon glyphicon-remove' style='color:#D01111'></span> </a></td>"+
		"</tr>";

		$("#tabladetallecompras tbody").append(html);
		subtotales1=subtotales1+$("#cantidad").val()*$("#precio").val();
        igvcompra1=decimales(igvcompra1+totaligv);
        $("#subtotal").val(subtotales1);
        $("#igv").val(igvcompra1);
        var tot=decimales(igvcompra1+subtotales1);
        $("#total").val(tot);
        c_sub_total ++;
	}else{
		alert("Ya Agrego Este Producto");
	}

    //Limpiando Los Campos
    $("#producto").val("");$("#cantidad").val("");$("#precio").val("");
}

QuitarSubtotal=function(i){
	subtotal1=eval($("#subtotal").val());
	subtotal1=subtotal1-eval(subtotalcompra[i]);
	subtotales1=subtotales1-eval(subtotalcompra[i]);

    igvcons=eval($("#igv").val());
    igvcons=igvcons-eval(igvcompra[i]);
    igvcompra1=igvcompra1-eval(igvcompra[i]);

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
	if(obj.proveedor.value==""){
		$('#proveedor').popover('show'); return 0;
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
	if ($("#tabladetallecompras tbody tr").length==0) {
        alert('No Ha Comprado Ningun Producto');return 0;
    }

	$("#codcompra").removeAttr("disabled");

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
            data:$('#ForCompra').serialize(),
			url:BASEURL+"Compra/GuardarCompra",
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
        data:$('#ForCompra').serialize(),
		url:BASEURL+"Compra/GuardarCompra",
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


//  Para Agregar Proveedor
$(function(){   
    $('#rucem').on('click',function(){
        $('#rucem').popover('hide');
    });
    $('#razon').on('click',function(){
        $('#razon').popover('hide');
    }); 
    $('#tel').on('click',function(){
        $('#tel').popover('hide');
    }); 
    $('#cel').on('click',function(){
        $('#cel').popover('hide');
    }); 
    $('#dire').on('click',function(){
        $('#dire').popover('hide');
    }); 
    $('#correoelec').on('click',function(){
        $('#correoelec').popover('hide');
    });

    $('#AgregarOtroProveedor').on( 'click', function () {
        var table1 = $('#listaproveedores').DataTable();
        table1.destroy();
        cont1=0;
        $('#listaproveedores tbody').empty();
    });
});

function GuardarProveedor(obj){
    if(obj.rucem.value=="" || obj.rucem.value.length<11){
        $('#rucem').popover('show'); return 0;
    }
    if(obj.razon.value==""){
        $('#razon').popover('show'); return 0;
    }
    if(obj.tel.value==""){
        $('#tel').popover('show'); return 0;
    }
    if(obj.cel.value==""){
        $('#cel').popover('show'); return 0;
    }
    if(obj.dire.value==""){
        $('#dire').popover('show'); return 0;
    }
    if(obj.correoelec.value==""){
        $('#correoelec').popover('show'); return 0;
    }
    if(obj.correoelec.value==""){
        $('#correoelec').popover('show'); return 0;
    }else{
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        if(!regex.test($('#correoelec').val().trim())) {
            $('#correoelec').popover('show'); return 0;
        }
    }

    $.ajax({
        type:"POST",
        data:$('#ForNuevoProveedor').serialize(),
        url:BASEURL+"Compra/GuardarProveedor",
        success: function(data){
            alert(data);
            $("#ForNuevoProveedor").trigger("reset");
            $("#AgregarProveedor").modal("hide");
        }
    });
}

//  Para Agregar Producto
$(function(){   
    $('#tipop').on('click',function(){
        $('#tipop').popover('hide');
    });
    $('#descrip').on('click',function(){
        $('#descrip').popover('hide');
    }); 
    $('#stockmin').on('click',function(){
        $('#stockmin').popover('hide');
    }); 
    $('#stockmax').on('click',function(){
        $('#stockmax').popover('hide');
    }); 
    $('#preciop').on('click',function(){
        $('#preciop').popover('hide');
    }); 
    $('#cigv').on('click',function(){
        $('#cigv').popover('hide');
    });

    $('#AgregarOtroProducto').on( 'click', function () {
        var table = $('#listaproductos').DataTable();
        table.destroy();
        cont=0;
    });
});

function GuardarProducto(obj){
    if(obj.tipop.value=="tipo"){
        $('#tipop').popover('show'); return 0;
    }
    if(obj.descrip.value==""){
        $('#descrip').popover('show'); return 0;
    }
    if(obj.stockmin.value==""){
        $('#stockmin').popover('show'); return 0;
    }
    if(obj.stockmax.value==""){
        $('#stockmax').popover('show'); return 0;
    }
    if(obj.preciop.value==""){
        $('#preciop').popover('show'); return 0;
    }
    if(obj.cigv.value==""){
        $('#cigv').popover('show'); return 0;
    }

    $.ajax({
        type:"POST",
        data:$('#ForNuevoProducto').serialize(),
        url:BASEURL+"Compra/GuardarProducto",
        success: function(data){
            alert(data);
            $("#ForNuevoProducto").trigger("reset");
            $("#AgregarProducto").modal("hide");
        }
    });
}