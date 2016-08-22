<body>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarMovimiento.js"></script>

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Movimientos </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForMovimiento">
			<div class="form-group">
				<div class="col-sm-3">
					<select id="tipomov"  name="tipomov" class="form-control">
						<option value="tmov">Tipo Movimiento</option>
						<option value="1" >Ingreso</option>
						<option value="2" >Egreso</option>
					</select>
				</div>	

				<label class="col-sm-1 control-label">Concepto</label>
				<div class="col-sm-3">
					<select id="conceptos" name="concepto"  class="form-control">

					</select>
				</div>

				<label id="labeln" class="col-sm-1 control-label"></label>
				<div class="col-sm-4">
					<div class="input-group">
						<input type="text" class="form-control" name="cliente" id="cliente" disabled="disabled"
						data-toggle="popover" data-placement="bottom" data-content="Buscar ... ">
						<input type="hidden" name="codcliente" id="codcliente">
						<div class="input-group-addon">
							<a href="#" onclick="RecordCliente();"><span class="glyphicon glyphicon-search" style="color:#6E6E6E;"></span></a>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group ">
				<label class="col-sm-2 control-label">Forma De Pago</label>
				<div class="col-sm-2">
					<select id="formapago" name="formapago" class="form-control"
					data-toggle="popover" data-placement="bottom" data-content="Seleccione Forma Pago">
						<option value="formapago"></option>
						<option value="1">Efectivo</option>
						<option value="2">Tarjeta</option>
					</select>
				</div>
				<label class="col-sm-2 control-label">Comprobante</label>
				<div class="col-sm-3">
					<select id="tipocomprobante2" name="tipocomprobante" class="form-control"
					data-toggle="popover" data-placement="bottom" data-content="Seleccione Tipo Comprobante">
						<option value=""></option>
						<option value="1">Factura</option>
						<option value="2">Boleta</option>
					</select>
				</div>
				<div class="col-sm-3">
					<input class="form-control" name="correlativo" id="correlativo" placeholder="correlativo"
					data-toggle="popover" data-placement="bottom" data-content="# Comprobante">
				</div>
			</div>
			<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
            <div class="form-group ">
            	<!--<div class="col-sm-3">
                    <button id="nuevomovi" type="button" class='btn btn-success btn-xs' onclick='nuevomovimiento()' ><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</button>
                    <button id="imprimir" type="button" class='btn btn-info btn-xs' onclick='imprimirmovi()' ><span class="glyphicon glyphicon-print"></span> Imprimir</button>
                </div> -->
            	<label class="col-sm-8 control-label">Ingresar Monto</label>
                <div class="col-sm-2">
                	<input type="hidden" class="form-control" id="montoquedebe">
                    <input type="text" class="form-control" id="montoamortiza" name="montoamortiza">
                </div>
                <div class="col-sm-2">
                    <button id="dis" type="button" class='btn btn-success btn-xs' onclick='amortiza(this.form)' >Distribuir</button>
                </div>
            </div>
		</form>

		<table class="ocultaconc" id="tablapagos">
			<thead>
                <tr><th colspan="6" >Lista de Pagos</th></tr>
				<tr>
                    <th><center> Concepto </center></th>
					<th><center> Fecha </center></th>
					<th><center> Total a Pagar </center></th>
                    <th><center> Total Cobrado </center></th>
                    <th><center> Saldo </center></th>
					<th><center> Cronograma </center></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table> <br>

		<table class="ocultaconc" id="tablaproductos">
			<thead>
                <tr>
                    <th colspan="5">Cronograma de Pagos</th>
                </tr>
				<tr>
					<th><center> N° Cuota </center></th>
					<th><center> Monto </center></th>
                    <th><center> Monto Pagado</center></th>
					<th><center> Fecha Vencimiento </center></th>
					<th><center> Estado </center></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table> <br>
	</div>
</body>

<!--Modal Para Amortizar-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center><h5 class="modal-title" id="myModalLabel"><b>Amortizar Cuota (<?php echo date("d / m / Y");?>) </b></h5></center>
            </div>
            <div id="modalbebe" class="modal-body">
            	<form class="form-horizontal">
	            	<div class="form-group">
		                <label class="col-sm-3 control-label">Monto</label>
		                <div class="col-sm-3">
		                	<input class="form-control" type="number" id="montoamortiza" >
		                </div>
		                <div class="col-sm-4">
		                	<button type="button" onclick="amortizaya()" class="btn btn-success btn-xs" data-dismiss="modal">Amortizar</button>
		                	<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
		                </div>
		                
		                <input type="hidden" id="idestadiaxd" >
		                <input type="hidden" id="conceptoxd" >
		            </div>
	            </form>
            </div>
        </div>
    </div>
</div>

<!--Para Buscar Cliente-->
<div class="modal fade" id="Clientes" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center><b> Hotel Tarapoto Inn - Lista De Clientes </b></center>
                    </h4>
                </div>
                <div class="modal-body">
                    <div id="BuscarPersona">
                        <table id="TablaClientes">
                            <thead>
                                <tr>
                                    <th><center> DNI/RUC </center></th>
                                    <th><center> Cliente / Razon Social</center></th>
                                    <th><center> Accion </center></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach ($Clientes as $value): ?>
									<tr>
										<?php
											if ($value->razonsocial==null) { ?>
												<td><center> <?php echo $value->dnicliente ?></center></td>
												<td><center> <?php echo $value->nombre.' '.$value->appaterno.' '.$value->apmaterno; ?></center></td>
												<td>
						                        	<a href="#" onclick="Selecciona(<?php echo $value->codcliente;?>,'<?php echo $value->nombre.' '.$value->appaterno.' '.$value->apmaterno;?>');"><span class="glyphicon glyphicon-ok"></span> </a>
						                        </td>
											<?php }else{ ?>
												<td><center> <?php echo $value->ruc ?></center></td>
												<td><center> <?php echo $value->razonsocial; ?></center></td>
												<td>
						                        	<a href="#" onclick="Selecciona(<?php echo $value->codcliente;?>,'<?php echo $value->razonsocial;?>');"><span class="glyphicon glyphicon-ok"></span> </a>
						                        </td>
											<?php }
										?>
				                    </tr>
								<?php endforeach ?>
							</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="Proveedores" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center><b> Hotel Tarapoto Inn - Lista De Proveedores </b></center>
                    </h4>
                </div>
                <div class="modal-body">
                    <div id="BuscarPersona">
                        <table id="TablaProveedor">
                            <thead>
                                <tr>
                                    <th><center> DNI </center></th>
                                    <th><center> Razon Social</center></th>
                                    <th><center> Accion </center></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach ($Proveedores as $value): ?>
									<tr>
										<td><center> <?php echo $value->ruc ?></center></td>
										<td><center> <?php echo $value->razonsocial; ?></center></td>
										<td>
				                        	<a href="#" onclick="Selecciona(<?php echo $value->codproveedor;?>,'<?php echo $value->razonsocial;?>');"><span class="glyphicon glyphicon-ok"></span> </a>
				                        </td>
				                    </tr>
								<?php endforeach ?>
							</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
<script language="javascript">
			$(function() {
				$('#TablaClientes').DataTable({
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

				$('#TablaProveedor').DataTable({
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

<style type="text/css">
	#TablaClientes{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#TablaClientes th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center;
	}
	#TablaClientes td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center;
	}
	#TablaProveedor{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#TablaProveedor th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center;
	}
	#TablaProveedor td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center;
	}
	table{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	table th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center;
	}
	table td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center;
	}
	label{
		font-size: 13px;
	}
</style>
