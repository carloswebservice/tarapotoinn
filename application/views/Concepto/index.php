<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarConcepto.js"></script> 

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Conceptos </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForConceptos">
			<div class="form-group">
				<label class="col-sm-1 control-label">Codigo</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="codconcepto" id="codconcepto"
					disabled="disabled" data-toggle="popover" data-placement="bottom" data-content="Ingrese Codigo">
				</div>
				<label class="col-md-1 control-label">Tipo&nbsp;Mov.</label>
				<div class="col-sm-3 has-default has-feedback">
					<select id="tipomovimiento" name="tipomovimiento" class="form-control" data-toggle="popover" 
						data-placement="bottom" data-content="Seleccione Tipo Movimiento">
						<option value="tipomovimiento">Seleccione ... </option>
						<?php foreach ($TipoMovimientos as $value): ?>
							<option value="<?php echo $value->codtipomovimiento;?>"><?php echo $value->descripcionmov; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<label class="col-sm-2 control-label">Descripcion:</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="descripcion" id="descripcion" disabled="disabled" onkeypress="return Letras(event)"
						   maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Descripcion">
				</div>
			</div>

			<div class="row">
				<center>
					<button type="button" class="btn btn-success btn-xs" id="NuevoC" onclick="Nuevo();">
			    	<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo </button> 

					<button type="button" class="btn btn-info btn-xs" id="GuardarC" disabled="disabled" onclick="return Guardar(this.form);">
				   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

					<button type="button" class="btn btn-warning btn-xs" id="ModificarC" disabled="disabled" onclick="return Modificar(this.form);">
					<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modificar</button>	

					<button type="button" class="btn btn-danger btn-xs" id="CancelarC" disabled="disabled" onclick="Cancelar();">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
				</center>
			</div>				
		</form>

		<center><h5 style="font-size:15px;"><b> Lista De Conceptos </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
		
		<table class="table table-hover table-condensed" id="tablaconceptos">
			<thead>
				<tr>
					<th><center> Codigo </center></th>
					<th><center> Tipo&nbsp;Movimiento </center></th>
					<th><center> Descripcion </center></th>
					<th><center> Accion </center></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($Conceptos as $value): ?>
					<tr>
						<td><center> <?php echo $value->codconcepto; ?></center></td>
						<td><center> <?php echo $value->descripcionmov; ?></center></td>
						<td><center> <?php echo $value->descripcion; ?></center></td>
						<td><center> 
							<a onclick='Modifica(<?php echo $value->codconcepto; ?>);'><span class='glyphicon glyphicon-pencil'></span>
							</a> &nbsp;&nbsp;
							<a onclick='Eliminar(<?php echo $value->codconcepto; ?>)'><span class='glyphicon glyphicon-trash' style="color:red"></span>
							</a>
						</center></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<script language="javascript">
			$(function() {
				$('#tablaconceptos').DataTable({
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
	#tablaconceptos{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaconceptos th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaconceptos td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>