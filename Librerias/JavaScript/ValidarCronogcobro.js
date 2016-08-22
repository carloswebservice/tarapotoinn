 function vercronog(codestadia){
        $.post(BASEURL+"Cronogcobro/vercuota",{ide:codestadia},function(response){
            var html = "<table class='table table-bordered' >";
            html = html+"<tr>";
                html = html+"<th>N° CUOTA</th>";
                html = html+"<th>FECHA COBRO</th>";
                html = html+"<th>MONTO CUOTA</th>";
                html = html+"<th>MONTO COBRADO</th>";
                html = html+"<th>ESTADO</th>";
            html = html+"</tr>";
            $.each(response, function(i, item) {
                html = html+"<tr>";
                html = html+"<td>";
                html = html+item.nrocuota;
                html = html+"</td>";
                html = html+"<td>"+item.fecha+"</td>";
                html = html+"<td>"+item.monto+"</td>";
                html = html+"<td>"+item.monto_cobrado+"</td>";
                html = html+"<td>";
                    if(item.monto != item.monto_cobrado){
                        html = html+"PENDIENTE";
                    }else{
                        html = html+"CANCELADO";
                    }
                html = html+"</td>";
               html = html+"</tr>";
            });
            html = html+"</table>";
            $("#modalbebe").empty();
            $("#modalbebe").append(html);
            $('#myModal').modal("show");
        },"json");
    }


function amortiza(codestadia,debe){
    $("#montoamortiza").val(debe);
    $("#idestadiaxd").val(codestadia);
    $("#montoamortiza").attr("max",debe);
    $('#myModal2').modal("show");
}

function amortizaya(){
    var ide = $("#idestadiaxd").val();
    var monto = $("#montoamortiza").val();

    $.post(BASEURL+"Cronogcobro/amortiza",{id:ide,montoa:monto},function(response){
        $("#ContenidoPrincipal").load(BASEURL+"Cronogcobro");
    },"json");

}
