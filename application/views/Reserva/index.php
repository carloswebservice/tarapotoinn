<body>
    <script src="<?php echo base_url();?>Librerias/JavaScript/ValidarReserva.js"></script>

    <div class="container" style="width:100%;">
        <center><h5 style="font-size:15px;"><b> Reservas Activas En EL Hotel</b></h5></center>
        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

        <table class="table table-hover table-condensed" id="tablaestadias">
            <thead>
                <tr>
                    <th><center> # </center></th>
                    <th><center> Cliente </center></th>
                    <th><center> Fecha Reserva </center></th>
                    <th><center> Salida </center></th>
                    <th><center> Acciones</center></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Reservas as $value): 
                    if ($value->fechareserva < date('Y-m-d')){
                        $estilo="color:red";
                    }else{
                        if ($value->fechareserva == date('Y-m-d')) {
                            $estilo="color:orange";
                        }else{
                            $estilo="";
                        }                     
                    } ?>
                    <tr style="<?php echo $estilo;?>">
                        <td><center> <?php echo $value->codestadia; ?></center></td>
                        <?php
                            if ($value->razonsocial==null) { ?>
                                <td><center> <?php echo $value->nombre.' '.$value->appaterno.' '.$value->apmaterno; ?></center></td>
                            <?php }else{ ?>
                                <td><center> <?php echo $value->razonsocial; ?></center></td>
                            <?php }
                        ?>
                        <td><center> <?php echo $value->fechareserva; ?></center></td>
                        <td><center> <?php echo $value->fechasalida; ?></center></td>
                        <td>
                            <?php 
                                if ($value->tipodepago==null) { ?>
                                    <button class="btn btn-info btn-xs" style="margin-bottom:2px;"  onclick="Ver(<?php echo $value->codestadia; ?>)" > <span class="glyphicon glyphicon-eye-open"></span> Reserva</button>
                                    <button class="btn btn-warning btn-xs" disabled style="margin-bottom:2px;" > Reserva &nbsp;En&nbsp;Linea</button>
                                    <button class="btn btn-danger btn-xs" style="margin-bottom:2px;"  onclick="Anular(<?php echo $value->codestadia; ?>)" > Anular</button>
                                <?php }else{ ?>
                                    <button class="btn btn-info btn-xs" style="margin-bottom:2px;"  onclick="Ver(<?php echo $value->codestadia; ?>)" > <span class="glyphicon glyphicon-eye-open"></span> Reserva</button>
                                    <button class="btn btn-default btn-xs" style="margin-bottom:2px;"  onclick="pres(<?php echo $value->codestadia; ?>)" > Procesar A Estadia</button>
                                    <button class="btn btn-danger btn-xs" style="margin-bottom:2px;"  onclick="Anular(<?php echo $value->codestadia; ?>)" > Anular</button>
                                <?php }
                            ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table> <br>
        <center>
            <label><span style="color:red;">ROJO = RESERVA VENCIDA </span> ++ <span style="color:orange;">NARANJA = RESERVA PARA HOY DIA </span> ++ <span>NEGRO = RESERVA PARA DESPUES </span> </label>
        </center>

        <script language="javascript">
            $(function() {
                $('#tablaestadias').DataTable({
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar: ",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            });
        </script>
    </div>
</body>

<style type="text/css">
    #tablaestadias{
        width: 100%;
        border:1px solid #D8D8D8;
        border-collapse: collapse;
        margin:auto;
    }
    #tablaestadias th{
        border:1px solid #D8D8D8;
        padding:5px 10px;
        font-size: 13px;
        text-align: center;
    }
    #tablaestadias td{
        border:1px solid #D8D8D8;
        padding-top:2px;
        padding-bottom: 0px!important;
        font-size: 13px;
        text-align: center;
    }
    #listas{
        width: 100%;
        border:1px solid #D8D8D8;
        border-collapse: collapse;
        margin:auto;
    }
    #listas th{
        border:1px solid #D8D8D8;
        padding:5px 10px;
        font-size: 13px;
        text-align: center;
    }
    #listas td{
        border:1px solid #D8D8D8;
        padding:5px 10px;
        font-size: 13px;
        text-align: center;
    }
    label{
        font-size: 13px;
    }
</style>
