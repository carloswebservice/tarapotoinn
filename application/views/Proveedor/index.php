<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script> 
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarProveedor.js"></script> 

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Proveedores </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForProveedor">
			<div class="tab-content">
				<input type="hidden" class="form-control" name="codproveedor" id="codproveedor" disabled="disabled">
				<div class="form-group">
					<label class="col-md-1 control-label">RUC</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="ruc" id="ruc" disabled="disabled" onkeyup="RUCempresa(this)" onkeypress="return Numeros(event)"
							maxlength="11" data-toggle="popover" data-placement="bottom" data-content="Ingrese RUC">
					</div>
					<label class="col-md-2 control-label">Razon Social</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="razonsocial" id="razonsocial" disabled="disabled" onkeypress="return Letras(event)"
							maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Razon Social">
					</div>
					<label class="col-md-1 control-label">Celular</label>
					<div class="col-md-2">
						<input type="text" class="form-control" name="celular" id="celular" disabled="disabled" onkeypress="return Numeros(event)"
							maxlength="9" data-toggle="popover" data-placement="bottom" data-content="Ingrese Nº Celular">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-1 control-label">Direccion</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="direccion" id="direccion" disabled="disabled" onkeypress="return NumerosLetras(event)"
							maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Direccion">
					</div>
					<label class="col-md-2 control-label">Email</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="email" id="email" disabled="disabled" onkeypress="return ValidarEmail(event)"
							maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese Email Valido">
					</div>
					<label class="col-md-1 control-label">Telefono</label>
					<div class="col-md-2">
						<input type="text" class="form-control" name="telefono" id="telefono" disabled="disabled" onkeypress="return Numeros(event)"
							maxlength="6" data-toggle="popover" data-placement="bottom" data-content="Ingrese RUC">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-1 control-label">RPM</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="rpm" id="rpm" disabled="disabled" onkeypress="return NumerosCaracteres(event)"
							maxlength="10" data-toggle="popover" data-placement="bottom" data-content="Ingrese RPM">
					</div>
					<label class="col-md-2 control-label">Zona Ref.</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="zona" id="zona" disabled="disabled" onkeypress="return Letras(event)"
							maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Zona Referencial">
					</div>
					<label class="col-md-1 control-label">RPC</label>
					<div class="col-md-2">
						<input type="text" class="form-control" name="rpc" id="rpc" disabled="disabled" onkeypress="return NumerosCaracteres(event)"
							maxlength="10" data-toggle="popover" data-placement="bottom" data-content="Ingrese RPC">
					</div>		
				</div>
			</div>
			<div class="row">
				<center>
					<button type="button" class="btn btn-success btn-xs" id="NuevoE" onclick="Nuevo();">
			    	<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo </button> 

					<button type="button" class="btn btn-info btn-xs" id="GuardarE" disabled="disabled" onclick="return Guardar(this.form);">
				   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

					<button type="button" class="btn btn-warning btn-xs" id="ModificarE" disabled="disabled" onclick="return Modificar(this.form);">
					<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modificar</button>	

					<button type="button" class="btn btn-danger btn-xs" id="CancelarE" disabled="disabled" onclick="Cancelar();">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
				</center>
			</div>	
		</form>

		<center><h5 style="font-size:15px;"><b> Lista De Nuestros Proveedores </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<table class="table table-hover table-condensed" id="tablaproveedores">
			<thead>
				<tr>
					<th><center> Codigo </center></th>
					<th><center> Razon Social </center></th>
					<th><center> RUC </center></th>
					<th><center> Direccion </center></th>
					<th><center> Celular </center></th>
					<th><center> Accion </center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($Proveedores as $value): ?>
					<tr>
						<td><center> <?php echo $value->codproveedor; ?></center></td>
						<td><center> <?php echo $value->razonsocial; ?></center></td>
						<td><center> <?php echo $value->ruc; ?> </center></td>
						<td><center> <?php echo $value->direccion; ?></center></td>
						<td><center> <?php echo $value->celular; ?></center></td>
						<td><center> 
							<a onclick='VerMas(<?php echo $value->codproveedor; ?>);'><span class='glyphicon glyphicon-sunglasses'></span>
							</a> &nbsp;&nbsp;
							<a onclick='Modifica(<?php echo $value->codproveedor; ?>);'><span class='glyphicon glyphicon-pencil'></span>
							</a> &nbsp;&nbsp;
							<a onclick='Eliminar(<?php echo $value->codproveedor; ?>)'><span class='glyphicon glyphicon-trash' style="color:red"></span>
							</a>
						</center></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<script language="javascript">
			$(function() {
				$('#tablaproveedores').DataTable({
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
	#tablaproveedores{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaproveedores th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaproveedores td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>