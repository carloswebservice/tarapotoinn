$(document).ready(function(){
    $("#cargo").on("change",function(){
        var id = $(this).val();
        if (id=="cargo") {
            $("#cargamodulos").hide();
        }else{     
            $("#cargamodulos").show();
            $.post(BASEURL+"Permisos/getmodulos",{id:id},function(response){
                $("#cargamodulos").empty();
                $("#cargamodulos").append(response);
            });
        }          
    });

    $("#graba").on("click",function(){
        $.post(BASEURL+"Permisos/grabar",$("#holaform").serialize(),function(response){
            $("#Mensaje").html(response);
            $('#Alerta').modal({
                show:true,
                backdrop:'static'
            }); 
        });
    });
});

function actualiza_contenido(){
    $("#ContenidoPrincipal").load(BASEURL+"Permisos");
}

function Actualizando(){
    $('#Alerta').modal('hide');
    setTimeout("actualiza_contenido()", 200);
}