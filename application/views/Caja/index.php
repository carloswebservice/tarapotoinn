<body>
   <script src="<?php echo base_url();?>Librerias/JavaScript/ValidarCaja.js"></script>
   <div class="container" style="width:100%;">		
		<center><h5 style="font-size:15px;"><b> Administracion De Caja</b></h5></center>
   <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
   <?php if(empty($data)): ?>
        <br/> <p>No hay Caja Aperturada</p>
        <button onclick="Aperturar()" class="btn btn-warning">Aperturar Caja</button>
   <?php else: ?>
   	<form method="POST" action="<?php echo base_url();?>Reportes/ReporteMovimientos" target="_blank">
        <div class="form-group">
            <div class="col-md-6">
                <a onclick="Caja('<?php echo $action;?>')" class="btn btn-warning btn-xs"><?php echo $lbl_boton ?></a>
           		<a href="#myModal" role="button" data-toggle="modal" class="btn btn-success btn-xs">Saldo Actual En Caja</a>
            </div> 
            <div class="col-md-3">
           		<input type="date" name="fechahoy" id="fechahoy" class="form-control" value="<?php echo date('Y-m-d')?>">
            </div>  
            <div class="col-md-3">
           		<button type="button" onclick="return reportarmovimientos(this.form);" class="btn btn-info btn-xs">Reporte Movimientos</button>
            </div>         
        </div>
    </form>
        <br> <br> <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
        <table class="table table-hover table-condensed" id="tablacajas">
			<thead>
				<tr>
					<th><center> Empleado </center></th>
					<th><center> Fecha y hora de apertura </center></th>
					<th><center> saldo apertura </center></th>
                    <th><center> Fecha y hora de cierre </center></th>
					<th><center> Saldo de cierre </center></th>
					<th><center> Estado </center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($data as $value): ?>
					<tr>
						<td><center> <?php echo $value["nombre"]." ".$value["appaterno"]; ?></center></td>
						<td><center> <?php echo $value["fecha_hora_apertura"]; ?></center></td>
                        <td><center> <?php echo $value["saldo_apertura"]; ?></center></td>
                        <td><center> <?php if($value['estadocaja']==1){echo 'Caja No Cerrada';}else {echo $value['fecha_hora_cierrre'];}?></center></td>
                        <td><center> <?php if($value['estadocaja']==1){echo 'Caja No Cerrada';}else {echo $value['saldo_cierre'];}?></center></td>
                        <td><center> <?php if($value['estadocaja']==1){echo 'Aperturado';}else {echo "Cerrado";} ?></center></td>					
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
        
        
         <!-- Modal -->
	    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	        <div class="modal-dialog modal-sm">
		        <div class="modal-content"> 
			        <div class="modal-body text-justify">
			            <div class="text-center">
			            	<h4 id="myModalLabel">Saldo Actual De La Caja </h4>
			            	<h4><b>S/. <?php echo $data[0]['saldo_cierre']; ?></b></h4>
			            </div>
			            <button class="btn btn-info btn-xs" data-dismiss="modal" style="margin-left:150px;"> Ok. Cerrar </button>
			        </div>
		        </div>
	        </div>
	    </div>
   <?php endif; ?>

		<script language="javascript">
			$(function() {
				$('#tablacajas').DataTable({
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
	#tablacajas{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablacajas th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablacajas td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>