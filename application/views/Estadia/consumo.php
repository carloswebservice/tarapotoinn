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
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarEstadia.js"></script> 
	<div class="container" style="width:100%;">	 <br>	
		<div>
		  	<ul class="nav nav-tabs nav-justified" role="tablist" id="navegar">
		    	<li role="presentation" class="active"><a href="#verestadias" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-home"></span> Estadia</a></li>
		    	<li role="presentation"><a href="#cuotas" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-eye-open"></span> Ver Cuotas</a></li>
		    	<li role="presentation"><a href="#consumos" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-shopping-cart"></span> Consumo</a></li>
		  	</ul>

		  	<div class="tab-content">
		  		<!-- Para Ver La Estadia -->
			    <div role="tabpanel" class="tab-pane active" id="verestadias"> <br> <br>
			    	<form  class="form-horizontal" id="Ver">
			    		<?php 
							foreach ($Estadia as $value){
								if ($value->razonsocial=="") {
									$cliente=$value->nombre.' '.$value->appaterno.' '.$value->apmaterno;
								}else{
									$cliente=$value->razonsocial;
								}
								if ($value->tipodepago==1) {
									$pago="AL CONTADO";
								}else{
									$pago="A CREDITO";
								}
								$fechaingreso=$value->fechaingreso;
								$horaingreso=$value->horaingreso;
								$fechasalida=$value->fechasalida;
								$horasalida=$value->horasalida;
								$direccion=$value->direccion;
								$total=$value->total;
							}
						?>

						<div class="form-group">
							<label class="col-md-1 control-label">Cliente</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="cliente" id="cliente" onkeypress="return Nada(event);" placeholder="<?php echo $cliente; ?>">
							</div>
							<label class="col-sm-2 control-label">Fecha Ingreso</label>
			                <div class="col-sm-2">
			                    <input type="text" id="fechaingreso" class="form-control" placeholder="<?php echo $fechaingreso?>" onkeypress="return Nada(event);">
			                </div>

			                <label class="col-sm-1 control-label">Hora</label>
			                <div class="col-sm-2">
			                    <input type="text" id="horaingreso" class="form-control" placeholder="<?php echo $horaingreso?>" onkeypress="return Nada(event);">
			                </div>
			            </div>

			            <div class="form-group">
			                <label class="col-sm-1 control-label">Direccion</label>
			                <div class="col-sm-4">
			                    <input type="text" id="horaingreso" class="form-control" placeholder="<?php echo $direccion?>" onkeypress="return Nada(event);">
			                </div>

			                <label class="col-sm-2 control-label">Fecha Salida</label>
			                <div class="col-sm-2">
			                    <input type="text" id="fechasalida" name="fechasalida" class="form-control" placeholder="<?php echo $fechasalida?>" onkeypress="return Nada(event);">
			                </div>

			                <label class="col-sm-1 control-label">Hora</label>
			                <div class="col-sm-2">
			                    <input type="text" id="horasalida" name="horasalida" class="form-control" placeholder="<?php echo $horasalida?>" onkeypress="return Nada(event);">
			                </div>
			            </div>
			            <div class="form-group">
			                <label class="col-sm-2 control-label">Tipo De Pago</label>
			                <div class="col-sm-3">
			                    <input type="text" id="horaingreso" class="form-control" placeholder="<?php echo $pago?>" onkeypress="return Nada(event);">
			                </div>

			                <label class="col-sm-2 control-label">Monto Total S/.</label>
			                <div class="col-sm-2">
			                    <input type="text" id="fechasalida" name="fechasalida" class="form-control" placeholder="<?php echo $total?>" onkeypress="return Nada(event);">
			                </div>
			            </div>

			            <center><h5><b>Cliente En Habitacion</b></h5></center>
			            <div class="form-group">
			                <table id="tabladetalleestadia">
								<thead>
									<tr>
										<th> Nro. Habitacion </th>
										<th> Cliente </th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($DetalleEstadia as $value): ?>
										<tr>
											<td><center> <?php echo $value->nrohabitacion; ?></center></td>
											<td><center> <?php echo $value->nombre.' '.$value->appaterno.' '.$value->apmaterno; ?></center></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
			            </div>

			            <center><h5><b>Lista De Consumos</b></h5></center>
			            <div class="form-group">
			                <table id="tabladetalleestadia">
								<thead>
									<tr>
										<th> Cantidad </th>
										<th> Producto </th>
										<th> Precio </th>
										<th> Igv </th>
										<th> SubTotal </th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$totconsumos=0;
										foreach ($ListaConsumos as $value): 
										$totconsumos=$totconsumos+($value->cantidad*$value->precio)+$value->igv?>
										<tr>
											<td><center> <?php echo $value->cantidad; ?></center></td>
											<td><center> <?php echo $value->descripcion; ?></center></td>
											<td><center> <?php echo $value->precio; ?></center></td>
											<td><center> <?php echo $value->igv; ?></center></td>
											<td><center> <?php echo ($value->cantidad*$value->precio)+$value->igv; ?></center></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table> <br>
							<div class="form-group">
								<label class="col-sm-2"></label>
								<div class="col-sm-4">
									<input type="text" class="form-control" placeholder="Total De Estadia: <?php echo $total-$totconsumos; ?>" onkeypress="return Nada(event);">
								</div>
								<label class="col-sm-1"></label>
								<div class="col-sm-4">
									<input type="text" class="form-control" placeholder="Total En Consumos: <?php echo $totconsumos; ?>" onkeypress="return Nada(event);">
								</div>
							</div>
			            </div>			            

			            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
						<div class="row">
							<center>
								<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
							</center>
						</div>
					</form>
			    </div>

			    <!-- Para Ver Las Cuotas-->
			    <div role="tabpanel" class="tab-pane" id="cuotas"> <br><br>
			    	<form class="form-horizontal">
			    		<div class="form-group">
							<table id="tablacuotas">
								<thead>
									<tr>
										<th> # Cuota </th>
										<th> Fecha Vencimiento </th>
										<th> Monto Total </th>
										<th> Total Cobrado </th>
										<th> Saldo </th>
										<th> Estado </th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($Cuotas as $value): ?>
										<tr>
											<td><center> <?php echo $value->nrocuota; ?></center></td>
											<td><center> <?php echo $value->fecha; ?></center></td>
											<td><center> <?php echo $value->monto; ?></center></td>
											<td><center> <?php echo $value->monto_cobrado; ?></center></td>
											<td><center> <?php echo $value->monto-$value->monto_cobrado; ?></center></td>
											<?php 
												if(($value->monto-$value->monto_cobrado)==0){
													echo "<td><center> Cancelado</center></td>";
												}else{
													echo "<td><center> Falta Cancelar</center></td>";
												}
											?>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
						<div class="row">
							<center>
								<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
							</center>
						</div>
			    	</form>
			    </div>

			    <!-- Para Ver Consumos-->
			    <div role="tabpanel" class="tab-pane" id="consumos"> <br> <br>
			    	<form class="form-horizontal" id="consumocliente">	
			    		<?php foreach ($DetalleEstadia as $value):
							$cod=$value->codestadia;
						endforeach ?>    
						<input type="hidden" name="estadia" value="<?php echo $cod;?>">		
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
							<table id="tablaconsumos">
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
								<input type="text" class="form-control" name="igv" id="igv" onkeypress="return NumerosPuntos(event)" maxlength="10">
							</div>

							<label class="col-sm-1 control-label">Total&nbsp;S/.</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="total" id="total" onkeypress="return NumerosPuntos(event)" maxlength="10">
							</div>
						</div>
						
						<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
						<div class="row">
							<center>
								<button type="button" class="btn btn-info btn-xs" id="GuardarC" onclick="return GuardarConsumo(this.form);">
							   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
							   	&nbsp;&nbsp;
								<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
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
			        	<h5 class="modal-title">
			        		<center><b> Hotel Tarapoto Inn - Lista De Productos </b></center>
			        	</h5>			        	
			    </div>
			    <div class="modal-body">
					<table id="tablaproductos">
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
									<td> <center> 
										<a href="#" onclick='ProductoSeleccionado(<?php echo $value->codproducto;?>,"<?php echo $value->descripcion;?>",<?php echo $value->precio;?>);' data-dismiss="modal">
										<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
									</center></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
			    </div>
			</div>
		</div>
	</div>
</body>

<style type="text/css">
	#tabladetalleestadia{
		width: 80%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tabladetalleestadia th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tabladetalleestadia td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}

	#tablaconsumos{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaconsumos th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaconsumos td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}

	#tablacuotas{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablacuotas th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablacuotas td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaproductos{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaproductos th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaproductos td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>