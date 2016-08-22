<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarEstadia.js"></script> 

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Estadias Activas En EL Hotel</b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<div>
			<button type="button" class="btn btn-success btn-xs" id="NuevoC" style="position:absolute;z-index:2;" onclick="Nuevo();">
				&nbsp; <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nueva Estadia &nbsp;</button> 
		</div>
		<div style="margin-top:5px;z-index:1;"></div>
		<table class="table table-hover table-condensed" id="tablaestadias">
			<thead>
				<tr>
					<th><center> # </center></th>
					<th><center> Cliente </center></th>
					<th><center> Ingreso </center></th>
					<th><center> Salida </center></th>
					<th><center> S/. Total </center></th>
                    <th><center> Acciones</center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($Estadias as $value): 
					if ($value->fechasalida < date('Y-m-d')){
                        $estilo="color:red";
                    }else{
                        if ($value->fechasalida == date('Y-m-d')) {
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
						<td><center> <?php echo $value->fechaingreso; ?></center></td>
						<td><center> <?php echo $value->fechasalida; ?></center></td>
						<td><center> <?php echo $value->total; ?></center></td>
                        <td>
                            <button class="btn btn-info btn-xs" style="margin-bottom:2px;" onclick="AgregaConsumo(<?php echo $value->codestadia;?>);"><span class="glyphicon glyphicon-eye-open"></span> Ver Estadia</button>
                            <button class="btn btn-danger btn-xs" style="margin-bottom:2px;" onclick="Terminarestadia(<?php echo $value->codestadia;?>,'<?php echo $value->fechasalida;?>')">Finalizar</button>
                        </td>
                    </tr>
				<?php endforeach ?>
			</tbody>
		</table> <br>
        <center>
            <label><span style="color:red;">ROJO = ESTADIA VENCIDA </span> ++ <span style="color:orange;">NARANJA = ESTADIA TERMINA HOY DIA </span> ++ <span>NEGRO = ESTADIA ACTIVA </span> </label>
        </center>
        
		<div id="xchart-1" style="height: 200px; width: 100%;"></div>
		
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                     	<center><h4 class="modal-title" id="myModalLabel">Datos De La Estadia</h4></center>
                    </div>
                    <div class="modal-body">
                    	<div id="modalbebe"></div> <br>
                    	<button type="button" class="btn btn-success btn-xs" data-dismiss="modal" style="margin-left:450px;">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
                
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