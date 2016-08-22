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
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarReserva.js"></script> 
	<div class="container" style="width:100%;">	 <br>	
		<div>
		  	<ul class="nav nav-tabs nav-justified" role="tablist" id="navegar">
		    	<li role="presentation" class="active"><a href="#verestadias" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-home"></span> Estadia</a></li>
		    	<li role="presentation"><a href="#cuotas" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-eye-open"></span> Ver Cuotas</a></li>
		    </ul>

		  	<div class="tab-content">
		  		<!-- Para Ver La Estadia -->
			    <div role="tabpanel" class="tab-pane active" id="verestadias"> <br> <br>
			    	<form  class="form-horizontal" id="Ver">
			    		<?php foreach ($Estadia as $value){ 
								if ($value->razonsocial=="") {
									$cliente=$value->nombre.' '.$value->appaterno.' '.$value->apmaterno;
								}else{
									$cliente=$value->razonsocial;
								}
								if ($value->tipodepago==1) {
									$pago="AL CONTADO";
								}else{
									if ($value->tipodepago==2) {
										$pago="A CREDITO";
									}else{
										$pago="NO DEFINIDO";
									}								
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