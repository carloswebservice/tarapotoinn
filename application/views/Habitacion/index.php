<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarHabitacion.js"></script> 

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Lista De Habitaciones </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<div>
			<button type="button" class="btn btn-success btn-xs" id="NuevoC" style="position:absolute;z-index:2;" onclick="Nuevo();">
				&nbsp; <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nueva Habitacion</button> 
		</div>
		<div style="margin-top:5px;z-index:1;"></div>
		<table class="table table-hover" id="tablahabitaciones">
			<thead>
				<tr>
					<th><center> Codigo </center></th>
					<th><center> Numero </center></th>
					<th><center> Tarifa </center></th>
					<th><center> Tipo Habitacion </center></th>
					<th><center> Estado </center></th>
				</tr>
			</thead>
			<tbody>
				<?php $cont=0; foreach ($Habitaciones as $value): 
					if ($value->estado==0) { $cont++; ?>
						<tr style="color:red;font-weight:bold;">
							<td><center> <?php echo $value->codhabitacion; ?></center></td>
							<td><center> <?php echo $value->nrohabitacion; ?></center></td>
							<td><center> <?php echo " S/. ".$value->precio; ?></center></td>
							<td><center> <?php echo $value->descripcion; ?></center></td>
							<td><center> 							
								<button class="btn btn-info btn-xs" style="margin-bottom:2px;"  onclick="Verhabitacion(<?php echo $value->codhabitacion; ?>)" > <span class="glyphicon glyphicon-eye-open"></span> Ver Habitacion</button>
							</center></td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td><center> <?php echo $value->codhabitacion; ?></center></td>
							<td><center> <?php echo $value->nrohabitacion; ?></center></td>
							<td><center> <?php echo " S/. ".$value->precio; ?></center></td>
							<td><center> <?php echo $value->descripcion; ?></center></td>
							<td><center> 							
								<button class="btn btn-info btn-xs" style="margin-bottom:2px;"  onclick="Verhabitacion(<?php echo $value->codhabitacion; ?>)" > <span class="glyphicon glyphicon-eye-open"></span> Ver Habitacion</button>
							</center></td>
						</tr>
					<?php } 
				endforeach ?>
			</tbody>
		</table> <br>
		<div class="row">
			<div class="col-md-6">
				<label><span style="color:red;">ROJO = OCUPADO </span> ++ <span>NEGRO = DISPONIBLE </span> </label>
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" placeholder="Hab. Ocupadas : <?php echo $cont; ?>">
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" placeholder="Hab. Disponibles : <?php echo count($Habitaciones)-$cont; ?>">
			</div>
		</div>
		<script language="javascript">
			$(function() {
				$('#tablahabitaciones').DataTable({
					"language": {
						"sProcessing":     "Procesando...",
					    "sLengthMenu":     "",
					    "sZeroRecords":    "No se encontraron resultados",
					    "sEmptyTable":     "Ningún dato disponible en esta tabla",
					    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
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
	#tablahabitaciones{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablahabitaciones th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablahabitaciones td{
		border:1px solid #D8D8D8;
		padding-top:2px;
        padding-bottom: 0px!important;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>