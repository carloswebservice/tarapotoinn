
<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarCliente.js"></script> 

	<div class="container" style="width:100%;">	
		<center><h5 style="font-size:15px;"><b> Clientes De Hotel Tarapoto Inn</b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
		<div>
			<button type="button" class="btn btn-success btn-xs" id="NuevoC" style="position:absolute;z-index:2;" onclick="Nuevo();">
			&nbsp; <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo Cliente &nbsp;</button> 
		</div>
		<div style="margin-top:5px;z-index:1;"></div>

		<div id="BuscarPersona">
			<table class="table table-hover table-condensed" id="tablaclientes">
				<thead>
					<tr>
						<th><center> DNI </center></th>
						<th><center> Nombre </center></th>
						<th><center> Apellidos </center></th>
						<th><center> Celular </center></th>
						<th><center> Direccion </center></th>
						<th><center> Accion </center></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($Clientes as $value): ?>
						<tr>
							<td><center> <?php echo $value->dnicliente; ?></center></td>
							<td><center> <?php echo $value->nombre; ?></center></td>
							<td><center> <?php echo $value->appaterno." ".$value->apmaterno; ?> </center></td>
							<td><center> <?php echo $value->celular; ?></center></td>
							<td><center> <?php echo $value->direccion; ?></center></td>
							<td><center> 
								<a href="#ModificarCliente" data-toggle="modal" id="AgregarOtroCliente" onclick='Modifica(<?php echo $value->codcliente; ?>);'> <span class='glyphicon glyphicon-pencil'></span>
								</a> &nbsp;
								<a onclick='Eliminar(<?php echo $value->codcliente; ?>)'><span class='glyphicon glyphicon-trash' style="color:red"></span>
								</a>
							</center></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table> <br>
		</div>

		<center><h5 style="font-size:15px;"><b> Empresas Clientes De Hotel Tarapoto Inn</b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<div id="BuscarEmpresa">
			<table class="table table-hover table-condensed" id="tablaempresas">
				<thead>
					<tr>
						<th><center> RUC </center></th>
						<th><center> Razon Social </center></th>
						<th><center> Celular </center></th>
						<th><center> Direccion </center></th>
						<th><center> Accion </center></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($Empresas as $value): ?>
						<tr>
							<td><center> <?php echo $value->ruc; ?></center></td>
							<td><center> <?php echo $value->razonsocial; ?></center></td>
							<td><center> <?php echo $value->celular; ?></center></td>
							<td><center> <?php echo $value->direccion; ?></center></td>
							<td><center> 
								<a href="#ModificarCliente" data-toggle="modal" id="AgregarOtroCliente" onclick='Modifica(<?php echo $value->codcliente; ?>);'> <span class='glyphicon glyphicon-pencil'></span>
								</a> &nbsp;
								<a onclick='Eliminar(<?php echo $value->codcliente; ?>)'><span class='glyphicon glyphicon-trash' style="color:red"></span>
								</a>
							</center></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table> <br><br>
		</div>

		<script language="javascript">
			$(function() {
				$('#tablaclientes').DataTable({
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

		<script language="javascript">
			$(function() {
				$('#tablaempresas').DataTable({
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

	<!--Agregar Cliente-->
    <div class="modal fade" id="ModificarCliente" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center><b> Hotel Tarapoto Inn - Modificar Cliente  </b></center>
                    </h4>                       
                </div>
                <div class="modal-body">
                    <form  class="form-horizontal" id="ForNuevoCliente">
               
                        <div id="clientepersona">
		                    <div class="form-group">
		                    	<input type="hidden" id="idclientee" name="codcliente">
		                        <label class="col-sm-2 control-label">Numero DNI</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="dni" id="dni" onkeypress="return Numeros(event)"
										maxlength="8" data-toggle="popover" data-placement="bottom" data-content="Ingrese DNI">				
								</div>
		                        <label class="col-sm-1 control-label">Nombres</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="nombre" id="nombre" onkeypress="return Letras(event)"
										maxlength="30" data-toggle="pomaxlength="8" over" data-placement="bottom" data-content="Ingrese Nombre">
								</div>
								<label class="col-sm-1 control-label">Sexo</label>
								<div class="col-sm-2">
									<select id="sexo" name="sexo" class="form-control" data-toggle="popover" 
									data-placement="bottom" data-content="Seleccione Sexo">
										<option value="sexo">Seleccione ... </option>
									    <option value="masculino">Masculino</option>
									    <option value="femenino">Femenino</option>
									</select>
								</div>
		                    </div>
		                    <div class="form-group">
								<label class="col-sm-2 control-label">Ap. Paterno</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="apellidop" id="apellidop" onkeypress="return Letras(event)"
										maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">				
								</div>
								<label class="col-sm-3 control-label">Grupo Sanguineo</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="gruposanguineo" id="gruposanguineo" onkeypress="return LetrasCaracteres(event)"
										maxlength="3" data-toggle="popover" data-placement="bottom" data-content="Ingrese Grupo"
										value="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"> 
								</div>
		                    </div>
		                    <div class="form-group">
		                    	<label class="col-sm-2 control-label">Ap. Materno</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="apellidom" id="apellidom" onkeypress="return Letras(event)"
										maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">
								</div>
								<label class="col-sm-3 control-label">Grado Instruccion</label>
								<div class="col-sm-3">
									<select id="grado" name="grado" class="form-control" 
									data-toggle="popover" data-placement="bottom" data-content="Seleccione Grado">
										<option value="grado">Seleccione ... </option>
									    <option value="Profesional">Profesional</option>
									    <option value="Tecnico">Tecnico</option>
									    <option value="Otro">Otro</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Estado Civil</label>
								<div class="col-sm-3">
									<select id="estadocivil" name="estadocivil" class="form-control" 
									data-toggle="popover" data-placement="bottom" data-content="Seleccione Estado">
										<option value="estadocivil">Seleccione ... </option>
									    <option value="Soltero">Soltero(a)</option>
									    <option value="Casado">Casado(a)</option>
									    <option value="Divorciado">Divorciado(a)</option>
									    <option value="Viudo">Viudo(a)</option>
									</select>				
								</div>
								<label class="col-sm-3 control-label">Fecha Nacimiento</label>
								<div class="col-sm-3">
									<input type="date" class="form-control" name="fecha" id="fecha" 
										data-toggle="popover" data-placement="bottom" data-content="Ingrese Fecha">				
								</div>
							</div>
							<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>	
		                </div>   

						<div id="clienteempresa">
		                    <center><h5 style="font-size:15px;"><b> Datos De La Empresa </b></h5></center>
		                    <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
		                    <div class="form-group">
		                        <label class="col-sm-2 control-label">RUC</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="ruc" id="ruc" onkeypress="return Numeros(event)"
										maxlength="11" data-toggle="popover" data-placement="bottom" data-content="Ingrese RUC">
								</div>
		                        <label class="col-sm-3 control-label">Razon Social</label>
		                        <div class="col-sm-3">
		                            <input type="text" class="form-control" name="razons" id="razons" onkeypress="return Letras(event)"
		                                maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Razon Social"> 
		                            <input type="hidden" name="accion" id="accion">              
		                        </div>
		                    </div>
		                </div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Celular</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="celular" id="celular" onkeypress="return Numeros(event)"
									maxlength="9" data-toggle="popover" data-placement="bottom" data-content="Ingrese # Celular">
							</div>
							<label class="col-sm-3 control-label">Email</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="email" id="email" onkeypress="return ValidarEmail(event)"
									maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese Email Correcto"
									value="" style="text-transform:lowercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">	
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">RPM</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="rpm" id="rpm" onkeypress="return NumerosCaracteres(event)"
									maxlength="10" data-toggle="popover" data-placement="bottom" data-content="Ingrese RPM">				
							</div>
							<label class="col-sm-3 control-label">Direccion</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="direccion" id="direccion" onkeypress="return NumerosLetras(event)"
									maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese direccion">
							</div>
						</div>
											
						<div class="form-group">
							<label class="col-sm-2 control-label">Telefono</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="telefono" id="telefono" onkeypress="return Numeros(event)"
									maxlength="6" data-toggle="popover" data-placement="bottom" data-content="Ingrese # Telefono">
							</div>
							<label class="col-sm-3 control-label">Zona Ref.</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="zona" id="zona" onkeypress="return Letras(event)"
									maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese Zona">
							</div>
						</div>		

						<div class="form-group">
		                    <label class="col-sm-2 control-label">Ubigeo</label>
		                    <div class="col-sm-3">
		                        <select class="form-control" name="departamento" id="departamento">
		                            <option value="departamento"> DEPARTAMENTO</option>
		                            <?php foreach ($Departamentos as $value): ?>
		                                <option value="<?php echo $value->ubidepartamento; ?>"><?php echo $value->departamento; ?></option>
		                            <?php endforeach ?>
		                        </select>     
		                    </div>
		                    <div class="col-sm-3">
		                        <select class="form-control" name="provincia" id="provincia">
		                            <option value="provincia"> PROVINCIA</option>
		                            <?php foreach ($Provincias as $value): ?>
		                                <option value="<?php echo $value->ubiprovincia; ?>"><?php echo $value->provincia; ?></option>
		                            <?php endforeach ?>
		                        </select>
		                    </div>
		                    <div class="col-sm-3">
		                        <select class="form-control" name="distrito" id="distrito">
		                            <option value="distrito"> DISTRITO</option>
		                            <?php foreach ($Distritos as $value): ?>
		                                <option value="<?php echo $value->ubidistrito; ?>"><?php echo $value->distrito; ?></option>
		                            <?php endforeach ?>
		                        </select>
		                    </div>
		                </div>
                        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-info btn-xs" onclick="return Modificar(this.form);">
                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Modificar</button> 

                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<style type="text/css">
	#tablaclientes{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaclientes th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaclientes td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>

<style type="text/css">
	#tablaempresas{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaempresas th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaempresas td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>