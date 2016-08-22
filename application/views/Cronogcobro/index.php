<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarCronogcobro.js"></script> 

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Cronograma de cobros </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForEstadia">
			<div class="form-group">
				<label class="col-sm-8 control-label"> <center> <h5> <b> Lista De Las Deudas En El Hotel </b> </h5> </center></label>
			
			</div>				
		</form>
		
		<table class="table table-hover table-condensed" id="tablaestadias">
			<thead>
				<tr>
					<th><center> Cod. Estadia </center></th>
					<th><center> Cliente </center></th>
					<th><center> Fecha ingreso </center></th>
					<th><center> Total </center></th>
                                        <th><center> Monto Cobrado </center></th>
                                        <th><center> Monto Restante </center></th>
                                        <th><center> Accion </center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($data as $value): ?>
					<tr>
						<td><center> <?php echo $value["codestadia"]; ?></center></td>
						<td><center> <?php echo $value["nombre"].' '.$value["appaterno"].' '.$value["apmaterno"]; ?></center></td>
						<td><center> <?php echo $value["fechaingreso"]; ?></center></td>
                                                <td><center> <?php echo $value["total"]; ?></center></td>
						<td><center> <?php echo $value["monto_cobrado"]; ?></center></td>
                                                <td><center> <?php echo ($value["total"]-$value["monto_cobrado"]); ?></center></td>
                                                <td>
                                                    <button class="btn btn-info btn-xs" onclick="vercronog(<?php echo $value["codestadia"]; ?>)" >Cronograma</button>
                                                    <button class="btn btn-succes btn-xs" onclick="amortiza(<?php echo $value["codestadia"]; ?>,<?php echo ($value["total"]-$value["monto_cobrado"]); ?>)" >Amortizar</button>
                                                </td>
                                        </tr>
				<?php endforeach ?>
			</tbody>
		</table>
                
                
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Detalle de la estadia</h4>
                        </div>
                        <div id="modalbebe" class="modal-body">
                         
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                
                 <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Amortizar cuota</h4>
                        </div>
                        <div id="modalbebe" class="modal-body">
                            <label>Fecha:</label><input class="form-control"  type="text" value="<?php echo date("Y-m-d"); ?>" readonly="readonly" >
                            <label>Monto:</label><input class="form-control" type="number" id="montoamortiza" >
                            <input type="hidden" id="idestadiaxd" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="amortizaya()" class="btn btn-default" data-dismiss="modal">Aceptar</button>
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
		width: 97%;
		border:1px solid #D8D8D8
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
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>