<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarMovimiento.js"></script>

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Todos Los Movimientos </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
		<table id="tablamovimientosrealizados">
			<thead>
				<tr>
					<th><center> Cliente </center></th>
                    <th><center> Concepto </center></th>
					<th><center> Comprobante </center></th>
					<th><center> # Comprobante </center></th>
                    <th><center> Monto </center></th>
					<th><center> Accion </center></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($Movimientos as $value): ?>
					<tr>
						<td><center> <?php 
							if ($value->nomc=="") {
								echo $value->rz;
							}else{
								echo $value->nomc.' '.$value->app;
							}?>
						</center></td>
						<td><center> <?php echo $value->concepto ?></center></td>
						<td><center> <?php echo $value->tipocomprobante ?></center></td>
						<td><center> <?php echo $value->nrocomprobante ?></center></td>
						<td><center> <?php echo $value->monto ?></center></td>
						<td>
							<button type="button" onclick="Extornar(<?php echo $value->codmovimientos ?>);" class="btn btn-warning btn-xs" style="margin-bottom:2px;"><span class="glyphicon glyphicon-transfer"></span> Extornar</button>         
						</td>
				    </tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="Permiso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><center><b> Necesitas Permiso </b></center></h5>                       
                </div>
                <div class="modal-body">
                    <form method="POST" class="form-horizontal" id="loginadmin">
                    	<input type="hidden" name="movimiento" id"movimiento">
						<div class="form-group">
						    <label class="col-md-4 control-label"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Admin</label>
						    <div class="col-md-8">
							    <input type="text" class="form-control" name="usuario">
							</div>
						</div> 
						<div class="form-group">
						    <label class="col-md-4 control-label"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Clave</label>
						    <div class="col-md-8">
						       <input type="password" class="form-control" name="clave">
						    </div>
						</div>
						<div class="form-group">
						    <div class="col-md-12">
						        <center>
						       		<button type="button" class="btn btn-success btn-xs" onclick="AhoraExtornar(this.form);">
						    		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar</button>
						    		<button type="button" data-dismiss="modal" class="btn btn-danger btn-xs">
						    		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Cancelar</button>
						    	</center>
						    </div>
						</div> 
					</form>
                </div>
            </div>
        </div>
        <script language="javascript">
			$(function() {
				$('#tablamovimientosrealizados').DataTable({
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
	#tablamovimientosrealizados{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablamovimientosrealizados th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablamovimientosrealizados td{
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
