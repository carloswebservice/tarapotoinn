<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarVenta.js"></script> 

	<div class="container" style="width:100%;">		
		<center><h5 style="font-size:15px;"><b> Ventas Realizadas</b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
		<div>
			<button type="button" class="btn btn-success btn-xs" id="NuevoC" onclick="Nuevo();" style="position:absolute;z-index:2;">
			&nbsp; <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nueva Venta &nbsp;</button> 
		</div>
		<div style="margin-top:5px;z-index:1;"></div>
		<table id="tablaventas">
			<thead>
				<tr>
					<th><center> # </center></th>
					<th><center> DNI Cliente </center></th>
					<th><center> Cliente </center></th>
					<th><center> Fecha </center></th>
					<th><center> Importe </center></th>
					<th><center> Acciones </center></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($Ventas as $value): ?>
					<tr>
						<td><center> <?php echo $value->codventas; ?></center></td>
						<td><center> <?php echo $value->dnicliente; ?></center></td>
						<td><center> <?php echo $value->nombre." ".$value->appaterno; ?></center></td>
						<td><center> <?php echo $value->fechaventa; ?></center></td>
						<td><center> <?php echo " S/. ".$value->importe; ?></center></td>
						<td>
                            <button class="btn btn-info btn-xs" style="margin-bottom:2px;" onclick="Verlaventa(<?php echo $value->codventas;?>);"><span class="glyphicon glyphicon-eye-open"></span> Ver Venta</button>
                        </td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<script language="javascript">
			$(function() {
				$('#tablaventas').DataTable({
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
	#tablaventas{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaventas th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaventas td{
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