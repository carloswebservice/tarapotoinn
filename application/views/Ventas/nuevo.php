<body>
	<script src="<?php echo base_url();?>Librerias/plugins/xchart/exporting.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarVenta.js"></script> 

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Registro De Una Nueva Venta </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForVenta">
			<?php foreach ($Nuevo as $value):
				session_start(); 
				$cod=$value->codventas;
			endforeach ?>

			<div class="form-group">
				<label class="col-md-1 control-label">N.Venta</label>
				<div class="col-md-2">
					<input type="hidden" name="codempleado" id="codempleado" value="<?php echo $_SESSION['idempleado'];?>">
					<input type="text" class="form-control" name="codventa" id="codventa" value=" <?php echo $cod+1;?>" style="text-align:center;"
					disabled="disabled" data-toggle="popover" data-placement="bottom" data-content="Ingrese Codigo">
				</div>

				<label class="col-md-1 control-label">Cliente</label>
				<div class="col-md-5">
					<div class="input-group">
						<input type="text" class="form-control" name="cliente" id="cliente" onkeypress="return Nada(event);" placeholder=" Buscar Cliente"
							data-toggle="popover" data-placement="bottom" data-content="Buscar Cliente">
						<input type="hidden"name="codcliente" id="codcliente">
						<div class="input-group-addon">
							<a href="#Clientes" onclick="TraerCliente()" data-toggle="modal" id="Buscar">
							<span class="glyphicon glyphicon-search" style="color:#6E6E6E;"></span></a> 
						</div>
						<div class="input-group-addon">
							<a href="#AgregarCliente" data-toggle="modal" id="Buscar">
							<span class="glyphicon glyphicon-plus-sign" style="color:#6E6E6E;"></span></a> 
						</div>
					</div>
				</div>
				<div class="col-md-3 has-default has-feedback">
					<select id="formapago" name="formapago" class="form-control" data-toggle="popover" 
						data-placement="bottom" data-content="Seleccione Forma Pago">
						<option value="formapago">Tipo De Pago </option>
                        <option value="1">Contado</option>
                        <option value="2">Credito</option>   
					</select>
				</div>
			</div>
			<!--Para Las Cuotas -->
			<div class="form-group" id="credito">
				<div class="col-md-3">
                    <input type="text" class="form-control" name="debetotal" id="debetotal" placeholder="Saldo:" onkeypress="return Nada(event);" style="border-color:red;">
                </div>
                <div class="col-md-1">
                    <a href="" onclick="Scoring();" data-toggle="modal" class="btn btn-warning btn-xs">Calificacion</a>
                </div>

				<label class="col-md-2 control-label">N° Cuotas</label>
				<div class="col-md-2">
					<input type="text" class="form-control" name="nrocuotas" id="nrocuotas"
					data-toggle="popover" data-placement="bottom" data-content="Ingrese numero cuotas">
				</div>

				<label class="col-md-2 control-label">Intervalo&nbsp;Dias</label>
				<div class="col-md-2">
					<input type="text" class="form-control" name="intervalodias" id="intervalodias" onkeypress="return Numeros(event);"
					maxlength="2" data-toggle="popover" data-placement="bottom" data-content="Dias">
				</div>
			</div>
			<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
					
			<div class="form-group">
				<div class="col-md-4">
					<div class="input-group">
						<input type="text" class="form-control" name="producto" id="producto" placeholder=" Buscar Producto"
						onkeypress="return Nada(event);" data-toggle="popover" data-placement="bottom" data-content="Buscar Producto">
						<input type="hidden"name="codproducto" id="codproducto">

						<div class="input-group-addon">
						    <a href="#Productos" data-toggle="modal" id="Buscar">
						    <span class="glyphicon glyphicon-search" style="color:#6E6E6E;"></span></a> 
						</div>
					</div>
				</div>

				<label class="col-sm-1 control-label">Precio</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="precio" id="precio" onkeypress="return NumerosPuntos(event)"
						maxlength="8" data-toggle="popover" data-placement="bottom" data-content="Precio">
				</div>

				<label class="col-sm-1 control-label">Cantidad</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="cantidad" id="cantidad" onkeypress="return Numeros(event);"
						maxlength="5" data-toggle="popover" data-placement="bottom" data-content="Cantidad">
				</div>				
				
				<div class="col-md-1">
					<button type="button" class="btn btn-success btn-xs" onclick="return Agregar(this.form);">
				   	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Agregar</button> 
				</div>
			</div>

			<div class="form-group">
				<table id="tabladetalleventas">
					<thead>
						<tr>
							<th> Cantidad </th>
							<th> Producto </th>
							<th> Precio&nbsp;Unitario </th>
							<th> Subtotal </th>
							<th> IGV 18% </th>
							<th> Accion </th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">SubTotal</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="subtotal" id="subtotal" onkeypress="return NumerosPuntos(event)" maxlength="10">
				</div>

				<label class="col-sm-1 control-label">Total&nbsp;IGV</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="igv" id="igv" onkeypress="return NumerosPuntos(event)" maxlength="4">
				</div>

				<label class="col-sm-1 control-label">Total&nbsp;S/.</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="total" id="total" onkeypress="return NumerosPuntos(event)" maxlength="10">
				</div>
			</div>

			<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
			<div class="row">
				<center>
					<button type="button" class="btn btn-info btn-xs" id="GuardarC" onclick="return Guardar(this.form);">
				   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 
				   	&nbsp;&nbsp;
					<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
				</center>
			</div>

			   <!-- Cronograma Previo-->
            <div class="modal fade" id="ListaCuotas" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <center><b> Previa Lista De Cuotas </b></center>
                            </h4>                       
                        </div>
                        <div class="modal-body">
                            <table id="tablacuotas">
                                <thead>
                                    <th>Nro Cuota</th>
                                    <th>Monto</th>
                                    <th>Fecha Vencimiento</th>
                                </thead>
                                <tbody></tbody>
                            </table><br>

                            <center>
                                <button type="button" class="btn btn-info btn-xs" onclick="return AhoraMandaGuardar(this.form);">
                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Ahora Guardar</button> 

                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
		</form>
	</div>

	
	<!-- Para Scoring-->
    <div class="modal fade" id="Scoring" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-body">
                    
                    <div id="scoring" style="width: 40%;"></div>
                </div>
            </div>
        </div>
    </div>


	<!-- Modal que carga clientes disponibles -->
	<div class="modal fade" id="Clientes" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			    <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h5 class="modal-title">
			        		<center><b> Hotel Tarapoto Inn - Lista De Clientes </b></center>
			        	</h5>			        	
			    </div>
			    <div class="modal-body">
					<table id="tablacliente">
						<thead>
							<tr>
								<th><center> DNI Cliente / RUC Empresa </center></th>
                                <th><center> Cliente / Empresa </center></th>
                                <th><center> Accion </center></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
			    </div>
			</div>
		</div>
	</div>

	<!-- -->
	<div class="modal fade" id="AgregarCliente" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center><b> Hotel Tarapoto Inn - Agregar Cliente  </b></center>
                    </h4>                       
                </div>
                <div class="modal-body">
                    <form  class="form-horizontal" id="ForNuevoCliente">
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-4">
                                <label style="font-size:16px;">
                                    <input type="radio" name="tipocliente" id="persona" checked value="persona">
                                    Cliente Persona
                                </label>           
                            </div>
                            <div class="col-sm-4">
                                <label style="font-size:16px;">
                                    <input type="radio" name="tipocliente" id="empresa" value="empresa">
                                    Cliente Empresa
                                  </label>
                            </div>                     
                        </div>

                        <div id="clientepersona">
                            <center><h5 style="font-size:15px;"><b> Datos Del Cliente </b></h5></center>
                            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">DNI Cliente</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="dnicli" id="dnicli" onkeypress="return Numeros(event)"
                                        maxlength="8" data-toggle="popover" data-placement="bottom" data-content="Ingrese DNI Correcto">
                                </div>

                                <label class="col-sm-3 control-label">Nombres</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="nom" id="nom" onkeypress="return Letras(event)"
                                        maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Nombre">               
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Apellido Paterno</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="apep" id="apep" onkeypress="return Letras(event)"
                                        maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">               
                                </div>

                                <label class="col-sm-2 control-label">Apellido Materno</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="apem" id="apem" onkeypress="return Letras(event)"
                                        maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">
                                </div>
                            </div>
                        </div>
                        <div id="clienteempresa">
                            <center><h5 style="font-size:15px;"><b> Datos De La Empresa </b></h5></center>
                            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">RUC</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="ruc" id="ruc" onkeypress="return Numeros(event)"
                                        maxlength="11" data-toggle="popover" data-placement="bottom" data-content="Ingrese RUC Correcto">
                                </div>

                                <label class="col-sm-3 control-label">Razon Social</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="razons" id="razons" onkeypress="return Letras(event)"
                                        maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Razon Social">               
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Direccion</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="dire" id="dire" onkeypress="return NumerosLetras(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Direccion">               
                            </div>

                            <label class="col-sm-2 control-label">Correo Electronico</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="correoelec" id="correoelec" onkeypress="return ValidarEmail(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Correo Valido">
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
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="distrito" id="distrito">
                                    <option value="distrito"> DISTRITO</option>
                                </select>
                            </div>
                        </div>
                        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-info btn-xs" onclick="return GuardarCliente(this.form);">
                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


	<div class="modal fade" id="Productos" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			       	<h5 class="modal-title"><center><b> Hotel Tarapoto Inn - Lista De Productos </b></center>
			       	</h5>			        	
			    </div>
			    <div class="modal-body">
					<table id="TablaProductos">
						<thead>
							<tr>
								<th><center> Cod Producto </center></th>
								<th><center> Descripcion </center></th>
								<th><center> Stock </center></th>
								<th><center> Accion </center></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($Productos as $value): ?>
								<tr>
									<td><center> <?php echo $value->codproducto; ?></center></td>
									<td><center> <?php echo $value->descripcion; ?></center></td>
									<td><center> <?php echo $value->stockactual;?></center></td>
									<td> <center> <a href="#" 
										onclick='ProductoSeleccionado(<?php echo $value->codproducto;?>,"<?php echo $value->descripcion;?>",<?php echo $value->precio;?>);' 
									data-dismiss="modal">
									<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a></center></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
			    </div>
			</div>
		</div>
	</div>
</body>

<script language="javascript">
			$(function() {
				$('#TablaProductos').DataTable({
					"language": {
						"sProcessing":     "Procesando...",
					    "sLengthMenu":     "",
					    "sZeroRecords":    "No se encontraron resultados",
					    "sEmptyTable":     "Ningún dato disponible en esta tabla",
					    "sInfo":           "",
					    "sInfoEmpty":      "",
					    "sInfoFiltered":   "",
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
					    }
			        }
				});
			});
</script>

<style type="text/css">
	#tablacliente{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablacliente th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablacliente td{
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
	#tabladetalleventas{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tabladetalleventas th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tabladetalleventas td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}

	#TablaProductos{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#TablaProductos th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#TablaProductos td{
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

