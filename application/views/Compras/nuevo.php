<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarCompra.js"></script> 

	<link rel="stylesheet" href="<?php echo base_url();?>Librerias/FechaHora/css/datepicker.css">
	<script src="<?php echo base_url();?>Librerias/FechaHora/js/bootstrap-datepicker.js"></script>

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Registro De Una Nueva Compra </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForCompra">
			<?php foreach ($Nuevo as $value):
				session_start(); 
				$cod=$value->codcompra;
			endforeach ?>

			<div class="form-group">
				<label class="col-md-1 control-label">Num.</label>
				<div class="col-md-2">
					<input type="hidden" name="codempleado" id="codempleado" value="<?php echo $_SESSION['idempleado'];?>">
					<input type="text" class="form-control" name="codcompra" id="codcompra" value=" <?php echo $cod+1;?>" style="text-align:center;"
					disabled="disabled" data-toggle="popover" data-placement="bottom" data-content="Ingrese Codigo">
				</div>

				<label class="col-md-1 control-label">Proveedor</label>
				<div class="col-md-5">
					<div class="input-group">
						<input type="text" class="form-control" name="proveedor" id="proveedor" onkeypress="return Nada(event);" placeholder=" Buscar Proveedor"
							data-toggle="popover" data-placement="bottom" data-content="Buscar Proveedor">
						<input type="hidden"name="codproveedor" id="codproveedor">
						<div class="input-group-addon">
							<a href="#Proveedores" onclick="TraerProveedores();" data-toggle="modal" id="AgregarOtroProveedor">
							<span class="glyphicon glyphicon-search" style="color:#6E6E6E;"></span></a> 
						</div>
						<div class="input-group-addon">
							<a href="#AgregarProveedor" data-toggle="modal" id="Buscar">
							<span class="glyphicon glyphicon-plus-sign" style="color:#6E6E6E;"></span></a> 
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Fecha: <?php echo date('d/m/Y');?>" onkeypress="return Nada(event);">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-1 control-label">Factura</label>
				<div class="col-md-2">
					<input type="text" class="form-control" name="factura" id="factura" onkeypress="return Comprobantes(event)" 
					maxlength="10" data-toggle="popover" data-placement="bottom" data-content="Ingrese # Factura">
				</div>

				<label class="col-md-2 control-label">Fecha Compra</label>
				<div class="col-md-3">
					<input type="date" class="form-control" name="fechacompra" id="fechacompra" max="<?php echo date('Y-m-d');?>" onkeypress="return Nada(event);"
					data-toggle="popover" data-placement="bottom" data-content="Ingrese Fecha">
				</div>
				<div class="col-md-4 has-default has-feedback">
					<select id="formapago" name="formapago" class="form-control" data-toggle="popover" 
						data-placement="bottom" data-content="Seleccione Tipo Pago">
						<option value="formapago">Tipo De Pago </option>
						<option value="1">Contado</option>
                        <option value="2">Credito</option> 
					</select>
				</div>
			</div>
			<!--Para Las Cuotas -->
			<div class="form-group" id="credito">
				<label class="col-md-3 control-label">N° Cuotas</label>
				<div class="col-md-2">
					<input type="text" class="form-control" name="nrocuotas" id="nrocuotas" onkeypress="return Numeros(event)" 
					maxlength="2" data-toggle="popover" data-placement="bottom" data-content="Ingrese numero cuotas">
				</div>

				<label class="col-md-3 control-label">Intervalo De Dias</label>
				<div class="col-md-2">
					<input type="text" class="form-control" name="intervalodias" id="intervalodias" onkeypress="return Numeros(event);"
					maxlength="3" data-toggle="popover" data-placement="bottom" data-content="Dias">
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
						    <a href="#Productos" onclick="TraerProductos();" data-toggle="modal" id="Buscar">
						    <span class="glyphicon glyphicon-search" style="color:#6E6E6E;"></span></a> 
						</div>
						<div class="input-group-addon">
						    <a href="#AgregarProducto" data-toggle="modal" id="AgregarOtroProducto">
						    <span class="glyphicon glyphicon-plus-sign" style="color:#6E6E6E;"></span></a> 
						</div>

					</div>
				</div>

				<label class="col-sm-1 control-label">Precio</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="precio" id="precio" onkeypress="return NumerosPuntos(event)"
						maxlength="8" data-toggle="popover" data-placement="bottom" data-content="Precio">
					<input type="hidden" id="conigv">
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
				<table id="tabladetallecompras">
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

			<!-- Lista Cuotas-->
			<div class="modal fade" id="ListaCuotas" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <center><b> Previa Cronograma De Pagos </b></center>
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


	<!--Modal Para Productos -->
	<div class="modal fade" id="Productos" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			       	<h5 class="modal-title">
			       		<center><b> Hotel Tarapoto Inn - Lista De Productos </b></center>
			       	</h5>			        	
			    </div>
			    <div class="modal-body">
					<table  id="listaproductos">
						<thead>
							<tr>
								<th><center> Descripcion </center></th>
								<th><center> Stock </center></th>
								<th><center> Con IGV </center></th>
								<th><center> Accion </center></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
			    </div>
			</div>
		</div>
	</div>


	<!-- Modal que carga proveedores disponibles -->
	<div class="modal fade" id="Proveedores" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h5 class="modal-title">
			        	<center><b> Hotel Tarapoto Inn - Lista Proveedores </b></center>
			        </h5>			        	
			    </div>
			   
			    <div class="modal-body">
					<table id="listaproveedores">
						<thead>
							<tr>
								<th><center> RUC </center></th>
								<th><center> Razon Social </center></th>
								<th><center> Direccion </center></th>
								<th><center> Accion </center></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
			    </div>
			</div>
		</div>
	</div>

	<!-- Modal Nuevo Proveedor -->
	<div class="modal fade" id="AgregarProveedor" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h5 class="modal-title">
			        	<center><b> Hotel Tarapoto Inn - Nuevo Proveedor</b></center>
			        </h5>			        	
			    </div>
			   
			    <div class="modal-body">
					<form  class="form-horizontal" id="ForNuevoProveedor">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">RUC Empresa</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="rucem" id="rucem" onkeypress="return Numeros(event)"
                                    maxlength="11" data-toggle="popover" data-placement="bottom" data-content="Ingrese RUC Correcto">
                            </div>
                            <label class="col-sm-2 control-label">Razon&nbsp;Social</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="razon" id="razon" onkeypress="return Letras(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Razon Social">               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Telefono</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="tel" id="tel" onkeypress="return Numeros(event)"
                                    maxlength="6" data-toggle="popover" data-placement="bottom" data-content="Ingrese Telefono">               
                            </div>

                            <label class="col-sm-2 control-label">Celular</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="cel" id="cel" onkeypress="return Numeros(event)"
                                    maxlength="9" data-toggle="popover" data-placement="bottom" data-content="Ingrese Celular">
                           </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Direccion</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="dire" id="dire" onkeypress="return NumerosLetras(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Direccion">               
                            </div>

                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="correoelec" id="correoelec" onkeypress="return ValidarEmail(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Email Valido">
                            </div>
                        </div>

                        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-info btn-xs" onclick="return GuardarProveedor(this.form);">
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

	<div class="modal fade" id="AgregarProducto" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h5 class="modal-title">
			        	<center><b> Hotel Tarapoto Inn - Nuevo Producto </b></center>
			        </h5>			        	
			    </div>
			   
			    <div class="modal-body">
					<form  class="form-horizontal" id="ForNuevoProducto">
                        <div class="form-group">
                        	<label class="col-md-1"></label>
                            <div class="col-sm-5">
                            	<select class="form-control" name="tipop" id="tipop" data-toggle="popover" data-placement="bottom" data-content="Seleccione Tipo">
                            		<option value="tipo">Tipo Producto</option>
                            		<?php foreach ($TipoProductos as $value) { ?>
                            			<option value="<?php echo $value->codtipoproducto;?>"><?php echo $value->descripcion;?></option>
                            		<?php } ?>
                            	</select>
                            </div>
                            <label class="col-sm-2 control-label">Descripcion</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="descrip" id="descrip" onkeypress="return Letras(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Descripcion">               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Stock Minimo</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="stockmin" id="stockmin" onkeypress="return Numeros(event)"
                                    maxlength="1" data-toggle="popover" data-placement="bottom" data-content="Stock Minimo">               
                            </div>

                            <label class="col-sm-2 control-label">Stock&nbsp;Maximo</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="stockmax" id="stockmax" onkeypress="return Numeros(event)"
                                    maxlength="3" data-toggle="popover" data-placement="bottom" data-content="Stock Maximo">
                           </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Precio</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="preciop" id="preciop" onkeypress="return NumerosPuntos(event)"
                                    maxlength="10" data-toggle="popover" data-placement="bottom" data-content="Ingrese Precio">               
                            </div>

                            <label class="col-sm-2 control-label">Cobrar IGV</label>
                            <div class="col-sm-2">
                            	<select class="form-control" name="cigv" id="cigv">
                            		<option value="no">No</option>
	                            	<option value="si">Si</option>
	                            </select>
                            </div>
                        </div>

                        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-info btn-xs" onclick="return GuardarProducto(this.form);">
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
</body>

<style type="text/css">
	#tabladetallecompras{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tabladetallecompras th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tabladetallecompras td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}

	#listaproductos{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#listaproductos th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#listaproductos td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	
	#listaproveedores{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#listaproveedores th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#listaproveedores td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}

	table{
        width: 100%;
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