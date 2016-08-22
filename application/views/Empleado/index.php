<style type="text/css">
	#navegar > li > a {
		position: relative;
		display: block;
	    padding: 5px 5px;
	    box-shadow: 0 2px 1px rgba(0, 0, 0, .05);
	}
</style>
<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarEmpleado.js"></script> 

	<div class="container" style="width:100%;">	
		<center><h5 style="font-size:15px;"><b> Empleados </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForEmpleado">
			<div>
				<ul class="nav nav-tabs nav-justified" role="tablist" id="navegar">
				    <li role="presentation" class="active"><a href="#principal" aria-controls="principal" role="tab" data-toggle="tab">Datos Principales</a></li>
				    <li role="presentation"><a href="#otros" aria-controls="otros" role="tab" data-toggle="tab">Otros Datos</a></li>
				</ul>

				<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="principal"> <br>
				    	<input type="hidden" class="form-control" name="codempleado" id="codempleado" disabled="disabled" >
				    	<div class="form-group">
				    		<label class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="nombre" id="nombre" disabled="disabled" onkeypress="return Letras(event)"
									maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Nombre">
							</div>
							<label class="col-sm-2 control-label">Numero DNI</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="dni" id="dni" disabled="disabled" onkeyup="dnicliente(this)" onkeypress="return Numeros(event)"
								 	maxlength="8" data-toggle="popover" data-placement="bottom" data-content="Ingrese DNI">				
							</div>

							<label class="col-sm-1 control-label">Direccion</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="direccion" id="direccion" disabled="disabled" onkeypress="return NumerosLetras(event)"
									maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese direccion">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Ap. Paterno</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="apellidop" id="apellidop"  disabled="disabled" onkeypress="return Letras(event)"
									maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">				
							</div>

							<label class="col-sm-2 control-label">Ap. Materno</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="apellidom" id="apellidom" disabled="disabled" onkeypress="return Letras(event)"
									maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">
							</div>
							<label class="col-sm-1 control-label">Cargo</label>
							<div class="col-sm-3">
								<select id="cargo" name="cargo" disabled="disabled" class="form-control" data-toggle="popover" 
								data-placement="bottom" data-content="Seleccione Cargo">
									<option value="cargo"> Seleccione... </option>
									    <?php foreach ($Cargos as $value): ?>
									    	<option value="<?php echo $value->codcargo;?>"><?php echo $value->descripcion; ?></option>
										<?php endforeach ?>
								</select>
							</div>
						</div>
					</div>

				    <div role="tabpanel" class="tab-pane" id="otros"> <br>
						<div class="form-group">
							<label class="col-sm-1 control-label">Celular</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="celular" id="celular" disabled="disabled" onkeypress="return Numeros(event)"
									maxlength="9" data-toggle="popover" data-placement="bottom" data-content="Ingrese # Celular">
							</div>
							<label class="col-sm-2 control-label">Sexo</label>
							<div class="col-sm-2">
								<select id="sexo" name="sexo" disabled="disabled" class="form-control" data-toggle="popover" 
									data-placement="bottom" data-content="Seleccione Sexo">
									<option value="sexo">Elegir</option>
							    	<option value="masculino">Masculino</option>
							    	<option value="femenino">Femenino</option>
								</select>
							</div>	
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="email" id="email" disabled="disabled" onkeypress="return ValidarEmail(event)"
									maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese Email Correcto">
							</div>
						</div>	

						<div class="form-group">
							<label class="col-sm-1 control-label">Telefono</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="telefono" id="telefono" disabled="disabled" onkeypress="return Numeros(event)"
									maxlength="6" data-toggle="popover" data-placement="bottom" data-content="Ingrese # Telefono">				
							</div>
							<label class="col-sm-2 control-label">Estado Civil</label>
							<div class="col-sm-2">
								<select id="estadocivil" name="estadocivil" disabled="disabled" class="form-control" 
								data-toggle="popover" data-placement="bottom" data-content="Seleccione Estado">
									<option value="estadocivil">Elegir</option>
							    	<option value="Soltero">Soltero(a)</option>
							    	<option value="Casado">Casado(a)</option>
							    	<option value="Divorciado">Divorciado(a)</option>
							    	<option value="Viudo">Viudo(a)</option>
								</select>				
							</div>	
							<label class="col-sm-2 control-label">Zona Ref.</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="zona" id="zona" disabled="disabled" onkeypress="return Letras(event)"
									maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese Zona">
							</div>
						</div>	
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

		<center><h5 style="font-size:15px;"><b> Lista De Los Empleados </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
		
		<table class="table table-hover table-condensed" id="tablaempleados">
			<thead>
				<tr>
					<th><center> DNI </center></th>
					<th><center> Nombre </center></th>
					<th><center> Apellidos </center></th>
					<th><center> Celular </center></th>
					<th><center> Cargo </center></th>
					<th><center> Accion </center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($Empleados as $value): ?>
					<tr>
						<td><center> <?php echo $value->dniempleado; ?></center></td>
						<td><center> <?php echo $value->nombre; ?></center></td>
						<td><center> <?php echo $value->appaterno." ".$value->apmaterno; ?> </center></td>
						<td><center> <?php echo $value->celular; ?></center></td>
						<td><center> <?php echo $value->descripcion; ?></center></td>
						<td><center> 
							<a onclick='Modifica(<?php echo $value->codempleado; ?>);'><span class='glyphicon glyphicon-pencil'></span>
							</a> &nbsp;
							<a onclick='Eliminar(<?php echo $value->codempleado; ?>)'><span class='glyphicon glyphicon-trash' style="color:red"></span>
							</a>
						</center></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table> <br><br>

		<script language="javascript">
			$(function() {
				$('#tablaempleados').DataTable({
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
	#tablaempleados{
		width: 100%;
		border:1px solid #D8D8D8
		border-collapse: collapse;
		margin:auto;
	}
	#tablaempleados th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaempleados td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>